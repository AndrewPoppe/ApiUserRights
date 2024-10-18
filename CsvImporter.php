<?php

namespace YaleREDCap\ApiUserRights;

class CsvImporter
{
    private string $csvString;
    private ApiUserRights $module;
    public $csvContents;
    public $cleanContents;
    private array $methodNames;
    private array $methodCodes;
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
    public function __construct(ApiUserRights $module, string $csvString, $projectId, bool $default = false)
    {
        $this->module      = $module;
        $this->csvString   = $csvString;
        $this->projectId   = $default ? 0 : (int) ($projectId ?? $module->framework->getProjectId());
        $header            = $this->module->getTableHeader();
        $this->methodNames = $header['methodOrder'];
        $this->methodCodes = $header['methodCodes'];
        $this->default     = $default;
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
            if ( !in_array($method, $this->methodCodes, true) ) {
                $this->badMethods[] = $this->module->framework->escape($method);
                $this->rowValid     = false;
                $this->valid        = false;
            } elseif ( in_array($method, $this->goodMethods, true) ) {
                $this->errorMessages[] = $this->module->framework->tt('duplicate_method') . ' ' . $this->module->framework->escape($method);
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
            $this->errorMessages[] = $this->module->framework->tt('duplicate_username') . ' ' . $this->module->framework->escape($username);
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
                $this->errorMessages[] = $this->module->framework->tt('missing_username_column');
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
            $this->errorMessages[] = $this->module->framework->tt('invalid_usernames');
            $this->valid           = false;
        }

        if ( !empty($this->badMethods) ) {
            $this->errorMessages[] = $this->module->framework->tt('invalid_api_methods');
            $this->valid           = false;
        }

        if ( empty($this->cleanContents) ) {
            $this->errorMessages[] = $this->module->framework->tt('no_valid_rows');
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
            $isMethod = in_array($method, $this->methodCodes, true);
            if ( $isMethod ) {
                $intValue = filter_var($value, FILTER_VALIDATE_INT);
                if ( !in_array($intValue, $validValues, true) ) {
                    if ( $this->default ) {
                        $message = $this->module->framework->tt('acceptable_values');
                    } else {
                        $username = $thesePermissions[$this->usernameIndex];
                        $message  = $this->module->framework->tt('invalid_value', $method, $username) . ': ' . $this->module->framework->escape($value);
                    }
                    $this->errorMessages[] = $message;
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
            foreach ( $this->methodCodes as $method ) {
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
        return '<td class="table-warning">' . $this->module->framework->tt('new') . ': <span class="text-primary font-weight-bold">' . $cellValue['proposed'] .
            '</span><br>' . $this->module->framework->tt('current') . ': <span class="text-danger font-weight-bold">' .
            $cellValue['current'] . '</span></td>';
    }
    public function getUpdateTable()
    {
        $this->getRights();
        $html = '<div class="modal fade">
            <div class="modal-xl modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">' . $this->module->framework->tt('confirm_api_rights') . '</h5>
                        <button type="button" class="btn-close align-self-center" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container mb-4 w-90" style="font-size:larger;">' . $this->module->framework->tt('confirm_api_rights_description') . '</div>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>' . $this->module->framework->tt('user') . '</th>
                                <th>' . $this->module->framework->tt('name') . '</th>';
        foreach ( $this->methodNames as $index => $method ) {
            $html .= '<th>' . $method . ' (' . $this->methodCodes[$index] . ')</th>';
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
            foreach ( $this->methodCodes as $method ) {
                $value = $row['permissions'][$method];
                $html .= $this->formatCell($value);
            }
            $html .= '</tr>';
        }

        $html .= '</tbody>
                    </table>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">' . $this->module->framework->tt('cancel') . '</button>
                        <button type="button" class="btn btn-primary" onclick="API_USER_RIGHTS.confirmImport()" ' .
            ($nothingToDo ? 'title="' . $this->module->framework->tt('no_changes_to_make') . '" disabled' : '') .
            '>' . $this->module->framework->tt('confirm') . '</button>
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