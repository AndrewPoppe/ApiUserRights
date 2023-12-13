<?php
namespace YaleREDCap\ApiUserRights;

use DateTimeRC;

/**
 * @property \ExternalModules\Framework $framework
 * @see Framework
 */

require_once 'CsvImporter.php';
require_once 'RightsChecker.php';
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
            "area"       => "Arms",
            "method"     => "Export Arms",
            "content"    => "arm",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "arm_export"
        ],
        [
            "area"       => "Arms",
            "method"     => "Import Arms",
            "content"    => "arm",
            "action"     => "import",
            "data"       => "",
            "methodCode" => "arm_import"
        ],
        [
            "area"       => "Arms",
            "method"     => "Delete Arms",
            "content"    => "arm",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "arm_delete"
        ],
        [
            "area"       => "Data Access Groups",
            "method"     => "Export DAGs",
            "content"    => "dag",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "dag_export"
        ],
        [
            "area"       => "Data Access Groups",
            "method"     => "Import DAGs",
            "content"    => "dag",
            "action"     => "import",
            "data"       => "",
            "methodCode" => "dag_import"
        ],
        [
            "area"       => "Data Access Groups",
            "method"     => "Delete DAGs",
            "content"    => "dag",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "dag_delete"
        ],
        [
            "area"       => "Data Access Groups",
            "method"     => "Switch DAGs",
            "content"    => "dag",
            "action"     => "switch",
            "data"       => "",
            "methodCode" => "dag_switch"
        ],
        [
            "area"       => "Data Access Groups",
            "method"     => "Export User-DAG Assignment",
            "content"    => "userDagMapping",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "userDagMapping_export"
        ],
        [
            "area"       => "Data Access Groups",
            "method"     => "Import User-DAG Assignment",
            "content"    => "userDagMapping",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "userDagMapping_import"
        ],
        [
            "area"       => "Events",
            "method"     => "Export Events",
            "content"    => "event",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "event_export"
        ],
        [
            "area"       => "Events",
            "method"     => "Import Events",
            "content"    => "event",
            "action"     => "import",
            "data"       => "",
            "methodCode" => "event_import"
        ],
        [
            "area"       => "Events",
            "method"     => "Delete Events",
            "content"    => "event",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "event_delete"
        ],
        [
            "area"       => "Field Names",
            "method"     => "Export List of Export Field Names",
            "content"    => "exportFieldNames",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "exportFieldNames_export"
        ],
        [
            "area"       => "Files",
            "method"     => "Export a File",
            "content"    => "file",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "file_export"
        ],
        [
            "area"       => "Files",
            "method"     => "Import a File",
            "content"    => "file",
            "action"     => "import",
            "data"       => "",
            "methodCode" => "file_import"
        ],
        [
            "area"       => "Files",
            "method"     => "Delete a File",
            "content"    => "file",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "file_delete"
        ],
        [
            "area"       => "File Repository",
            "method"     => "Create a New Folder in the File Repository",
            "content"    => "fileRepository",
            "action"     => "createFolder",
            "data"       => "",
            "methodCode" => "fileRepository_createFolder"
        ],
        [
            "area"       => "File Repository",
            "method"     => "Export a List of Files/Folders from the File Repository",
            "content"    => "fileRepository",
            "action"     => "list",
            "data"       => "",
            "methodCode" => "fileRepository_list"
        ],
        [
            "area"       => "File Repository",
            "method"     => "Export a File from the File Repository",
            "content"    => "fileRepository",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "fileRepository_export"
        ],
        [
            "area"       => "File Repository",
            "method"     => "Import a File into the File Repository",
            "content"    => "fileRepository",
            "action"     => "import",
            "data"       => "",
            "methodCode" => "fileRepository_import"
        ],
        [
            "area"       => "File Repository",
            "method"     => "Delete a File from the File Repository",
            "content"    => "fileRepository",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "fileRepository_delete"
        ],
        [
            "area"       => "Instruments",
            "method"     => "Export Instruments (Data Entry Forms)",
            "content"    => "instrument",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "instrument_export"
        ],
        [
            "area"       => "Instruments",
            "method"     => "Export PDF file of Instruments",
            "content"    => "pdf",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "pdf_export"
        ],
        [
            "area"       => "Instruments",
            "method"     => "Export Instrument-Event Mappings",
            "content"    => "formEventMapping",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "formEventMapping_export"
        ],
        [
            "area"       => "Instruments",
            "method"     => "Import Instrument-Event Mappings",
            "content"    => "formEventMapping",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "formEventMapping_import"
        ],
        [
            "area"       => "Logging",
            "method"     => "Export Logging",
            "content"    => "log",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "log_export"
        ],
        [
            "area"       => "Metadata",
            "method"     => "Export Metadata (Data Dictionary)",
            "content"    => "metadata",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "metadata_export"
        ],
        [
            "area"       => "Metadata",
            "method"     => "Import Metadata (Data Dictionary)",
            "content"    => "metadata",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "metadata_import"
        ],
        // [
        //     "area"    => "Projects",
        //     "method"  => "Create Project",
        //     "content" => "project",
        //     "action"  => "import",
        //     "data"    => true
        // ],
        [
            "area"       => "Projects",
            "method"     => "Import Project Info",
            "content"    => "project_settings",
            "action"     => "import",
            "data"       => "",
            "methodCode" => "project_settings_import"
        ],
        [
            "area"       => "Projects",
            "method"     => "Export Project Info",
            "content"    => "project",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "project_export"
        ],
        [
            "area"       => "Projects",
            "method"     => "Export Project XML",
            "content"    => "project_xml",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "project_xml_export"
        ],
        [
            "area"       => "Records",
            "method"     => "Export Records",
            "content"    => "record",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "record_export"
        ],
        [
            "area"       => "Records",
            "method"     => "Import Records",
            "content"    => "record",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "record_import"
        ],
        [
            "area"       => "Records",
            "method"     => "Delete Records",
            "content"    => "record",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "record_delete"
        ],
        [
            "area"       => "Records",
            "method"     => "Rename Record",
            "content"    => "record",
            "action"     => "rename",
            "data"       => "",
            "methodCode" => "record_rename"
        ],
        [
            "area"       => "Records",
            "method"     => "Generate Next Record Name",
            "content"    => "generateNextRecordName",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "generateNextRecordName_export"
        ],
        [
            "area"       => "Repeating Instruments and Events",
            "method"     => "Export Repeating Instruments and Events",
            "content"    => "repeatingFormsEvents",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "repeatingFormsEvents_export"
        ],
        [
            "area"       => "Repeating Instruments and Events",
            "method"     => "Import Repeating Instruments and Events",
            "content"    => "repeatingFormsEvents",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "repeatingFormsEvents_import"
        ],
        [
            "area"       => "Reports",
            "method"     => "Export Reports",
            "content"    => "report",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "report_export"
        ],
        [
            "area"       => "REDCap",
            "method"     => "Export REDCap Version",
            "content"    => "version",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "version_export"
        ],
        [
            "area"       => "Surveys",
            "method"     => "Export a Survey Link",
            "content"    => "surveyLink",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "surveyLink_export"
        ],
        [
            "area"       => "Surveys",
            "method"     => "Export Survey Participants",
            "content"    => "participantList",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "participantList_export"
        ],
        [
            "area"       => "Surveys",
            "method"     => "Export a Survey Queue Link",
            "content"    => "surveyQueueLink",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "surveyQueueLink_export"
        ],
        [
            "area"       => "Surveys",
            "method"     => "Export a Survey Return Code",
            "content"    => "surveyReturnCode",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "surveyReturnCode_export"
        ],
        [
            "area"       => "Users & User Privileges",
            "method"     => "Export Users",
            "content"    => "user",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "user_export"
        ],
        [
            "area"       => "Users & User Privileges",
            "method"     => "Import Users",
            "content"    => "user",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "user_import"
        ],
        [
            "area"       => "Users & User Privileges",
            "method"     => "Delete Users",
            "content"    => "user",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "user_delete"
        ],
        [
            "area"       => "User Roles",
            "method"     => "Export User Roles",
            "content"    => "userRole",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "userRole_export"
        ],
        [
            "area"       => "User Roles",
            "method"     => "Import User Roles",
            "content"    => "userRole",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "userRole_import"
        ],
        [
            "area"       => "User Roles",
            "method"     => "Delete User Roles",
            "content"    => "userRole",
            "action"     => "delete",
            "data"       => "",
            "methodCode" => "userRole_delete"
        ],
        [
            "area"       => "User Roles",
            "method"     => "Export User-Role Assignment",
            "content"    => "userRoleMapping",
            "action"     => "export",
            "data"       => "",
            "methodCode" => "userRoleMapping_export"
        ],
        [
            "area"       => "User Roles",
            "method"     => "Import User-Role Assignment",
            "content"    => "userRoleMapping",
            "action"     => "import",
            "data"       => true,
            "methodCode" => "userRoleMapping_import"
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
    // public function redcap_module_api_before($project_id, $content, $action)
    // {
    //     $this->framework->log('API Before', [
    //         'project_id'  => $project_id,
    //         'project_id2' => $this->framework->getProjectId(),
    //         'project_id3' => $this->framework->getProject()->getProjectId(),
    //         'user_id'     => $this->framework->getUser()->getUsername(),
    //         'content'     => $content,
    //         'action'      => $action,
    //     ]);
    //     ob_start(function ($str) {
    //         $this->framework->log('API After', [ 'response' => $str ]);
    //         return $str;
    //     }, 0, PHP_OUTPUT_HANDLER_FLUSHABLE);
    //     //$this->framework->exitAfterHook();
    // }
    public function redcap_module_ajax($action, $payload, $project_id, $record, $instrument, $event_id, $repeat_instance, $survey_hash, $response_id, $survey_queue_hash, $page, $page_full, $user_id, $group_id)
    {
        try {
            $user   = $this->framework->getUser();
            $rights = $user->getRights();
            if ( ($rights['user_rights'] ?? '') != '1' ) {
                return null;
            }
            if ( $action === 'getApiUserRights' ) {
                $headerInfo = $this->getTableHeader();
                $users      = $this->getAllUsers($project_id);
                return [
                    'methodOrder' => $headerInfo['methodOrder'],
                    'methodCodes' => $headerInfo['methodCodes'],
                    'users'       => $users
                ];
            } elseif ( $action === 'saveApiUserRights' ) {
                $userToSet     = $payload['user'] ?? '';
                $rights        = $payload['rights'] ?? [];
                $rightsChecker = new RightsChecker($this, $userToSet, $rights);
                if ( $rightsChecker->isValid() ) {
                    $this->saveRights($userToSet, $rights, $project_id);
                    return true;
                } else {
                    return false;
                }
            } elseif ( $action === 'importRightsCsv' ) {
                $importer = new CsvImporter($this, $payload['data'] ?? '', $project_id);
                $importer->parseCsvString();

                $contentsValid = $importer->contentsValid();
                if ( $contentsValid !== true ) {
                    return [
                        'status' => 'error',
                        'data'   => [
                            'errors'     => $importer->errorMessages,
                            'badUsers'   => $importer->badUsers,
                            'badMethods' => $importer->badMethods
                        ]
                    ];
                }

                if ( filter_var($payload['confirm'], FILTER_VALIDATE_BOOL) ) {
                    $this->saveSnapshot($project_id);
                    $this->logEvent('API User Rights Imported');
                    return [
                        'status' => 'ok',
                        'data'   => $importer->import()
                    ];
                } else {
                    return [
                        'status' => 'ok',
                        'data'   => $importer->getUpdateTable()
                    ];
                }
            } elseif ( $action === 'saveApiUserRightsSnapshot' ) {
                try {
                    $this->saveSnapshot($project_id);
                    return [ "success" => true, "tstext" => $this->getLastSnapshotText() ];
                } catch ( \Throwable $e ) {
                    $this->framework->log('Error saving snapshot', [ 'error' => $e->getMessage() ]);
                    return [ "success" => false ];
                }
            } elseif ( $action === 'getSnapshotsInfo' ) {
                try {
                    $snapshots = $this->getSnapshotsInfo($project_id);
                    return [ "success" => true, "snapshots" => $snapshots ];
                } catch ( \Throwable $e ) {
                    $this->framework->log('Error getting snapshots', [ 'error' => $e->getMessage() ]);
                    return [ "success" => false ];
                }
            } elseif ( $action === 'downloadSnapshot' ) {
                $snapshotId = $payload['snapshotId'] ?? '';
                $data       = $this->downloadSnapshot($snapshotId, $project_id);
                $this->logEvent('API User Rights Snapshot Downloaded', [ 'Snapshot Timestamp' => $data['ts'] ]);
                return [ "success" => true, "snapshot" => $data['snapshot'], "tsFormatted" => $data['tsFormatted'] ];
            }
        } catch ( \Throwable $e ) {
            $this->framework->log('Ajax error', [ 'error' => $e->getMessage() ]);
        }
    }

    public function redcap_module_configuration_settings($project_id, $settings)
    {
        try {
            if ( empty($project_id) ) {
                $settingName                = 'default-rights-json-system';
                $currentDefaultRightsString = $this->framework->getSystemSetting($settingName) ?? '{}';
                $defaultRightsTitle         = "Define the set of default API User Rights for the system";
                $defaultRightsDesc          = "These rights will be applied to all users who have not been assigned specific rights. These can be overridden in each project.";
            } else {
                $settingName                = 'default-rights-json-project';
                $currentDefaultRightsString = $this->framework->getProjectSetting($settingName, $project_id) ?? '{}';
                $defaultRightsTitle         = "Define the set of default API User Rights for this project";
                $defaultRightsDesc          = "These rights will be applied to all users who have not been assigned specific rights in this project.";
            }
            $currentDefaultRights = json_decode($currentDefaultRightsString, true);
            $headerInfo           = $this->getTableHeader();
            $odd                  = false;
            $nameData             = "<tr id='default-rights-field'>
                                <td colspan='3'>
                                    <p><span class='font-weight-bold'>" . $defaultRightsTitle . "</span><br>" . $defaultRightsDesc . "</p>
                                    <div class='row row-cols-1 row-cols-sm-2 row-cols-lg-3'>";
            foreach ( $headerInfo['sections'] as $section => $methods ) {
                $odd       = !$odd;
                $cardClass = $odd ? 'odd' : 'even';
                $nameData .= "<div class='col card-container g-2'><div class='card " . $cardClass . "'><div class='card-body'><h5 class='card-title'>" . $section . "</h5>";
                foreach ( $methods as $method ) {
                    $name     = $method["content"] . "_" . $method['action'];
                    $checked  = ($currentDefaultRights[$name] ?? '') == '1' ? 'checked' : '';
                    $nameData .= "<div class='form-check'><input class='form-check-input default-api-rights-input' type='checkbox' id='" . $name . "' name='" . $name . "' value='' " . $checked . "><label class='form-check-label' for='" . $name . "'>" . $method['method'] . "</label></div>";
                }
                $nameData .= "</div></div></div>";
            }
            $nameData .= "</div></td></tr>";
            $scriptData = "<script>\$('tr[field=\'" . $settingName . "\']').after(\$(`" . $nameData . "`));
            $('tr[field=\'" . $settingName . "\']').hide();
            $('input.default-api-rights-input').change(saveDefaultRights);
            function saveDefaultRights() {
                const rights = {};
                $('input.default-api-rights-input').each(function() {
                    rights[this.id] = this.checked ? 1 : 0;
                });
                var rightsJson = JSON.stringify(rights);
                $('input[name=\'" . $settingName . "\']').val(rightsJson);
            }
            </script><style> div.card.odd {background-color: #eee;} div.card.even {background-color: #fcfef5;}</style>";
            $settings[] = [
                'key'  => $settingName,
                'name' => $scriptData,
                'type' => 'json'
            ];
        } catch ( \Throwable $e ) {
            $this->framework->log('Error adding default rights config', [ 'error' => $e->getMessage() ]);
        } finally {
            return $settings;
        }
    }

    public function redcap_module_link_check_display($project_id, $link)
    {
        $user   = $this->framework->getUser();
        $rights = $user->getRights();
        if ( ($rights['user_rights'] ?? '') != '1' && !$user->isSuperUser() ) {
            return null;
        }
        return $link;
    }



    public function redcap_every_page_before_render($project_id = null) : void
    {
        // Only run on the pages we're interested in
        if ( !defined('PAGE') || !isset($_SERVER) ) {
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
                $this->framework->log('API Method Not Allowed', [ 'user' => $username, 'project_id' => $pid, 'methodCode' => $method['methodCode'] ?? '', 'method' => $method['method'] ?? '' ]);
                http_response_code(403);
                header('Content-Type: application/json');
                echo json_encode([ 'error' => 'You do not have permissions to use this API method.' ]);
                $this->framework->exitAfterHook();
                return;
            }
        } catch ( \Throwable $e ) {
            $this->framework->log('error', [ 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString() ]);
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
        return (int) $allowedMethods[$method['methodCode'] ?? ''] === 1;
    }

    private function getAllowedMethods($username, $pid)
    {
        $settingKey     = 'allowed-api-methods-' . $username;
        $allowedMethods = $this->framework->getProjectSetting($settingKey, $pid);
        if ( empty($allowedMethods) ) {
            $allowedMethods = $this->getDefaultApiRights($pid);
            $this->saveRights($username, $allowedMethods, $pid);
        }
        if ( $this->needsConversion($allowedMethods) ) {
            $allowedMethods = $this->convertRightsFromNamesToCodes($allowedMethods);
            $this->saveRights($username, $allowedMethods, $pid);
        }
        return $allowedMethods;
    }



    public function getAllUsers($pid)
    {
        $users = $this->framework->getProject($pid)->getUsers();

        $userRights = [];
        foreach ( $users as $user ) {
            $username           = $user->getUsername();
            $result             = $this->getAllowedMethods($username, $pid) ?? [];
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

    public function getDefaultApiRights($pid)
    {
        $defaultRights              = $this->getBlankApiRights();
        $defaultRightsStringProject = $this->framework->getProjectSetting('default-rights-json-project', $pid);
        $defaultRightsStringSystem  = $this->framework->getSystemSetting('default-rights-json-system');
        $defaultRightsProject       = json_decode($defaultRightsStringProject, true);
        $defaultRightsSystem        = json_decode($defaultRightsStringSystem, true);

        foreach ( $defaultRights as $methodCode => $value ) {
            $defaultRights[$methodCode] = $defaultRightsProject[$methodCode] ?? $defaultRightsSystem[$methodCode] ?? $value ?? 0;
        }
        return $defaultRights;
    }

    private function getDefaultApiRightsFromFile($fileId, $project_id = null)
    {
        list( $mimeType, $docName, $fileContent ) = \REDCap::getFile($fileId);
        $csvImporter                              = new CsvImporter($this, $fileContent, $project_id, true);
        $csvImporter->parseCsvString();
        if ( $csvImporter->contentsValid() !== true ) {
            throw new \Exception('Invalid CSV file: ' . implode(', ', $csvImporter->errorMessages) ?? '');
        }
        return $csvImporter->cleanContents[0]['permissions'];
    }

    private function getBlankApiRights() : array
    {
        $blankRights = [];
        foreach ( ApiUserRights::$methods as $method ) {
            $blankRights[$method['methodCode'] ?? ''] = 0;
        }
        return $blankRights;
    }

    public function getTableHeader()
    {
        $header         = "<thead><tr><th rowspan='2'>Username</th>";
        $header2        = "";
        $sections       = [];
        $allMethods     = [];
        $allMethodCodes = [];
        $even           = true;
        foreach ( ApiUserRights::$methods as $method ) {
            $sections[$method['area']][] = $method;
        }
        foreach ( $sections as $section => $methods ) {
            $thisClass = $even ? 'even' : 'odd';
            $even      = !$even;
            $header .= "<th colspan='" . count($methods) . "' class='" . $thisClass . "'>" . $section . "</th>";
            foreach ( $methods as $method ) {
                $allMethods[]     = $method['method'];
                $allMethodCodes[] = $method['methodCode'];
                $header2 .= "<th class='" . $thisClass . " dt-center'>" . $method['method'] . "</th>";
            }
        }
        $header .= "</tr><tr>";
        $header .= $header2;
        $header .= "</tr></thead>";
        return [
            "header"      => $header,
            "methodOrder" => $allMethods,
            "methodCodes" => $allMethodCodes,
            "sections"    => $sections
        ];
    }

    public function saveRights($userToSet, $rights, $project_id)
    {
        $settingKey     = 'allowed-api-methods-' . $userToSet;
        $existingRights = $this->framework->getProjectSetting($settingKey, $project_id) ?? [];
        $changes        = array_diff_assoc($rights ?? [], $existingRights);
        if ( !empty($changes) ) {
            $changes['user'] = $userToSet;
            $this->logEvent('API User Rights Changed', [ 'changes' => json_encode($changes, JSON_PRETTY_PRINT) ]);
        }
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

    private function saveSnapshot($pid)
    {
        $rights   = $this->getAllUsers($pid);
        $username = $this->framework->getUser()->getUsername();
        $this->framework->log('rights snapshot', [ 'rights' => json_encode($rights), 'username' => $username ]);
    }

    private function formatDate(string $timestampString, bool $compact = false)
    {
        $dateTime = new \DateTime($timestampString);
        $format   = $compact ? 'Y-m-d_Hi' : 'Y/m/d g:ia';
        return $dateTime->format($format);
    }

    public function getLastSnapshotText()
    {
        $result = '';
        try {
            $pid    = $this->getProject()->getProjectId();
            $sql    = "SELECT timestamp WHERE project_id = ? AND message = 'rights snapshot' ORDER BY timestamp DESC LIMIT 1";
            $result = $this->framework->queryLogs($sql, [ $pid ]);

            if ( $result->num_rows === 0 ) {
                $result = 'never';
            } else {
                $snapshot = $result->fetch_assoc();
                $result   = $this->formatDate($snapshot['timestamp']);
            }
        } catch ( \Throwable $e ) {
            $this->framework->log('Error getting last snapshot', [ 'error' => $e->getMessage() ]);
            $pid = null;
        } finally {
            return $result;
        }
    }

    public function getSnapshotsInfo($pid)
    {
        $sql       = "SELECT timestamp, username, log_id WHERE project_id = ? AND message = 'rights snapshot' ORDER BY timestamp DESC";
        $q         = $this->framework->queryLogs($sql, [ $pid ]);
        $snapshots = [];
        while ( $row = $q->fetch_assoc() ) {
            $username    = $row['username'] ?? '';
            $name        = $this->getFullName($username);
            $snapshots[] = [
                'ts'          => $row['timestamp'],
                'tsFormatted' => $this->formatDate($row['timestamp']),
                'username'    => $username,
                'name'        => $name,
                'id'          => $row['log_id']
            ];
        }
        return $snapshots;
    }

    private function downloadSnapshot($snapshotId, $pid)
    {
        $sql = "SELECT rights, timestamp WHERE log_id = ? AND project_id = ?";
        $q   = $this->framework->queryLogs($sql, [ $snapshotId, $pid ]);
        $row = $q->fetch_assoc();
        return [
            'ts'          => $row['timestamp'],
            'tsFormatted' => $this->formatDate($row['timestamp'], true),
            'snapshot'    => json_decode($row['rights'], true)
        ];
    }

    public function logEvent($message, $params = [])
    {
        $this->framework->log($message, $params);
        $paramsString = '';
        foreach ( $params as $key => $value ) {
            $paramsString .= $key . ': ' . $value . "
            ";
        }
        \REDCap::logEvent($message, $paramsString);
    }

    public function convertRightsFromNamesToCodes($rightsToConvert)
    {
        $rights = [];
        foreach ( $rightsToConvert as $rightName => $value ) {
            $rights[$this->convertRightNameToCode($rightName)] = $value;
        }
        return $rights;
    }

    public function convertRightNameToCode($rightName)
    {
        $method = array_filter(ApiUserRights::$methods, function ($method) use ($rightName) {
            return $method['method'] === $rightName;
        });
        $method = reset($method);
        return $method['methodCode'] ?? '';
    }

    public function needsConversion($rights)
    {
        $methodNames = array_filter($rights, function ($key) {
            $methodMatches = array_filter(ApiUserRights::$methods, function ($method) use ($key) {
                return $method['method'] === $key;
            });
            return sizeof($methodMatches) > 0;
        }, ARRAY_FILTER_USE_KEY);
        return sizeof($methodNames) > 0;
    }
}
