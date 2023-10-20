<?php
namespace YaleREDCap\ApiUserRights;

/**
 * @property \ExternalModules\Framework $framework
 * @see Framework
 */
class ApiUserRights extends \ExternalModules\AbstractExternalModule
{

    /**
     * All API methods
     * @var array<int, array{
     * area: string,
     * method: string,
     * content: string,
     * action: string,
     * data: string|bool
     * }>
     */
    static array $methods = [
        [
            "area"    => "Arms",
            "method"  => "Export Arms",
            "content" => "arm",
            "action"  => "export",
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
            "action"  => "export",
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
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Data Access Groups",
            "method"  => "Import User-DAG Assignment",
            "content" => "userDagMapping",
            "action"  => "import",
            "data"    => true
        ],
        [
            "area"    => "Events",
            "method"  => "Export Events",
            "content" => "event",
            "action"  => "export",
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
            "action"  => "export",
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
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Export PDF file of Instruments",
            "content" => "pdf",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Export Instrument-Event Mappings",
            "content" => "formEventMapping",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Instruments",
            "method"  => "Import Instrument-Event Mappings",
            "content" => "formEventMapping",
            "action"  => "import",
            "data"    => true
        ],
        [
            "area"    => "Logging",
            "method"  => "Export Logging",
            "content" => "log",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Metadata",
            "method"  => "Export Metadata (Data Dictionary)",
            "content" => "metadata",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Metadata",
            "method"  => "Import Metadata (Data Dictionary)",
            "content" => "metadata",
            "action"  => "import",
            "data"    => true
        ],
        // [
        //     "area"    => "Projects",
        //     "method"  => "Create Project",
        //     "content" => "project",
        //     "action"  => "import",
        //     "data"    => true
        // ],
        [
            "area"    => "Projects",
            "method"  => "Import Project Info",
            "content" => "project_settings",
            "action"  => "import",
            "data"    => ""
        ],
        [
            "area"    => "Projects",
            "method"  => "Export Project Info",
            "content" => "project",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Projects",
            "method"  => "Export Project XML",
            "content" => "project_xml",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Records",
            "method"  => "Export Records",
            "content" => "record",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Records",
            "method"  => "Import Records",
            "content" => "record",
            "action"  => "import",
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
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Repeating Instruments and Events",
            "method"  => "Export Repeating Instruments and Events",
            "content" => "repeatingFormsEvents",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Repeating Instruments and Events",
            "method"  => "Import Repeating Instruments and Events",
            "content" => "repeatingFormsEvents",
            "action"  => "import",
            "data"    => true
        ],
        [
            "area"    => "Reports",
            "method"  => "Export Reports",
            "content" => "report",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "REDCap",
            "method"  => "Export REDCap Version",
            "content" => "version",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export a Survey Link",
            "content" => "surveyLink",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export Survey Participants",
            "content" => "participantList",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export a Survey Queue Link",
            "content" => "surveyQueueLink",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Surveys",
            "method"  => "Export a Survey Return Code",
            "content" => "surveyReturnCode",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Users & User Privileges",
            "method"  => "Export Users",
            "content" => "user",
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "Users & User Privileges",
            "method"  => "Import Users",
            "content" => "user",
            "action"  => "import",
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
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "User Roles",
            "method"  => "Import User Roles",
            "content" => "userRole",
            "action"  => "import",
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
            "action"  => "export",
            "data"    => ""
        ],
        [
            "area"    => "User Roles",
            "method"  => "Import User-Role Assignment",
            "content" => "userRoleMapping",
            "action"  => "import",
            "data"    => true
        ]
    ];

    /**
     *
     * All valid content values for REDCap API
     * @var array
     */
    static array $content = [
        'record',
        'metadata',
        'file',
        'fileRepository',
        'filesize',
        'fileinfo',
        'repeatingFormsEvents',
        'instrument',
        'event',
        'arm',
        'user',
        'project_settings',
        'report',
        'authkey',
        'version',
        'pdf',
        'surveyLink',
        'surveyQueueLink',
        'surveyReturnCode',
        'participantList',
        'exportFieldNames',
        'appRightsCheck',
        'formEventMapping',
        'fieldValidation',
        'attachment',
        'project',
        'generateNextRecordName',
        'project_xml',
        'dag',
        'userDagMapping',
        'log',
        'tableau',
        'mycap',
        'userRole',
        'userRoleMapping'
    ];

    /**
     * All content values actually used in standard API methods
     * @var array
     */
    static array $contentUsed = [
        'record',
        'metadata',
        'file',
        'fileRepository',
        'repeatingFormsEvents',
        'instrument',
        'event',
        'arm',
        'user',
        'project_settings',
        'report',
        'version',
        'pdf',
        'surveyLink',
        'surveyQueueLink',
        'surveyReturnCode',
        'participantList',
        'exportFieldNames',
        'formEventMapping',
        'project',
        'generateNextRecordName',
        'project_xml',
        'dag',
        'userDagMapping',
        'log',
        'userRole',
        'userRoleMapping'
    ];

    public function redcap_module_ajax($action, $payload, $project_id, $record, $instrument, $event_id, $repeat_instance, $survey_hash, $response_id, $survey_queue_hash, $page, $page_full, $user_id, $group_id)
    {
        try {
            $user   = $this->framework->getUser();
            $rights = $user->getRights();
            if ( ($rights['user_rights'] ?? '') != '1' ) {
                return null;
            }
            if ( $action === 'getApiUserRights' ) {
                return $this->getAllUsers($project_id);
            } elseif ( $action === 'saveApiUserRights' ) {
                $userToSet = $payload['user'] ?? '';
                $rights    = $payload['rights'] ?? [];
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
        if ( ($rights['user_rights'] ?? '') != '1' ) {
            return null;
        }
        return $link;
    }

    public function redcap_every_page_before_render($project_id = null) : void
    {
        // Only run on the pages we're interested in
        if (!defined(PAGE) || !isset($_SERVER) {
            return;
        }
        if (
            ($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' ||
            (PAGE ?? '') !== 'api/index.php'
        ) {
            return;
        }
        try {
            $post = $this->framework->escape($_POST) ?? [];

            // If content is not valid, let REDCap handle it
            $contentValid = $this->validateContent($post);
            if ( !$contentValid ) {
                return;
            }

            $user = $this->getApiUser($post);

            // Invalid token, let REDCap handle it
            if ( empty($user) || empty($user['username'] || empty($user['$project_id'])) ) {
                return;
            }

            $username = $user['username'];
            $pid      = $user['project_id'];

            // Module is not enabled for this project, don't do anything
            if ( !in_array($pid, $this->getProjectsWithModuleEnabledIncludingByDefault() ?? []) ) {
                return;
            }

            // Check for exceptions - situations where we want to allow the request to proceed
            // even if the method is not defined in the API
            $exempt = $this->checkForExceptions($post, $user);

            // This is an exempt method, let REDCap handle it
            if ( $exempt ) {
                return;
            }

            // Try to determine the API method
            $method = $this->determineApiMethod($post);

            // Not a valid API method and not exempt, you shall not pass
            if ( !$method || empty($method) ) {
                http_response_code(400);
                header('Content-Type: application/json');
                // TODO: Send in the requested return format instead of always json
                echo json_encode([ 'error' => 'Invalid request.' ]);
                $this->framework->exitAfterHook();
                return;
            }

            // Check if the user has permission to use this method
            $methodAllowed = $this->isMethodAllowed($method, $username, $pid);
            if ( !$methodAllowed ) {
                $this->framework->log('API Method Not Allowed', [ 'user' => $username, 'project_id' => $pid, 'method' => $method['method'] ?? '' ]);
                http_response_code(403);
                header('Content-Type: application/json');
                echo json_encode([ 'error' => 'You do not have permissions to use this API method.' ]);
                $this->framework->exitAfterHook();
                return;
            }
        } catch ( \Throwable $e ) {
            $this->framework->log('error', [ 'error' => $e->getMessage() ]);
        }

    }

    public function determineApiMethod(array $data)
    {
        $content   = $data['content'] ?? '';
        $action    = $data['action'] ?? '';
        $dataIsSet = isset($data['data']) ? true : '';

        $result    = $this->getMethod($content, $action, $dataIsSet) ?? [];
        $methodArr = array_filter(self::$methods, function ($method) use ($result) {
            return ($method['content'] ?? '') === ($result["content"] ?? '')
                && ($method['action'] ?? '') === ($result["action"] ?? '');
        });
        return reset($methodArr);
    }

    /**
     * Find situations in which non-standard requests should be allowed to progress
     * @param array $data
     * @return bool whether or not the request should be allowed to progress due to an exemption
     */
    private function checkForExceptions($data, $user)
    {
        return false;
    }

    /**
     * Get the requested content and action based on parameters
     *
     * Note: REDCap's own API code does not properly handle several combinations here, resulting in undefined behavior.
     * These are listed here:
     *
     * fileRepository:      switch is allowed as an action, but there is no associated method
     * instrument:          import is allowed as an action, but there is no associated method
     * event:               switch is allowed as an action, but there is no associated method
     * event:               createFolder is allowed as an action, but there is no associated method
     * event:               list is allowed as an action, but there is no associated method
     * arm:                 switch is allowed as an action, but there is no associated method
     * arm:                 createFolder is allowed as an action, but there is no associated method
     * arm:                 list is allowed as an action, but there is no associated method
     * user:                switch is allowed as an action, but there is no associated method
     * user:                createFolder is allowed as an action, but there is no associated method
     * user:                list is allowed as an action, but there is no associated method
     * project_settings:    export is allowed as an action, but there is no associated method
     * ... I stopped counting... there are a lot of these
     */
    public function getMethod($content, $action, $dataIsSet)
    {

        if ( !in_array($content, self::$content) ) {
            return null;
        }

        // If invalid settings, return null
        if ( in_array($content, [ 'file' ]) && in_array($action, [ 'export', 'import', 'import_app', 'delete' ]) === false ) {
            return null;
        }

        if ( $content == 'project' && $dataIsSet ) {
            return null;
        }

        // Set action as needed
        if ( in_array($content, [ 'version', 'event', 'arm', 'repeatingFormsEvents', 'dag', 'user', 'userRole', 'userRoleMapping' ]) && empty($action) ) {
            $action = 'export';
        }
        if ( in_array($content, [ 'user', 'userRole', 'userRoleMapping' ]) && $action != 'delete' && $dataIsSet ) {
            $action = 'import';
        }
        if ( in_array($content, [ 'fileRepository', 'file', 'event', 'arm', 'dag', 'user', 'userRole' ]) ) {
            if ( !in_array($action, [ 'export', 'import', 'delete', 'import_app', 'switch', 'createFolder', 'list' ]) ) {
                return null;
            }
        } elseif ( !($content == 'record' && in_array($action, [ 'delete', 'rename' ])) ) {
            $action = (!$dataIsSet || $content == 'version') ? 'export' : 'import';
        }

        return [
            'content' => $content,
            'action'  => $action
        ];
    }

    private function getApiUser(array $data)
    {
        $token = $this->framework->sanitizeAPIToken($data['token'] ?? '');
        if ( empty($token) ) {
            return null;
        }
        $sql = "SELECT username, project_id, api_export, api_import, mobile_app FROM redcap_user_rights WHERE api_token = ?";
        $q   = $this->framework->query($sql, [ $token ]);
        return $q->fetch_assoc();
    }

    private function isMethodAllowed(array $method, $username, $pid)
    {
        $allowedMethods = $this->getAllowedMethods($username, $pid);
        if ( empty($allowedMethods) ) {
            return false;
        }
        return $allowedMethods[$method['method'] ?? ''] === true;
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
            $result             = $settings['allowed-api-methods-' . $username] ?? $this->getBlankApiRights() ?? [];
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
            $fname  = $result['user_firstname'] ?? '';
            $lname  = $result['user_lastname'] ?? '';
            return $fname . ' ' . $lname;
        } catch ( \Throwable $e ) {
            $this->framework->log('Error getting full name', [ 'error' => $e->getMessage() ]);
            return null;
        }
    }

    private function getBlankApiRights() : array
    {
        $blankRights = [];
        foreach ( ApiUserRights::$methods as $method ) {
            $blankRights[$method['method'] ?? ''] = false;
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


    /**
     * @return array
     */
    public function getProjectsWithModuleEnabledIncludingByDefault()
    {
        if ( !$this->getSystemSetting('enabled') ) {
            return $this->framework->getProjectsWithModuleEnabled();
        }

        $possibleProjectsResults = $this->query(
            "SELECT CAST(p.project_id AS CHAR) AS project_id
            FROM redcap_projects p
            WHERE p.date_deleted IS NULL
            AND p.status IN (0,1)
            AND p.completed_time IS NULL",
            []
        );

        $disabledProjectsResults = $this->query(
            "SELECT CAST(s.project_id AS CHAR) AS project_id
            FROM redcap_external_modules m
            JOIN redcap_external_module_settings s
            ON m.external_module_id = s.external_module_id
            JOIN redcap_projects p
            ON s.project_id = p.project_id
            WHERE m.directory_prefix = ?
            AND s.value = 'false'
            AND s.key = ?",
            [ $this->PREFIX, \ExternalModules\ExternalModules::KEY_ENABLED ]
        );

        $disabledPids = [];
        while ( $row = $disabledProjectsResults->fetch_assoc() ) {
            $disabledPids[] = $row['project_id'];
        }

        $pids = [];
        while ( $row = $possibleProjectsResults->fetch_assoc() ) {
            $pid = $row['project_id'] ?? '';
            if ( !in_array($pid, $disabledPids, true) ) {
                $pids[] = $pid;
            }
        }
        return $pids;
    }

    private function validateContent($data)
    {
        return isset($data['content']) && in_array($data['content'] ?? '', ApiUserRights::$contentUsed);
    }
}
