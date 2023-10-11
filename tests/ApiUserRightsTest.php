<?php

namespace YaleREDCap\ApiUserRights;


require_once __DIR__ . '/../../../redcap_connect.php';

class ApiUserRightsTest extends \ExternalModules\ModuleBaseTest
{

    static array $content = [
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
        'userRoleMapping',
        'invalid'
    ];

    static array $actions = [
        'export',
        'import',
        'switch',
        'delete',
        'createFolder',
        'rename',
        'list',
        '',
        'invalid'
    ];

    static array $hasData = [
        true,
        false
    ];

    static array $results = [
        [
            'content'       => 'record',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'record',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'record',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'record',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'record',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'record',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'record',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'rename'
        ],
        [
            'content'       => 'record',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'rename'
        ],
        [
            'content'       => 'record',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'record',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'record',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'record',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'record',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'record',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'metadata',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'metadata',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'metadata',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'file',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'file',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'file',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'file',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'file',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'file',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'file',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'file',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'file',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'file',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'file',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'file',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'file',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'file',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'fileRepository',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'fileRepository',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'fileRepository',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'fileRepository',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'repeatingFormsEvents',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'repeatingFormsEvents',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'instrument',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'instrument',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'instrument',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'event',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'event',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'event',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'event',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'event',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'event',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'event',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'event',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'event',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'event',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'event',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'event',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'event',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'event',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'event',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'event',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'event',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'event',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'event',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'event',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'arm',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'arm',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'arm',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'arm',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'arm',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'arm',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'arm',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'arm',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'arm',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'arm',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'arm',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'arm',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'arm',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'arm',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'arm',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'arm',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'arm',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'arm',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'arm',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'arm',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'user',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'user',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'user',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'user',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'user',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'user',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'user',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'user',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'user',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'user',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'user',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'user',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'project_settings',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_settings',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'project_settings',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'report',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'report',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'report',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'report',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'version',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'version',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'pdf',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'pdf',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'pdf',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyLink',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'surveyLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyQueueLink',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'surveyQueueLink',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'surveyReturnCode',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'surveyReturnCode',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'participantList',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'participantList',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'participantList',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'exportFieldNames',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'exportFieldNames',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'formEventMapping',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'formEventMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'project',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'project',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'generateNextRecordName',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'generateNextRecordName',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'project_xml',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'project_xml',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'project_xml',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'dag',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'dag',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'dag',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'dag',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'dag',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'dag',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'dag',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'dag',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'dag',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'dag',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'dag',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'dag',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'dag',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'dag',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'dag',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'dag',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'dag',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'dag',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'dag',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'dag',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userDagMapping',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'userDagMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'log',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'log',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'log',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'log',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'switch'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'delete'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'createFolder'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'userRole',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'list'
        ],
        [
            'content'       => 'userRole',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'userRole',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'userRole',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRole',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'import'
        ],
        [
            'content'       => 'userRoleMapping',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => 'userRoleMapping',
            'resultAction'  => 'export'
        ],
        [
            'content'       => 'invalid',
            'action'        => 'export',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'export',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'import',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'import',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'switch',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'switch',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'delete',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'delete',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'createFolder',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'createFolder',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'rename',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'rename',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'list',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'list',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => '',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => '',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'invalid',
            'hasData'       => true,
            'resultContent' => '',
            'resultAction'  => ''
        ],
        [
            'content'       => 'invalid',
            'action'        => 'invalid',
            'hasData'       => false,
            'resultContent' => '',
            'resultAction'  => ''
        ]
    ];


    public function testGetMethodWithAllCombinationsOfContentActionsAndHasData()
    {

        $apiUserRights = new ApiUserRights();

        foreach ( self::$content as $content ) {
            foreach ( self::$actions as $action ) {
                foreach ( self::$hasData as $hasData ) {
                    $methodResult = $apiUserRights->getMethod($content, $action, $hasData);

                    $realResults = array_filter(self::$results, function ($result) use ($content, $action, $hasData) {
                        return $result['content'] == $content && $result['action'] == $action && $result['hasData'] == $hasData;
                    });
                    $realResult  = reset($realResults);

                    if ( $realResult['resultContent'] != $methodResult['content'] || $realResult['resultAction'] != $methodResult['action'] ) {
                        var_dump($content, $action, $hasData);
                    }

                    $this->assertEquals($realResult['resultContent'], $methodResult['content']);
                    $this->assertEquals($realResult['resultAction'], $methodResult['action']);

                }
            }
        }
    }




}