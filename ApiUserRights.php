<?php
namespace YaleREDCap\ApiUserRights;

/**
 * @property \ExternalModules\Framework $framework
 * @see Framework
 */
class ApiUserRights extends \ExternalModules\AbstractExternalModule
{

    static array $methods = [
        [
            "area"    => "Arms",
            "method"  => "Export Arms",
            "content" => "arm",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Arms",
            "method"  => "Import Arms",
            "content" => "arm",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "Arms",
            "method"  => "Delete Arms",
            "content" => "arm",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Export DAGs",
            "content" => "dag",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Import DAGs",
            "content" => "dag",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Delete DAGs",
            "content" => "dag",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Switch DAGs",
            "content" => "dag",
            "action"  => "switch",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Export User-DAG Assignment",
            "content" => "userDagMapping",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Import User-DAG Assignment",
            "content" => "userDagMapping",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "Events",
            "method"  => "Export Events",
            "content" => "event",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Events",
            "method"  => "Import Events",
            "content" => "event",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "Events",
            "method"  => "Delete Events",
            "content" => "event",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "Field Names",
            "method"  => "Export List of Export Field Names",
            "content" => "exportFieldNames",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Files",
            "method"  => "Export a File",
            "content" => "file",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Files",
            "method"  => "Import a File",
            "content" => "file",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "Files",
            "method"  => "Delete a File",
            "content" => "file",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "File Repository",
            "method"  => "Create a New Folder in the File Repository",
            "content" => "fileRepository",
            "action"  => "createFolder",
            "data"    => ""
        ],
        [
            "area"    => "File Repository",
            "method"  => "Export a List of Files/Folders from the File Repository",
            "content" => "fileRepository",
            "action"  => "list",
            "data"    => ""
        ],
        [
            "area"    => "File Repository",
            "method"  => "Export a File from the File Repository",
            "content" => "fileRepository",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "File Repository",
            "method"  => "Import a File into the File Repository",
            "content" => "fileRepository",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "File Repository",
            "method"  => "Delete a File from the File Repository",
            "content" => "fileRepository",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Export Instruments (Data Entry Forms)",
            "content" => "instrument",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Export PDF file of Instruments",
            "content" => "pdf",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Export Instrument-Event Mappings",
            "content" => "formEventMapping",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Import Instrument-Event Mappings",
            "content" => "formEventMapping",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Logging",
            "method"  => "Export Logging",
            "content" => "log",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Metadata",
            "method"  => "Export Metadata (Data Dictionary)",
            "content" => "metadata",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Metadata",
            "method"  => "Import Metadata (Data Dictionary)",
            "content" => "metadata",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Projects",
            "method"  => "Create Project",
            "content" => "project",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Projects",
            "method"  => "Import Project Info",
            "content" => "project_settings",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Projects",
            "method"  => "Export Project Info",
            "content" => "project",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Projects",
            "method"  => "Export Project XML",
            "content" => "project_xml",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Records",
            "method"  => "Export Records",
            "content" => "record",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Records",
            "method"  => "Import Records",
            "content" => "record",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Records",
            "method"  => "Delete Records",
            "content" => "record",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "Records",
            "method"  => "Rename Record",
            "content" => "record",
            "action"  => "rename",
            "data"    => ""
        ],
        [
            "area"    => "Records",
            "method"  => "Generate Next Record Name",
            "content" => "generateNextRecordName",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Repeating Instruments and Events",
            "method"  => "Export Repeating Instruments and Events",
            "content" => "repeatingFormsEvents",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Repeating Instruments and Events",
            "method"  => "Import Repeating Instruments and Events",
            "content" => "repeatingFormsEvents",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Reports",
            "method"  => "Export Reports",
            "content" => "report",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "REDCap",
            "method"  => "Export REDCap Version",
            "content" => "version",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export a Survey Link",
            "content" => "surveyLink",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export Survey Participants",
            "content" => "participantList",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export a Survey Queue Link",
            "content" => "surveyQueueLink",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export a Survey Return Code",
            "content" => "surveyReturnCode",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Users & User Privileges",
            "method"  => "Export Users",
            "content" => "user",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "Users & User Privileges",
            "method"  => "Import Users",
            "content" => "user",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "Users & User Privileges",
            "method"  => "Delete Users",
            "content" => "user",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "User Roles",
            "method"  => "Export User Roles",
            "content" => "userRole",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "User Roles",
            "method"  => "Import User Roles",
            "content" => "userRole",
            "action"  => "",
            "data"    => true
        ],
        [
            "area"    => "User Roles",
            "method"  => "Delete User Roles",
            "content" => "userRole",
            "action"  => "delete",
            "data"    => ""
        ],
        [
            "area"    => "User Roles",
            "method"  => "Export User-Role Assignment",
            "content" => "userRoleMapping",
            "action"  => "",
            "data"    => ""
        ],
        [
            "area"    => "User Roles",
            "method"  => "Import User-Role Assignment",
            "content" => "userRoleMapping",
            "action"  => "import",
            "data"    => ""
        ]
    ];

    public function redcap_module_ajax($action, $payload, $project_id, $record, $instrument, $event_id, $repeat_instance, $survey_hash, $response_id, $survey_queue_hash, $page, $page_full, $user_id, $group_id)
    {
        try {
            $user   = $this->framework->getUser();
            $rights = $user->getRights();
            if ( $rights['user_rights'] != '1' ) {
                return null;
            }
            if ( $action === 'getApiUserRights' ) {
                return $this->getAllUsers($project_id);
            } elseif ( $action === 'saveApiUserRights' ) {
                $userToSet = $payload['user'];
                $rights    = $payload['rights'];
                $this->saveRights($userToSet, $rights, $project_id);
            }
        } catch ( \Throwable $e ) {
            $this->framework->log('Ajax error', [ 'error' => $e->getMessage() ]);
        }
    }

    public function redcap_module_link_check_display($project_id, $link)
    {
        $user   = $this->framework->getUser();
        $rights = $user->getRights();
        if ( $rights['user_rights'] != '1' ) {
            return null;
        }
        return $link;
    }

    public function redcap_every_page_before_render() : void
    {
        // Only run on the pages we're interested in
        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST' ||
            PAGE !== 'api/index.php'
        ) {
            return;
        }
        try {
            $post   = $this->framework->escape($_POST);
            $method = $this->determineApiMethod($post);
            $method = reset($method);

            if ( !$method || empty($method) ) {
                return;
            }

            $user     = $this->getApiUser($post);
            $username = $user['username'];
            $pid      = $user['project_id'];

            $methodAllowed = $this->isMethodAllowed($method, $username, $pid);

            if ( !$methodAllowed ) {
                $this->framework->log('API Method Not Allowed', [ 'user' => $username, 'project_id' => $pid, 'method' => $method['method'] ]);
                $this->framework->exitAfterHook();
            }
        } catch ( \Throwable $e ) {
            $this->framework->log('error', [ 'error' => $e->getMessage() ]);
        }

    }

    public function determineApiMethod(array $data)
    {
        $content   = strtolower($data['content']);
        $action    = strtolower($data['action'] ?? '');
        $dataIsSet = isset($data['data']) ? true : '';

        return $this->getMethod($content, $action, $dataIsSet);
    }

    private function getMethod($content, $action, $dataIsSet)
    {
        return array_filter(ApiUserRights::$methods, function ($method) use ($content, $action, $dataIsSet) {
            return $method['content'] === $content && $method['action'] === $action && $method['data'] === $dataIsSet;
        });
    }

    private function getApiUser(array $data)
    {
        $token = $this->framework->sanitizeAPIToken($data['token']);
        if ( empty($token) ) {
            return null;
        }
        $sql = "SELECT username, project_id, api_export, api_import FROM redcap_user_rights WHERE api_token = ?";
        $q   = $this->framework->query($sql, [ $token ]);
        if ( $q->num_rows === 0 ) {
            return null;
        }

        return $q->fetch_assoc();
    }

    private function isMethodAllowed(array $method, $username, $pid)
    {
        $allowedMethods = $this->getAllowedMethods($username, $pid);
        if ( empty($allowedMethods) ) {
            return false;
        }
        return $allowedMethods[$method['method']] === true;
    }

    private function getAllowedMethods($username, $pid)
    {
        $settingKey = 'allowed-api-methods-' . $username;
        return $this->framework->getProjectSetting($settingKey, $pid) ?? $this->getBlankApiRights();
    }



    public function getAllUsers($pid)
    {
        $settings = $this->framework->getProjectSettings($pid);
        $users    = $this->framework->getProject($pid)->getUsers();

        $userRights = [];
        foreach ( $users as $user ) {
            $username           = $user->getUsername();
            $result             = $settings['allowed-api-methods-' . $username] ?? $this->getBlankApiRights();
            $result['username'] = $username;
            $result['name']     = $this->getFullName($username);
            $userRights[]       = $result;
        }
        return $userRights;
    }

    public function getFullName($username)
    {
        try {
            $sql = 'SELECT user_firstname, user_lastname FROM redcap_user_information WHERE username = ?';
            $q   = $this->framework->query($sql, [ $username ]);
            if ( $q->num_rows === 0 ) {
                return null;
            }
            $result = $q->fetch_assoc();
            return $result['user_firstname'] . ' ' . $result['user_lastname'];
        } catch ( \Throwable $e ) {
            $this->framework->log('Error getting full name', [ 'error' => $e->getMessage() ]);
            return null;
        }
    }

    private function getBlankApiRights() : array
    {
        $blankRights = [];
        foreach ( ApiUserRights::$methods as $method ) {
            $blankRights[$method['method']] = false;
        }
        return $blankRights;
    }

    public function getTableHeader()
    {
        $header     = "<thead><tr><th rowspan='2'>Username</th>";
        $header2    = "";
        $sections   = [];
        $allMethods = [];
        $even       = true;
        foreach ( ApiUserRights::$methods as $method ) {
            $sections[$method['area']][] = $method;
        }
        foreach ( $sections as $section => $methods ) {
            $thisClass = $even ? 'even' : 'odd';
            $even      = !$even;
            $header .= "<th colspan='" . count($methods) . "' class='" . $thisClass . "'>" . $section . "</th>";
            foreach ( $methods as $method ) {
                $allMethods[] = $method['method'];
                $header2 .= "<th class='" . $thisClass . " dt-center'>" . $method['method'] . "</th>";
            }
        }
        $header .= "</tr><tr>";
        $header .= $header2;
        $header .= "</tr></thead>";
        return [
            "header"      => $header,
            "methodOrder" => $allMethods,
            "sections"    => $sections
        ];
    }

    private function saveRights($userToSet, $rights, $project_id)
    {
        $settingKey = 'allowed-api-methods-' . $userToSet;
        $this->framework->setProjectSetting($settingKey, $rights, $project_id);
    }
}