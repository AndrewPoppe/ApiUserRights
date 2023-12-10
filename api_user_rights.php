<?php

namespace YaleREDCap\ApiUserRights;

/** @var ApiUserRights $module */

$pid = $module->framework->getProjectId();
$module->framework->initializeJavascriptModuleObject();
$headerInfo = $module->getTableHeader();

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">
<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/b-2.4.2/b-html5-2.4.2/datatables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/v/dt/dt-1.13.8/b-2.4.2/b-html5-2.4.2/datatables.min.js"></script>
<link rel="stylesheet" href="<?= $module->framework->getUrl('api_user_rights.css') ?>">
<div class="projhdr">
    <i class='fa-solid fa-laptop-code'></i>&nbsp;<span>
        API User Rights
    </span>
</div>
<div class="table-container">
    <div class="info">
        <p>
            This page allows you to manage API user rights for this project. You can edit rights for individual users
            by clicking on their username. You can also import and export rights for all users in this project.
        </p>
        <div class="container m-0 g-0">
            <div class="row align-items-center g-0">
                <div class="col-auto">
                    <button class="btn btn-xs btn-outline-secondary" onclick="API_USER_RIGHTS.saveSnapshot();">
                        <i class="fa-solid fa-camera"></i> Save snapshot of API user rights
                    </button>
                </div>
                <div class="col ml-1">
                    <span style="font-size: smaller;">Latest snapshot: <a data-bs-toggle="tooltip"
                            data-bs-title="Click to see all snapshots for this project" id="snapshotModalLink" href="#"
                            onclick="API_USER_RIGHTS.openSnapshotModal();">
                            <?= $module->getLastSnapshotText(); ?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <input type="file" accept="text/csv" class="form-control-file" id="importUsersFile" aria-hidden hidden>
    <table id="api_user_rights" class="table scroll-border">
        <?= $headerInfo["header"] ?>
        <tbody></tbody>
    </table>
</div>
<div class="modal" data-backdrop="static" data-keyboard="false" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" id="editor">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title nowrap"></h5>
                <div class="d-flex justify-content-end w-100">
                    <div class="input-group input-group-sm mb-1 w-auto">
                        <input class="form-control form-control-sm search" type="text" placeholder="Filter methods"
                            aria-label="Filter API Methods" id="aur-filter-methods">
                        <span class="input-group-text filter-icon fs12" id="filter-icon">
                            <i class="fa-solid fa-filter fa-fw"></i>
                        </span>
                        <button class="btn btn-sm btn-secondary btn-filter-clear fs12 text-danger" type="button"
                            title="Clear filter" id="filter-clear-button" style="display: none;"
                            onclick="API_USER_RIGHTS.clearFilter();">
                            <i class="fa-solid fa-filter-circle-xmark fa-fw"></i>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editorForm">
                    <div
                        class="row row-cols-1 row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6">
                        <?php foreach ( $headerInfo["sections"] as $section => $methods ) { ?>
                            <div class="col card-container px-2">
                                <div class="card mb-3">
                                    <h5 class="card-header bg-light">
                                        <?= $section ?>
                                    </h5>
                                    <div class="card-body">
                                        <?php foreach ( $methods as $method ) { ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="<?= $method["method"] ?>" name="<?= $method["method"] ?>">
                                                <label class="form-check-label mb-2" for="<?= $method["method"] ?>">
                                                    <?= $method["method"] ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <span id="changeInfo" class="changeInfo"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveRightsButton"
                    onclick="API_USER_RIGHTS.submitForm()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="snapshotsModal">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title nowrap">API User Rights Snapshots</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" id="api_user_rights_snapshots" class="compact hover">
                    <thead>
                        <tr>
                            <th>Snapshot taken at</th>
                            <th>Snapshot taken by</th>
                            <th>Download snapshot CSV</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const API_USER_RIGHTS = <?= $module->framework->getJavascriptModuleObjectName() ?>;
    </script>
    <script src="<?= $module->framework->getUrl('api_user_rights.js') ?>"></script>