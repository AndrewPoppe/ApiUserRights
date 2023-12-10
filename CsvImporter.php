<?php

namespace YaleREDCap\ApiUserRights;

class CsvImporter
{
    private string $csvString;
    private ApiUserRights $module;
    public $csvContents;
    public $cleanContents;
    private array $methods;
    public $badMethods = [];
    public $goodUsers = [];
    public $goodMethods = [];
    public $badUsers = [];
    public $errorMessages = [];
    public $proposed = [];
    private $header;
    private $valid = true;
    private $rowValid = true;
    private int $projectId;
    private int $usernameIndex;
    private bool $default;
    public function __construct(ApiUserRights $module, string $csvString, bool $default = false)
    {
        $this->module    = $module;
        $this->csvString = $csvString;
        $this->projectId = (int) $module->framework->getProject()->getProjectId();
        $this->methods   = $this->module->getTableHeader()['methodOrder'];
        $this->default   = $default;
    }

    public function parseCsvString()
    {
        $lineEnding = strpos($this->csvString, "\r\n") !== false ? "\r\n" : "\n";
        $data       = str_getcsv($this->csvString, $lineEnding);
        foreach ( $data as &$row ) {
            $row = str_getcsv($row, ',');
        }
        $this->csvContents = $data;
    }

    private function methodNamesAreClean($row)
    {
        foreach ( $row as $method ) {
            if ( $method === 'username' ) {
                continue;
            }
            if ( !in_array($method, $this->methods, true) ) {
                $this->badMethods[] = $this->module->framework->escape($method);
                $this->rowValid     = false;
                $this->valid        = false;
            } elseif ( in_array($method, $this->goodMethods, true) ) {
                $this->errorMessages[] = 'Duplicate method: ' . $this->module->framework->escape($method);
                $this->rowValid        = false;
                $this->valid           = false;
            } else {
                $this->goodMethods[] = $method;
            }
        }
    }

    private function checkUsername($username)
    {
        $username = trim($username);
        if ( empty($username) ) {
            $this->rowValid   = false;
            $this->badUsers[] = $this->module->framework->escape($username);
        } elseif ( in_array($username, $this->goodUsers, true) ) {
            $this->errorMessages[] = 'Duplicate username: ' . $this->module->framework->escape($username);
            $this->rowValid        = false;
        } else {
            $this->goodUsers[] = $username;
        }

        return $username;
    }

    private function checkUser($username)
    {
        $user       = $this->module->framework->getUser($username);
        $userRights = $user->getRights();
        if ( is_null($userRights) ) {
            $this->badUsers[] = $this->module->framework->escape($username);
            $this->rowValid   = false;
        }
    }

    public function contentsValid()
    {
        $this->header = $this->csvContents[0];

        if ( !$this->default ) {
            $this->usernameIndex = array_search('username', $this->header, true);
            if ( $this->usernameIndex === false ) {
                $this->errorMessages[] = 'Missing username column';
                return false;
            }
        }

        foreach ( $this->csvContents as $key => $row ) {
            $this->rowValid = true;

            // Header Row
            if ( $key === array_key_first($this->csvContents) ) {
                $this->methodNamesAreClean($row);
                continue;
            }

            // Data Row
            if ( !$this->default ) {
                $thisUsername = $this->checkUsername($row[$this->usernameIndex]);
                $this->checkUser($thisUsername);
            } else {
                $thisUsername = 'default';
            }

            if ( !$this->rowValid ) {
                $this->valid = false;
            } else {
                $this->cleanContents[] = [ 'user' => $thisUsername, 'permissions' => $this->parsePermissions($row) ];
            }
        }

        if ( !empty($this->badUsers) ) {
            $this->errorMessages[] = 'Invalid usernames';
            $this->valid           = false;
        }

        if ( !empty($this->badMethods) ) {
            $this->errorMessages[] = 'Invalid API methods';
            $this->valid           = false;
        }

        if ( empty($this->cleanContents) ) {
            $this->errorMessages[] = 'No valid rows were present in the CSV file';
            $this->valid           = false;
        }

        $this->errorMessages = array_values(array_unique($this->errorMessages));
        return $this->valid;
    }

    private function parsePermissions($thesePermissions, $validValues = [ 0, 1 ])
    {
        $result = [];
        foreach ( $thesePermissions as $index => $value ) {
            $method   = $this->header[$index];
            $isMethod = in_array($method, $this->methods, true);
            if ( $isMethod ) {
                $intValue = filter_var($value, FILTER_VALIDATE_INT);
                if ( !in_array($intValue, $validValues, true) ) {
                    $username              = $this->default ? 'default' : $thesePermissions[$this->usernameIndex];
                    $this->errorMessages[] = 'Invalid "' . $method . '" value for <strong>' . $username . '</strong>: ' . $this->module->framework->escape($value);
                    $this->rowValid        = false;
                    $this->valid           = false;
                }
                $result[$method] = $intValue;
            }
        }
        return $result;
    }

    private function getRights()
    {
        $result        = [];
        $currentRights = $this->module->getAllUsers($this->projectId);
        foreach ( $this->cleanContents as $row ) {
            $thisResult             = [];
            $user                   = $this->module->framework->getUser($row['user']);
            $username               = $user->getUsername();
            $userFullname           = $this->module->getFullName($username);
            $userCurrentRightsArray = array_filter($currentRights, function ($row) use ($username) {
                return $row['username'] === $username;
            });
            $userCurrentRights      = reset($userCurrentRightsArray);

            $thisResult['user']        = $username;
            $thisResult['name']        = $userFullname;
            $thisResult['permissions'] = [];
            foreach ( $this->methods as $method ) {
                $current  = (int) $userCurrentRights[$method];
                $proposed = (int) $row['permissions'][$method];
                if ( $current == $proposed ) {
                    $thisResult['permissions'][$method] = $proposed;
                } else {
                    $thisResult['permissions'][$method] = [
                        'current'  => $current,
                        'proposed' => $proposed
                    ];
                    $thisResult['changes']              = true;
                }
            }
            $result[] = $thisResult;
        }
        $this->proposed = $result;
    }

    private function formatCell($cellValue, $centerText = true)
    {
        if ( !is_array($cellValue) ) {
            return '<td class="' . ($centerText ? 'text-center' : '') . '">' . $cellValue . '</td>';
        }
        return '<td class="table-warning">New: <span class="text-primary font-weight-bold">' . $cellValue['proposed'] .
            '</span><br>Current: <span class="text-danger font-weight-bold">' .
            $cellValue['current'] . '</span></td>';
    }
    public function getUpdateTable()
    {
        $this->getRights();
        $html = '<div class="modal fade">
            <div class="modal-xl modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm API Rights</h5>
                        <button type="button" class="btn-close align-self-center" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container mb-4 w-90" style="font-size:larger;">Examine the table of proposed changes below to verify it is correct. Only users in highlighted rows or with 
                    highlighted cells will be affected.</div>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>User</th>
                                <th>Name</th>';
        foreach ( $this->methods as $method ) {
            $html .= '<th>' . $method . '</th>';
        }
        $html .= '</tr>
                        </thead>
                        <tbody>';
        $nothingToDo = true;
        foreach ( $this->proposed as $row ) {
            $rowClass    = $row['changes'] ? 'bg-light' : 'table-secondary';
            $nothingToDo = $row['changes'] ? false : $nothingToDo;

            $html .= '<tr class="' . $rowClass . '">' .
                $this->formatCell($row['user'], false) .
                $this->formatCell($row['name'], false);
            foreach ( $this->methods as $method ) {
                $value = $row['permissions'][$method];
                $html .= $this->formatCell($value);
            }
            $html .= '</tr>';
        }

        $html .= '</tbody>
                    </table>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="API_USER_RIGHTS.confirmImport()" ' .
            ($nothingToDo ? 'title="There are no changes to make" disabled' : '') .
            '>Confirm</button>
                    </div>
                </div>
            </div>
        </div>';
        return $html;
    }

    public function import()
    {
        $success = false;
        try {
            foreach ( $this->cleanContents as $row ) {
                $this->module->saveRights($row['user'], $row['permissions'], $this->projectId);
            }
            $this->module->framework->log('Imported API rights from CSV');
            $success = true;
        } catch ( \Throwable $e ) {
            $this->module->log('Error importing API rights', [ 'error' => $e->getMessage() ]);
        } finally {
            return $success;
        }
    }
}