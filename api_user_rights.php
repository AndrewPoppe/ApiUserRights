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
<div class="table-container">
    <table id="api_user_rights" class="table scroll-border">
        <?= $headerInfo["header"] ?>
        <tbody></tbody>
    </table>
</div>
<div class="modal" data-backdrop="static" data-keyboard="false" id="editor">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #aaa;">
                <h5 class="modal-title nowrap"></h5>
                <div class="d-flex justify-content-end w-100">
                    <div class="input-group input-group-sm mb-1 w-50">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editorForm">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                        <?php foreach ( $headerInfo["sections"] as $section => $methods ) { ?>
                            <div class="col card-container px-2">
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
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <span class="changeInfo"></span>
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
        $("#aur-filter-methods").val('').trigger('keyup');
        const data = JSON.parse($('#aur_' + username).data('rights'));
        $('#editorForm').find('input[type="checkbox"]').each(function (i, el) {
            const checked = data[$(el).attr('name')] ? true : false;
            $(el).prop('checked', checked);
            $(el).data('origChecked', checked);
        });
        $('#editor').find('.modal-title').html('<i class="fas fa-user-edit"></i> Editing ' + username);
        $('#editor form#editorForm').data('user', username);
        $('#saveRightsButton').attr('disabled', true);
        $('#editor').modal('show');
    }

    API_USER_RIGHTS.submitForm = function () {
        const formData = {};
        $('form#editorForm input:checkbox').each((i, el) => {
            formData[el.name] = el.checked;
        });
        API_USER_RIGHTS.ajax('saveApiUserRights', {
            user: $('form#editorForm').data('user'),
            rights: formData
        })
            .then(response => {
                $('#editor').modal('hide');
                Swal.fire({
                    title: 'Successfully updated API user rights',
                    icon: 'success'
                });
                $('#api_user_rights').DataTable().ajax.reload();
            })
            .catch(error => {
                console.error(error);
            });
    }

    API_USER_RIGHTS.clearFilter = function () {
        $('#aur-filter-methods').val('').trigger('keyup');
    }

    $(document).ready(function () {
        let table = $('#api_user_rights').DataTable({
            processing: true,
            deferRender: true,
            ajax: function (data, callback, settings) {
                API_USER_RIGHTS.ajax('getApiUserRights', {})
                    .then(response => {
                        console.log(response)
                        callback({
                            data: response
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    })
            },
            columns: [{
                data: function (row, type, val, meta) {
                    if (type === 'display') {
                        return '<a href="javascript:void(0)" onclick="API_USER_RIGHTS.openRightsEditor(\'' +
                            row["username"] +
                            '\');"><span style="white-space: nowrap;"><strong>' + row[
                            "username"] + '</strong> (' + row['name'] + ')</span></a>';
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
        $('input.form-check-input').on('change', function () {
            const changed = $('input.form-check-input').filter(function () {
                return this.checked != $(this).data('origChecked');
            });
            if (changed.length == 0) {
                $('.changeInfo').text('');
                $('#saveRightsButton').attr('disabled', true);
            } else {
                $('#saveRightsButton').attr('disabled', false);
                const n = changed.length;
                $('.changeInfo').text(n + ' change' + (n == 1 ? '' : 's') + ' pending');
            }
        });
        $("#aur-filter-methods").on("keyup", function () {
            const input = this;
            const value = $(this).val().toLowerCase().trim();
            if (value == '') {
                $('#filter-icon').show();
                $('#filter-clear-button').hide();
                $('#editorForm label').each((i, el) => {
                    $(el).html($(el).text());
                });
                $('#editorForm .card-header').each((i, el) => {
                    $(el).html($(el).text());
                });
                $("#editorForm .form-check").filter(function () {
                    $(this).toggle(true);
                });
                $('#editorForm .card-container').each(function (i, el) {
                    $(el).toggle(true);
                });
                return;
            }
            $('#filter-icon').hide();
            $('#filter-clear-button').show();
            $("#editorForm .form-check").filter(function () {
                const toToggleSelf = $(this).text().toLowerCase().indexOf(value) > -1;
                const toToggleHeader = $(this).closest('.card').find('.card-header').text()
                    .toLowerCase().indexOf(value) > -1;
                const toToggle = toToggleSelf || toToggleHeader;
                $(this).toggleClass('shown', toToggle);
                $(this).toggle(toToggle);
            });
            $('#editorForm .card-container').each(function (i, el) {
                $(el).toggle($(el).find('.form-check.shown').length > 0);
            });
            const regex = new RegExp(`(${value})`, 'gi');
            $('#editorForm label').each((i, el) => {
                $(el).html($(el).text().replace(regex, '<mark>$1</mark>'));
            });
            $('#editorForm .card-header').each((i, el) => {
                $(el).html($(el).text().replace(regex, '<mark>$1</mark>'));
            });
        });
    });
</script>
<style>
    mark {
        padding: 0;
        color: white;
        background-color: #007BFF;
    }

    .changeInfo {
        font-size: small;
        color: tomato;
        margin-right: 10px;
    }

    .btn-filter-clear {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        padding: .25rem .5rem;
    }

    .btn-filter-clear:hover {
        color: white !important;
    }

    .filter-icon {
        padding: .25rem .5rem;
    }

    div.table-container {
        width: 75vw !important;
        display: inline-block;
        margin-right: 20px;
    }

    table.scroll-border tbody td:first-child {
        border-left: none !important;
    }

    table.scroll-border tbody td:nth-child(2) {
        border-left: 1px solid rgba(0, 0, 0, 0.3) !important;
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

    table.scroll-border thead tr:first-child th:nth-child(2),
    table.scroll-border thead tr:nth-child(2) th:first-child {
        border-left: 1px solid rgba(0, 0, 0, 0.3) !important;
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
        border: 1px solid rgba(0, 0, 0, 0.3);
    }

    div.dataTables_scrollBody {
        border: none !important;
    }
</style>