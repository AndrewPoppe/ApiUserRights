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

    public function testGetMethodWithAllCombinationsOfContentActionsAndHasData()
    {

        $apiUserRights = new ApiUserRights();
        $results       = json_decode(file_get_contents(__DIR__ . '/testData.json'), true);

        foreach ( self::$content as $content ) {
            foreach ( self::$actions as $action ) {
                foreach ( self::$hasData as $hasData ) {
                    $methodResult = $apiUserRights->getMethod($content, $action, $hasData);

                    $realResults = array_filter($results, function ($result) use ($content, $action, $hasData) {
                        return $result['content'] == $content && $result['action'] == $action && $result['hasData'] == ($hasData ? "TRUE" : "FALSE");
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