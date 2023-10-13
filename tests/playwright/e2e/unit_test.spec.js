
const fs = require('fs');
const { parse } = require('csv-parse/sync');
const { stringify } = require('csv-stringify/sync');
const { transform } = require('stream-transform/sync');
const { test, expect } = require('../fixtures/initModule');
const { config } = require('../fixtures/config');

// Annotate entire file as serial.
test.describe.configure({ mode: 'serial' });

// Set up API context
/**
 * @type {import('@playwright/test').APIRequestContext} apiContext
 */
let apiContext;
test.beforeAll(async ({ playwright }) => {
    apiContext = await playwright.request.newContext({
        baseURL: config.redcapUrl + '/api/',
        extraHTTPHeaders: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Accept': 'application/json'
        },
    });
});
test.afterAll(async () => {
    await apiContext.dispose();
});


// Start tests
test.describe('Setup', () => {
    test('Setup system and projects', async ({ modulePage }, testInfo) => {
        //test.setTimeout(300000);
        await test.step('Setup project', async () => {
            config.projects.Project.pid = await modulePage.createProject(config.projects.Project.projectName, config.projects.Project.xml);
            await modulePage.grantAllRightsToUser(config.projects.Project.pid, config.users.AdminUser.username);
        });
    });
});

test.describe('Test the API', () => {
    test('Make sure all API calls work when module is not enabled', async ({ modulePage }, testInfo) => {
        //test.setTimeout(300000);
        // await test.step('Enable module', async () => {
        //     await modulePage.enableModule(config.projects.Project.pid);
        //     await expect(modulePage.page.locator(`table#external-modules-enabled tr[data-module="${config.module.name}"]`, { timeout: 30000 })).toBeVisible();
        // });

        await test.step('Disable module at system level', async () => {
            await modulePage.disableModuleSystemWide();
        });

        await test.step('Enable API and get token', async () => {
            config.api_token = await modulePage.getApiToken(config.projects.Project.pid);
        });

        await test.step('API Method: Export Arms', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'arm',
                    returnFormat: 'json'
                }
            });
            const responseJson = await response.json();
            await expect(responseJson.error).toEqual('You cannot export arms for classic projects');
        });

        await test.step('API Method: Import Arms', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    action: 'import',
                    content: 'arm',
                    data: `[{"arm_num":"1","name":"Drug A"},
                    {"arm_num":"2","name":"Drug B"},
                    {"arm_num":"3","name":"Drug C"}]`,
                    returnFormat: 'json'
                }
            });
            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Arms', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    action: 'delete',
                    content: 'arm',
                    returnFormat: 'json'
                }
            });
            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'arms' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");
        });

        await test.step('API Method: Export DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    action: 'import',
                    data: `[{"data_access_group_name":"CA Site","unique_group_name":"ca_site"}
                    {"data_access_group_name":"FL Site","unique_group_name":"fl_site"},
                    {"data_access_group_name":"New Site","unique_group_name":""}]`,
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'dags' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");

        });

        await test.step('API Method: Switch DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    action: 'switch',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export User-DAG Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userDagMapping',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import User-DAG Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userDagMapping',
                    action: 'import',
                    data: `[{"username":"admin","redcap_data_access_group":"ca_site"}]`,
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'event',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You cannot export events for classic projects");
        });

        await test.step('API Method: Import Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'event',
                    action: 'import',
                    data: `[{"event_name":"Baseline","arm_num":"1","day_offset":"1","offset_min":"0",
                    "offset_max":"0","unique_event_name":"baseline_arm_1"}]`,
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'event',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export List of Export Field Names', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'exportFieldNames',
                    returnFormat: 'json'
                }
            });
            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export a File', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'file',
                    action: 'export',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The record '' does not exist");
        });

        await test.step('API Method: Import a File', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'file',
                    action: 'import',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("No valid file was uploaded");
        });

        await test.step('API Method: Delete a File', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'file',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The record '' does not exist");
        });

        await test.step('API Method: Create a New Folder in the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'createFolder',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("new folder 'name' not provided");
        });

        await test.step('API Method: Export a List of Files/Folders from the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'list',
                    data: '',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export a File from the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'export',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("Invalid doc_id or missing doc_id");
        });

        await test.step('API Method: Import a File into the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'import',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("No valid file was uploaded");
        });

        await test.step('API Method: Delete a File from the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("Invalid doc_id or missing doc_id");
        });

        await test.step('API Method: Export Instruments (Data Entry Forms)', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'instrument',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export PDF file of Instruments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'pdf',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Instrument-Event Mappings', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'formEventMapping',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You cannot export form/event mappings for classic projects");
        });

        await test.step('API Method: Import Instrument-Event Mappings', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'formEventMapping',
                    data: `[{"arm_num":"1","unique_event_name":"baseline_arm_1","form":"demographics"}]`,
                    format: 'json',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The arm number \"1\" does not exist in the project.\nThe unique event name \"baseline_arm_1\" does not exist in the project.\nThe instrument name (i.e., the unique form name) \"demographics\" does not exist in the project.");
        });

        await test.step('API Method: Export Logging', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'log',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Metadata (Data Dictionary)', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'metadata',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import Metadata (Data Dictionary)', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'metadata',
                    data: '[{"field_name":"record_id","form_name":"form_1"}]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Create A New Project', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You do not have permissions to use the API 'Create Project' method. You must have been granted a 64-character Super API Token from a REDCap administrator in order to utilize this method.");
        });

        await test.step('API Method: Import Project Information', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project_settings',
                    data: '[]',
                    format: 'json',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Project Information', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Project XML', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project_xml',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Records', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import Records', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    data: '[]',
                    format: 'json',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Records', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'records' parameter is an empty array. The parameter must be an array containing one or more record names to delete.");
        });

        await test.step('API Method: Rename Record', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    action: 'rename',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Generate Next Record Name', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'generateNextRecordName',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Repeating Instruments and Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'repeatingFormsEvents',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You cannot export repeating instruments and events because the project does not contain any repeating instruments and events");
        });

        await test.step('API Method: Import Repeating Instruments and Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'repeatingFormsEvents',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Reports', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'report',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The API request cannot complete because report_id= does not belong to this project.");
        });

        await test.step('API Method: Export REDCap Version', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'version',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });


        await test.step('API Method: Export a Survey Link for a Participant', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'surveyLink',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'record' is missing");
        });

        await test.step('API Method: Export a Survey Participant List', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'participantList',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'instrument' is missing");
        });

        await test.step('API Method: Export a Survey Queue Link for a Participant', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'surveyQueueLink',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'record' is missing");
        });

        await test.step('API Method: Export a Survey Return Code for a Participant', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'surveyReturnCode',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'record' is missing");
        });

        await test.step('API Method: Export Users', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'user',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import Users', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'user',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Users', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'user',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'users' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");
        });

        await test.step('API Method: Export User Roles', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRole',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import User Roles', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRole',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete User Roles', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRole',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'roles' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");
        });

        await test.step('API Method: Export User-Role Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRoleMapping',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import User-Role Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRoleMapping',
                    action: 'import',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });


    });

    test('Make sure all API calls work when module is enabled system-wide but not in the project', async ({ modulePage }, testInfo) => {
        await test.step('Log in and enable module', async () => {
            await modulePage.enableModuleSystemWide();
        });

        await test.step('Do not enable on all projects by default', async () => {
            await modulePage.openModuleSystemConfiguration();
            const checkbox = await (modulePage.page.locator('input[name="enabled"]'));
            await checkbox.uncheck();
        });

        await test.step('API Method: Export Arms', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'arm',
                    returnFormat: 'json'
                }
            });
            const responseJson = await response.json();
            await expect(responseJson.error).toEqual('You cannot export arms for classic projects');
        });

        await test.step('API Method: Import Arms', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    action: 'import',
                    content: 'arm',
                    data: `[{"arm_num":"1","name":"Drug A"},
                    {"arm_num":"2","name":"Drug B"},
                    {"arm_num":"3","name":"Drug C"}]`,
                    returnFormat: 'json'
                }
            });
            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Arms', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    action: 'delete',
                    content: 'arm',
                    returnFormat: 'json'
                }
            });
            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'arms' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");
        });

        await test.step('API Method: Export DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    action: 'import',
                    data: `[{"data_access_group_name":"CA Site","unique_group_name":"ca_site"}
                    {"data_access_group_name":"FL Site","unique_group_name":"fl_site"},
                    {"data_access_group_name":"New Site","unique_group_name":""}]`,
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'dags' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");

        });

        await test.step('API Method: Switch DAGs', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'dag',
                    action: 'switch',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export User-DAG Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userDagMapping',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import User-DAG Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userDagMapping',
                    action: 'import',
                    data: `[{"username":"admin","redcap_data_access_group":"ca_site"}]`,
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'event',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You cannot export events for classic projects");
        });

        await test.step('API Method: Import Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'event',
                    action: 'import',
                    data: `[{"event_name":"Baseline","arm_num":"1","day_offset":"1","offset_min":"0",
                    "offset_max":"0","unique_event_name":"baseline_arm_1"}]`,
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'event',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export List of Export Field Names', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'exportFieldNames',
                    returnFormat: 'json'
                }
            });
            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export a File', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'file',
                    action: 'export',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The record '' does not exist");
        });

        await test.step('API Method: Import a File', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'file',
                    action: 'import',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("No valid file was uploaded");
        });

        await test.step('API Method: Delete a File', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'file',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The record '' does not exist");
        });

        await test.step('API Method: Create a New Folder in the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'createFolder',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("new folder 'name' not provided");
        });

        await test.step('API Method: Export a List of Files/Folders from the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'list',
                    data: '',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export a File from the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'export',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("Invalid doc_id or missing doc_id");
        });

        await test.step('API Method: Import a File into the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'import',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("No valid file was uploaded");
        });

        await test.step('API Method: Delete a File from the File Repository', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'fileRepository',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("Invalid doc_id or missing doc_id");
        });

        await test.step('API Method: Export Instruments (Data Entry Forms)', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'instrument',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export PDF file of Instruments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'pdf',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Instrument-Event Mappings', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'formEventMapping',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You cannot export form/event mappings for classic projects");
        });

        await test.step('API Method: Import Instrument-Event Mappings', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'formEventMapping',
                    data: `[{"arm_num":"1","unique_event_name":"baseline_arm_1","form":"demographics"}]`,
                    format: 'json',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The arm number \"1\" does not exist in the project.\nThe unique event name \"baseline_arm_1\" does not exist in the project.\nThe instrument name (i.e., the unique form name) \"demographics\" does not exist in the project.");
        });

        await test.step('API Method: Export Logging', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'log',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Metadata (Data Dictionary)', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'metadata',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import Metadata (Data Dictionary)', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'metadata',
                    data: '[{"field_name":"record_id","form_name":"form_1"}]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Create A New Project', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You do not have permissions to use the API 'Create Project' method. You must have been granted a 64-character Super API Token from a REDCap administrator in order to utilize this method.");
        });

        await test.step('API Method: Import Project Information', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project_settings',
                    data: '[]',
                    format: 'json',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Project Information', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Project XML', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'project_xml',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Records', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import Records', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    data: '[]',
                    format: 'json',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Records', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'records' parameter is an empty array. The parameter must be an array containing one or more record names to delete.");
        });

        await test.step('API Method: Rename Record', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'record',
                    action: 'rename',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Generate Next Record Name', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'generateNextRecordName',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Repeating Instruments and Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'repeatingFormsEvents',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("You cannot export repeating instruments and events because the project does not contain any repeating instruments and events");
        });

        await test.step('API Method: Import Repeating Instruments and Events', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'repeatingFormsEvents',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Export Reports', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'report',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The API request cannot complete because report_id= does not belong to this project.");
        });

        await test.step('API Method: Export REDCap Version', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'version',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });


        await test.step('API Method: Export a Survey Link for a Participant', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'surveyLink',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'record' is missing");
        });

        await test.step('API Method: Export a Survey Participant List', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'participantList',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'instrument' is missing");
        });

        await test.step('API Method: Export a Survey Queue Link for a Participant', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'surveyQueueLink',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'record' is missing");
        });

        await test.step('API Method: Export a Survey Return Code for a Participant', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'surveyReturnCode',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The parameter 'record' is missing");
        });

        await test.step('API Method: Export Users', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'user',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import Users', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'user',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete Users', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'user',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'users' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");
        });

        await test.step('API Method: Export User Roles', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRole',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import User Roles', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRole',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Delete User Roles', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRole',
                    action: 'delete',
                    returnFormat: 'json'
                }
            });

            const responseJson = await response.json();
            await expect(responseJson.error).toEqual("The 'roles' parameter is either missing or is not an array. It must be provided as an array even if it only contains one value.");
        });

        await test.step('API Method: Export User-Role Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRoleMapping',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });

        await test.step('API Method: Import User-Role Assignments', async () => {
            const response = await apiContext.post('', {
                form: {
                    token: config.api_token,
                    content: 'userRoleMapping',
                    action: 'import',
                    data: '[]',
                    returnFormat: 'json'
                }
            });

            await expect(response.ok()).toBeTruthy();
        });
    });


});