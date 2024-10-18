<?php
namespace YaleREDCap\ApiUserRights;

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
     * langCodeArea: string,
     * method: string,
     * content: string,
     * action: string,
     * data: string|bool
     * methodCode: string,
     * methodCodeRC: string,
     * langCode: string,
     * langCodeInternal: string
     * }>
     */
    static array $methods = [
        // Arms
        [
            "area"             => "Arms",
            "langCodeArea"     => "api_97",
            "method"           => "Export Arms",
            "content"          => "arm",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "arm_export",
            "methodCodeRC"     => "exp_arms",
            "langCode"         => "api_63",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Arms",
            "langCodeArea"     => "api_97",
            "method"           => "Import Arms",
            "content"          => "arm",
            "action"           => "import",
            "data"             => "",
            "methodCode"       => "arm_import",
            "methodCodeRC"     => "imp_arms",
            "langCode"         => "api_82",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Arms",
            "langCodeArea"     => "api_97",
            "method"           => "Delete Arms",
            "content"          => "arm",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "arm_delete",
            "methodCodeRC"     => "del_arms",
            "langCode"         => "api_82",
            "langCodeInternal" => ""
        ],
        // Data Access Groups
        [
            "area"             => "Data Access Groups",
            "langCodeArea"     => "global_22",
            "method"           => "Export DAGs",
            "content"          => "dag",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "dag_export",
            "methodCodeRC"     => "exp_dags",
            "langCode"         => "api_152",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Data Access Groups",
            "langCodeArea"     => "global_22",
            "method"           => "Import DAGs",
            "content"          => "dag",
            "action"           => "import",
            "data"             => "",
            "methodCode"       => "dag_import",
            "methodCodeRC"     => "imp_dags",
            "langCode"         => "api_153",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Data Access Groups",
            "langCodeArea"     => "global_22",
            "method"           => "Delete DAGs",
            "content"          => "dag",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "dag_delete",
            "methodCodeRC"     => "del_dags",
            "langCode"         => "api_154",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Data Access Groups",
            "langCodeArea"     => "global_22",
            "method"           => "Switch DAGs",
            "content"          => "dag",
            "action"           => "switch",
            "data"             => "",
            "methodCode"       => "dag_switch",
            "methodCodeRC"     => "switch_dag",
            "langCode"         => "api_186",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Data Access Groups",
            "langCodeArea"     => "global_22",
            "method"           => "Export User-DAG Assignment",
            "content"          => "userDagMapping",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "userDagMapping_export",
            "methodCodeRC"     => "exp_user_dag_maps",
            "langCode"         => "api_155",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Data Access Groups",
            "langCodeArea"     => "global_22",
            "method"           => "Import User-DAG Assignment",
            "content"          => "userDagMapping",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "userDagMapping_import",
            "methodCodeRC"     => "imp_user_dag_maps",
            "langCode"         => "api_156",
            "langCodeInternal" => ""
        ],
        // Events
        [
            "area"             => "Events",
            "langCodeArea"     => "global_45",
            "method"           => "Export Events",
            "content"          => "event",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "event_export",
            "methodCodeRC"     => "exp_events",
            "langCode"         => "api_62",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Events",
            "langCodeArea"     => "global_45",
            "method"           => "Import Events",
            "content"          => "event",
            "action"           => "import",
            "data"             => "",
            "methodCode"       => "event_import",
            "methodCodeRC"     => "imp_events",
            "langCode"         => "api_84",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Events",
            "langCodeArea"     => "global_45",
            "method"           => "Delete Events",
            "content"          => "event",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "event_delete",
            "methodCodeRC"     => "del_events",
            "langCode"         => "api_85",
            "langCodeInternal" => ""
        ],
        // Field Names
        [
            "area"             => "Field Names",
            "langCodeArea"     => "api_98",
            "method"           => "Export List of Export Field Names",
            "content"          => "exportFieldNames",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "exportFieldNames_export",
            "methodCodeRC"     => "exp_field_names",
            "langCode"         => "api_52",
            "langCodeInternal" => ""
        ],
        // Files
        [
            "area"             => "Files",
            "langCodeArea"     => "api_99",
            "method"           => "Export a File",
            "content"          => "file",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "file_export",
            "methodCodeRC"     => "exp_file",
            "langCode"         => "api_53",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Files",
            "langCodeArea"     => "api_99",
            "method"           => "Import a File",
            "content"          => "file",
            "action"           => "import",
            "data"             => "",
            "methodCode"       => "file_import",
            "methodCodeRC"     => "imp_file",
            "langCode"         => "api_54",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Files",
            "langCodeArea"     => "api_99",
            "method"           => "Delete a File",
            "content"          => "file",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "file_delete",
            "methodCodeRC"     => "del_file",
            "langCode"         => "api_55",
            "langCodeInternal" => ""
        ],
        // File Repository
        [
            "area"             => "File Repository",
            "langCodeArea"     => "app_04",
            "method"           => "Create a New Folder in the File Repository",
            "content"          => "fileRepository",
            "action"           => "createFolder",
            "data"             => "",
            "methodCode"       => "fileRepository_createFolder",
            "methodCodeRC"     => "create_folder_file_repo",
            "langCode"         => "api_209",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "File Repository",
            "langCodeArea"     => "app_04",
            "method"           => "Export a List of Files/Folders from the File Repository",
            "content"          => "fileRepository",
            "action"           => "list",
            "data"             => "",
            "methodCode"       => "fileRepository_list",
            "methodCodeRC"     => "exp_list_file_repo",
            "langCode"         => "api_204",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "File Repository",
            "langCodeArea"     => "app_04",
            "method"           => "Export a File from the File Repository",
            "content"          => "fileRepository",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "fileRepository_export",
            "methodCodeRC"     => "exp_file_repo",
            "langCode"         => "api_193",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "File Repository",
            "langCodeArea"     => "app_04",
            "method"           => "Import a File into the File Repository",
            "content"          => "fileRepository",
            "action"           => "import",
            "data"             => "",
            "methodCode"       => "fileRepository_import",
            "methodCodeRC"     => "imp_file_repo",
            "langCode"         => "api_194",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "File Repository",
            "langCodeArea"     => "app_04",
            "method"           => "Delete a File from the File Repository",
            "content"          => "fileRepository",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "fileRepository_delete",
            "methodCodeRC"     => "del_file_repo",
            "langCode"         => "api_195",
            "langCodeInternal" => ""
        ],
        // Instruments
        [
            "area"             => "Instruments",
            "langCodeArea"     => "global_110",
            "method"           => "Export Instruments (Data Entry Forms)",
            "content"          => "instrument",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "instrument_export",
            "methodCodeRC"     => "exp_instr",
            "langCode"         => "api_56",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Instruments",
            "langCodeArea"     => "global_110",
            "method"           => "Export PDF file of Instruments",
            "content"          => "pdf",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "pdf_export",
            "methodCodeRC"     => "exp_instr_pdf",
            "langCode"         => "api_57",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Instruments",
            "langCodeArea"     => "global_110",
            "method"           => "Export Instrument-Event Mappings",
            "content"          => "formEventMapping",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "formEventMapping_export",
            "methodCodeRC"     => "exp_inst_event_maps",
            "langCode"         => "api_64",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Instruments",
            "langCodeArea"     => "global_110",
            "method"           => "Import Instrument-Event Mappings",
            "content"          => "formEventMapping",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "formEventMapping_import",
            "methodCodeRC"     => "imp_inst_event_maps",
            "langCode"         => "api_81",
            "langCodeInternal" => ""
        ],
        // Logging
        [
            "area"             => "Logging",
            "langCodeArea"     => "app_07",
            "method"           => "Export Logging",
            "content"          => "log",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "log_export",
            "methodCodeRC"     => "exp_logging",
            "langCode"         => "api_158",
            "langCodeInternal" => ""
        ],
        // Metadata
        [
            "area"             => "Metadata",
            "langCodeArea"     => "api_100",
            "method"           => "Export Metadata (Data Dictionary)",
            "content"          => "metadata",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "metadata_export",
            "methodCodeRC"     => "exp_metadata",
            "langCode"         => "api_51",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Metadata",
            "langCodeArea"     => "api_100",
            "method"           => "Import Metadata (Data Dictionary)",
            "content"          => "metadata",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "metadata_import",
            "methodCodeRC"     => "imp_metadata",
            "langCode"         => "api_79",
            "langCodeInternal" => ""
        ],
        // Projects
        /**[
            "area"    => "Projects",
            "method"  => "Create Project",
            "content" => "project",
            "action"  => "import",
            "data"    => true
        ],*/
        [
            "area"             => "Projects",
            "langCodeArea"     => "control_center_134",
            "method"           => "Import Project Info",
            "content"          => "project_settings",
            "action"           => "import",
            "data"             => "",
            "methodCode"       => "project_settings_import",
            "methodCodeRC"     => "imp_proj_sett",
            "langCode"         => "api_133",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Projects",
            "langCodeArea"     => "control_center_134",
            "method"           => "Export Project Info",
            "content"          => "project",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "project_export",
            "methodCodeRC"     => "exp_proj",
            "langCode"         => "api_66",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Projects",
            "langCodeArea"     => "control_center_134",
            "method"           => "Export Project XML",
            "content"          => "project_xml",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "project_xml_export",
            "methodCodeRC"     => "exp_proj_xml",
            "langCode"         => "api_docs_252",
            "langCodeInternal" => ""
        ],
        // Records
        [
            "area"             => "Records",
            "langCodeArea"     => "dashboard_38",
            "method"           => "Export Records",
            "content"          => "record",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "record_export",
            "methodCodeRC"     => "exp_records",
            "langCode"         => "api_48",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Records",
            "langCodeArea"     => "dashboard_38",
            "method"           => "Import Records",
            "content"          => "record",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "record_import",
            "methodCodeRC"     => "imp_records",
            "langCode"         => "api_50",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Records",
            "langCodeArea"     => "dashboard_38",
            "method"           => "Delete Records",
            "content"          => "record",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "record_delete",
            "methodCodeRC"     => "del_records",
            "langCode"         => "api_130",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Records",
            "langCodeArea"     => "dashboard_38",
            "method"           => "Rename Record",
            "content"          => "record",
            "action"           => "rename",
            "data"             => "",
            "methodCode"       => "record_rename",
            "methodCodeRC"     => "rename_record",
            "langCode"         => "api_190",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Records",
            "langCodeArea"     => "dashboard_38",
            "method"           => "Generate Next Record Name",
            "content"          => "generateNextRecordName",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "generateNextRecordName_export",
            "methodCodeRC"     => "exp_next_id",
            "langCode"         => "api_134",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Records",
            "langCodeArea"     => "dashboard_38",
            "method"           => "Randomize Record",
            "content"          => "record",
            "action"           => "randomize",
            "data"             => "",
            "methodCode"       => "record_randomize",
            "methodCodeRC"     => "randomize",
            "langCode"         => "api_220",
            "langCodeInternal" => ""
        ],
        // Repeating Instruments and Events
        [
            "area"             => "Repeating Instruments and Events",
            "langCodeArea"     => "rep_forms_events_01",
            "method"           => "Export Repeating Instruments and Events",
            "content"          => "repeatingFormsEvents",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "repeatingFormsEvents_export",
            "methodCodeRC"     => "exp_repeating_forms_events",
            "langCode"         => "rep_forms_events_02",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Repeating Instruments and Events",
            "langCodeArea"     => "rep_forms_events_01",
            "method"           => "Import Repeating Instruments and Events",
            "content"          => "repeatingFormsEvents",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "repeatingFormsEvents_import",
            "methodCodeRC"     => "imp_repeating_forms_events",
            "langCode"         => "rep_forms_events_05",
            "langCodeInternal" => ""
        ],
        // Reports
        [
            "area"             => "Reports",
            "langCodeArea"     => "app_06",
            "method"           => "Export Reports",
            "content"          => "report",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "report_export",
            "methodCodeRC"     => "exp_reports",
            "langCode"         => "api_49",
            "langCodeInternal" => ""
        ],
        // REDCap
        [
            "area"             => "REDCap",
            "langCodeArea"     => "api_101",
            "method"           => "Export REDCap Version",
            "content"          => "version",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "version_export",
            "methodCodeRC"     => "exp_rc_v",
            "langCode"         => "api_67",
            "langCodeInternal" => ""
        ],
        // Surveys
        [
            "area"             => "Surveys",
            "langCodeArea"     => "dashboard_69",
            "method"           => "Export a Survey Link",
            "content"          => "surveyLink",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "surveyLink_export",
            "methodCodeRC"     => "exp_surv_link",
            "langCode"         => "api_58",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Surveys",
            "langCodeArea"     => "dashboard_69",
            "method"           => "Export Survey Participants",
            "content"          => "participantList",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "participantList_export",
            "methodCodeRC"     => "exp_surv_parts",
            "langCode"         => "api_61",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Surveys",
            "langCodeArea"     => "dashboard_69",
            "method"           => "Export a Survey Queue Link",
            "content"          => "surveyQueueLink",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "surveyQueueLink_export",
            "methodCodeRC"     => "exp_surv_queue_link",
            "langCode"         => "api_59",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Surveys",
            "langCodeArea"     => "dashboard_69",
            "method"           => "Export a Survey Return Code",
            "content"          => "surveyReturnCode",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "surveyReturnCode_export",
            "methodCodeRC"     => "exp_surv_ret_code",
            "langCode"         => "api_60",
            "langCodeInternal" => ""
        ],
        // Users & User Privileges
        [
            "area"             => "Users & User Privileges",
            "langCodeArea"     => "api_docs_228",
            "method"           => "Export Users",
            "content"          => "user",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "user_export",
            "methodCodeRC"     => "exp_users",
            "langCode"         => "api_65",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Users & User Privileges",
            "langCodeArea"     => "api_docs_228",
            "method"           => "Import Users",
            "content"          => "user",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "user_import",
            "methodCodeRC"     => "imp_users",
            "langCode"         => "api_80",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "Users & User Privileges",
            "langCodeArea"     => "api_docs_228",
            "method"           => "Delete Users",
            "content"          => "user",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "user_delete",
            "methodCodeRC"     => "del_users",
            "langCode"         => "api_159",
            "langCodeInternal" => ""
        ],
        // User Roles
        [
            "area"             => "User Roles",
            "langCodeArea"     => "api_162",
            "method"           => "Export User Roles",
            "content"          => "userRole",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "userRole_export",
            "methodCodeRC"     => "exp_user_roles",
            "langCode"         => "api_163",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "User Roles",
            "langCodeArea"     => "api_162",
            "method"           => "Import User Roles",
            "content"          => "userRole",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "userRole_import",
            "methodCodeRC"     => "imp_user_roles",
            "langCode"         => "api_164",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "User Roles",
            "langCodeArea"     => "api_162",
            "method"           => "Delete User Roles",
            "content"          => "userRole",
            "action"           => "delete",
            "data"             => "",
            "methodCode"       => "userRole_delete",
            "methodCodeRC"     => "del_user_roles",
            "langCode"         => "api_165",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "User Roles",
            "langCodeArea"     => "api_162",
            "method"           => "Export User-Role Assignment",
            "content"          => "userRoleMapping",
            "action"           => "export",
            "data"             => "",
            "methodCode"       => "userRoleMapping_export",
            "methodCodeRC"     => "exp_user_role_maps",
            "langCode"         => "api_172",
            "langCodeInternal" => ""
        ],
        [
            "area"             => "User Roles",
            "langCodeArea"     => "api_162",
            "method"           => "Import User-Role Assignment",
            "content"          => "userRoleMapping",
            "action"           => "import",
            "data"             => true,
            "methodCode"       => "userRoleMapping_import",
            "methodCodeRC"     => "imp_user_role_maps",
            "langCode"         => "api_173",
            "langCodeInternal" => ""
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
        global $lang;
        try {
            if ( empty($project_id) ) {
                $settingName                = 'default-rights-json-system';
                $currentDefaultRightsString = $this->framework->getSystemSetting($settingName) ?? '{}';
                $defaultRightsTitle         = $this->framework->tt('default_rights_title_system');
                $defaultRightsDesc          = $this->framework->tt('default_rights_description_system');
            } else {
                $settingName                = 'default-rights-json-project';
                $currentDefaultRightsString = $this->framework->getProjectSetting($settingName, $project_id) ?? '{}';
                $defaultRightsTitle         = $this->framework->tt('default_rights_title_project');
                $defaultRightsDesc          = $this->framework->tt('default_rights_description_project');
            }
            $currentDefaultRights = json_decode($currentDefaultRightsString, true);
            $headerInfo           = $this->getTableHeader();
            $odd                  = true;
            $nameData             = "<tr id='default-rights-field'>
                                <td colspan='3'>
                                    <p><span class='font-weight-bold'>" . $defaultRightsTitle . "</span><br>" . $defaultRightsDesc . "</p>
                                    <div class='row row-cols-1 row-cols-sm-2 row-cols-lg-3'>";
            foreach ( $headerInfo['sections'] as $section => $methods ) {
                $cardClass = $odd ? 'odd' : 'even';
                $odd       = !$odd;
                $nameData .= "<div class='col card-container g-2'><div class='card h-100 " . $cardClass . "'><div class='card-body'><h5 class='card-title'>" . $section . "</h5>";
                foreach ( $methods as $method ) {
                    $name     = $method["content"] . "_" . $method['action'];
                    $checked  = ($currentDefaultRights[$name] ?? '') == '1' ? 'checked' : '';
                    $nameData .= "<div class='form-check'><input class='form-check-input default-api-rights-input' type='checkbox' id='" . $name . "' name='" . $name . "' value='' " . $checked . "><label class='form-check-label' for='" . $name . "'>" . $lang[$method['langCode']] . "</label></div>";
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

    public function redcap_module_api_before($project_id, $post) : void 
    {
        try {

            // If content is not valid, let REDCap handle it
            $contentValid = $this->validateContent($post);
            if ( !$contentValid ) {
                return;
            }

            $username = $post['username'] ?? '';
            $pid      = $post['projectid'] ?? '';

            // Invalid token, let REDCap handle it
            if ( empty($username) || empty($pid) ) {
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
                echo json_encode([ 'error' => $this->framework->tt('permission_denied') ]);
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

        $methodArr = array_filter(self::$methods, function ($method) use ($content, $action): bool {
            return ($method['content'] ?? '') === $content
                && ($method['action'] ?? '') === $action;
        });
        return reset($methodArr);
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
        global $lang;
        $header         = "<thead><tr><th rowspan='2'>".$this->framework->tt('username')."</th>";
        $header2        = "";
        $sections       = [];
        $allMethods     = [];
        $allMethodCodes = [];
        $even           = true;
        foreach ( ApiUserRights::$methods as $method ) {
            $sections[$lang[$method['langCodeArea']]][] = $method;
        }
        foreach ( $sections as $section => $methods ) {
            $thisClass = $even ? 'even' : 'odd';
            $even      = !$even;
            $header .= "<th colspan='" . count($methods) . "' class='" . $thisClass . "'>" . $section . "</th>";
            foreach ( $methods as $method ) {
                $thisMethod       = $lang[$method['langCode']];
                $allMethods[]     = $thisMethod;
                $allMethodCodes[] = $method['methodCode'];
                $header2 .= "<th class='" . $thisClass . " dt-center'>" . $thisMethod . "</th>";
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
