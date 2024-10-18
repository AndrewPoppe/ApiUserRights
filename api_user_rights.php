<?php

namespace YaleREDCap\ApiUserRights;

/** @var ApiUserRights $module */

global $lang;
$pid = $module->framework->getProjectId();
$module->framework->initializeJavascriptModuleObject();
$module->framework->tt_transferToJavascriptModuleObject();
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
        <?= $module->framework->tt('module_title') ?>
    </span>
</div>
<div class="table-container">
    <div class="info">
        <p><?= $module->framework->tt('module_info') ?></p>
        <div class="container m-0 g-0">
            <div class="row align-items-center g-0">
                <div class="col-auto">
                    <button class="btn btn-xs btn-outline-secondary" onclick="API_USER_RIGHTS.saveSnapshot();">
                        <i class="fa-solid fa-camera"></i> <?= $module->framework->tt('snapshot_button_text') ?>
                    </button>
                </div>
                <div class="col ml-1">
                    <span style="font-size: smaller;"><?= $module->framework->tt('snapshot_label') ?> <a data-bs-toggle="tooltip"
                            data-bs-title="<?= $module->framework->tt('snapshot_tooltip') ?>" id="snapshotModalLink" href="#"
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
                        <input class="form-control form-control-sm search" type="text" placeholder="<?= $module->framework->tt('filter_methods') ?>"
                            aria-label="Filter API Methods" id="aur-filter-methods">
                        <span class="input-group-text filter-icon fs12" id="filter-icon">
                            <i class="fa-solid fa-filter fa-fw"></i>
                        </span>
                        <button class="btn btn-sm btn-secondary btn-filter-clear fs12 text-danger" type="button"
                            title="<?= $module->framework->tt('clear_filter') ?>" id="filter-clear-button" style="display: none;"
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
                        <?php
                        $odd = true;
                        foreach ( $headerInfo["sections"] as $section => $methods ) {
                            $cardClass = $odd ? "odd" : "even";
                            $odd       = !$odd;
                            ?>
                            <div class="col card-container g-2">
                                <div class="card h-100 <?= $cardClass ?>">
                                    <h5 class="card-header">
                                        <?= $section ?>
                                    </h5>
                                    <div class="card-body">
                                        <?php foreach ( $methods as $method ) { ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="<?= $method["methodCode"] ?>" name="<?= $method["methodCode"] ?>">
                                                <label class="form-check-label mb-2" for="<?= $method["methodCode"] ?>">
                                                    <?= $lang[$method['langCode']] ?>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $module->framework->tt('cancel') ?></button>
                <button type="button" class="btn btn-primary" id="saveRightsButton"
                    onclick="API_USER_RIGHTS.submitForm()"><?= $module->framework->tt('save_changes') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="snapshotsModal">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title nowrap"><?= $module->framework->tt('snapshots_title') ?></h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" id="api_user_rights_snapshots" class="compact hover">
                    <thead>
                        <tr>
                            <th><?= $module->framework->tt('snapshot_taken_at') ?></th>
                            <th><?= $module->framework->tt('snapshot_taken_by') ?></th>
                            <th><?= $module->framework->tt('snapshot_download_csv') ?></th>
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