<?php

namespace YaleREDCap\ApiUserRights;

/** @var ApiUserRights $module */

$pid = $module->framework->getProjectId();
$module->framework->initializeJavascriptModuleObject();
$headerInfo = $module->getTableHeader();
?>
<div class="projhdr">
    <i class='fa-solid fa-laptop-code'></i>&nbsp;<span>
        API User Rights
    </span>
</div>
<div class="container" style="width: 75vw !important; display: inline-block;">
    <table id="api_user_rights" class="table compact scroll-border">
        <?= $headerInfo["header"] ?>
        <tbody></tbody>
    </table>
</div>
<div class="modal" id="editor">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #e9e9e9;">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editorForm">
                    <div class="card-columns">
                        <?php foreach ( $headerInfo["sections"] as $section => $methods ) { ?>
                            <div class="card mb-3">
                                <h5 class="card-header" style="background-color:#00000017;">
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
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveRightsButton"
                    onclick="API_USER_RIGHTS.submitForm()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    const API_USER_RIGHTS = <?= $module->framework->getJavascriptModuleObjectName() ?>;
    API_USER_RIGHTS.openRightsEditor = function (username) {
        const data = JSON.parse($('#aur_' + username).data('rights'));
        $('#editorForm').find('input[type="checkbox"]').each(function (i, el) {
            $(el).prop('checked', data[$(el).attr('name')] ? true : false);
        });
        $('#editor').find('.modal-title').html('<i class="fas fa-user-edit"></i> Editing ' + username);
        $('#editor form#editorForm').data('user', username);
        $('#editor').modal('show');
    }

    API_USER_RIGHTS.submitForm = function () {
        const formData = {};
        $('form#editorForm input:checkbox').each((i, el) => {
            formData[el.name] = el.checked;
        });
        API_USER_RIGHTS.ajax('saveApiUserRights', { user: $('form#editorForm').data('user'), rights: formData })
            .then(response => {
                $('#editor').modal('hide');
                Swal.fire({ title: 'Successfully updated API user rights', icon: 'success' });
                $('#api_user_rights').DataTable().ajax.reload();
            })
            .catch(error => {
                console.error(error);
            });
    }

    $(document).ready(function () {
        let table = $('#api_user_rights').DataTable({
            processing: true,
            deferRender: true,
            ajax: function (data, callback, settings) {
                API_USER_RIGHTS.ajax('getApiUserRights', {})
                    .then(response => {
                        console.log(response)
                        callback({ data: response });
                    })
                    .catch(error => {
                        console.error(error);
                    })
            },
            columns: [
                {
                    data: function (row, type, val, meta) {
                        if (type === 'display') {
                            return '<a href="javascript:void(0)" onclick="API_USER_RIGHTS.openRightsEditor(\'' + row["username"] + '\');"><span style="white-space: nowrap;"><strong>' + row["username"] + '</strong> (' + row['name'] + ')</span></a>';
                        }
                        return row["username"];
                    },
                    createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
                        $(cell).data('rights', JSON.stringify(rowData));
                        $(cell).attr('id', 'aur_' + rowData['username']);
                    }
                },
                <?php
                foreach ( $headerInfo["methodOrder"] as $method ) {
                    echo "{ data: function (row, type, val, meta) { return row['" . $method . "'] ? '<i class=\"fas fa-check fa-xl text-success\"></i>' : '<i class=\"fas fa-xmark fa-sm text-danger\"></i>';}, className: 'dt-center' },";
                }
                ?>
            ],
            scrollX: true,
        });
    });
</script>
<style>
    table.scroll-border tbody td:first-child {
        border-left: none !important;
    }

    table.scroll-border tbody td {
        border-left: 1px solid #dee2e6;
    }

    table.scroll-border tbody tr:first-child td {
        border-top: none !important;
    }

    table.scroll-border thead tr th {
        border-top: none !important;
    }

    table.scroll-border thead th:first-child {
        border-left: none !important;
    }

    table.scroll-border thead th {
        border-left: 1px solid #dee2e6;
    }

    table.scroll-border thead th.even {
        background-color: #eeeeee;
    }

    table.scroll-border thead th.odd {
        background-color: #fcfef5;
    }

    div.dataTables_scroll {
        border: 1px solid #aaa;
    }

    div.dataTables_scrollBody {
        border: none !important;
    }

    @media (min-width: 768px) {
        .card-columns {
            column-count: 1;
        }
    }

    @media (min-width: 992px) {
        .card-columns {
            column-count: 2;
        }
    }

    @media (min-width: 1200px) {
        .card-columns {
            column-count: 3;
        }
    }
</style>