<?php

namespace YaleREDCap\ApiUserRights;

/** @var ApiUserRights $module */

$pid = $module->framework->getProjectId();
$module->framework->initializeJavascriptModuleObject();
$headerInfo = $module->getTableHeader();

?>
<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/b-2.4.2/b-html5-2.4.2/datatables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/v/dt/dt-1.13.8/b-2.4.2/b-html5-2.4.2/datatables.min.js"></script>
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
<script>
    const API_USER_RIGHTS = <?= $module->framework->getJavascriptModuleObjectName() ?>;
    API_USER_RIGHTS.openRightsEditor = function (username) {
        $("#aur-filter-methods").val('').trigger('keyup');
        const data = JSON.parse($('#aur_' + username).data('rights'));
        $('#editorForm').find('input[type="checkbox"]').each(function (i, el) {
            const checked = data[$(el).attr('name')] ? true : false;
            $(el).prop('checked', checked);
            $(el).data('origChecked', checked);
            $(el).data('origText', $(el).siblings('label').eq(0).text());
        });
        $('#editor').find('.modal-title').html('<i class="fas fa-user-edit"></i> Editing ' + username);
        $('#editor form#editorForm').data('user', username);
        $('#saveRightsButton').attr('disabled', true);
        API_USER_RIGHTS.updateChangeText();
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

    API_USER_RIGHTS.updateChangeText = function () {
        const changed = $('input.form-check-input').filter(function () {
            const thisChanged = this.checked != $(this).data('origChecked');
            const label = $(this).siblings('label').eq(0);
            label.toggleClass('text-danger', thisChanged);
            return thisChanged;
        });
        if (changed.length == 0) {
            $('#changeInfo').text('');
            $('#saveRightsButton').attr('disabled', true);
        } else {
            $('#saveRightsButton').attr('disabled', false);
            const n = changed.length;
            $('#changeInfo').text('* ' + n + ' change' + (n == 1 ? '' : 's') + ' pending');
        }
    }

    API_USER_RIGHTS.join = function (a, separator, boundary, escapeChar, reBoundary) {
        let s = '';
        for (let i = 0, ien = a.length; i < ien; i++) {
            if (i > 0) {
                s += separator;
            }
            s += boundary ?
                boundary + ('' + a[i]).replace(reBoundary, escapeChar + boundary) + boundary :
                a[i];
        }
        return s;
    };

    API_USER_RIGHTS.saveCsv = function (csvData, filename) {
        const newLine = /Windows/.exec(navigator.userAgent) ? '\r\n' : '\n';
        const escapeChar = '"';
        const boundary = '"';
        const separator = ',';
        const reBoundary = new RegExp(boundary, 'g');
        let charset = document.characterSet;
        if (charset) {
            charset = ';charset=' + charset;
        }

        const header = API_USER_RIGHTS.join(csvData.header, separator, boundary, escapeChar, reBoundary) + newLine;
        const body = [];
        for (let i = 0, ien = csvData.rows.length; i < ien; i++) {
            body.push(API_USER_RIGHTS.join(csvData.rows[i], separator, boundary, escapeChar, reBoundary));
        }

        const result = {
            str: header + body.join(newLine),
            rows: body.length
        };

        const dataToSave = new Blob([result.str], {
            type: 'text/csv' + charset
        });
        $.fn.dataTable.fileSave(dataToSave, filename, true);
    }

    API_USER_RIGHTS.saveUsersCsv = function () {
        const data = $('#api_user_rights').DataTable().data().map((row, i) => {
            const newRow = [];
            newRow.push(row['username']);
            API_USER_RIGHTS.methodOrder.forEach(method => {
                newRow.push(row[method] ? 1 : 0);
            });
            return newRow;
        });
        const header = Array.concat(['username'], API_USER_RIGHTS.methodOrder);
        const csvData = {
            header: header,
            rows: data
        };
        API_USER_RIGHTS.saveCsv(csvData, 'test.csv');
    }

    $(document).ready(function () {
        let table = $('#api_user_rights').DataTable({
            processing: true,
            deferRender: true,
            ajax: function (data, callback, settings) {
                API_USER_RIGHTS.ajax('getApiUserRights', {})
                    .then(response => {
                        API_USER_RIGHTS.methodOrder = response.methodOrder;
                        callback({
                            data: response.users
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    })
            },
            columnDefs: [{
                targets: 0,
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
            {
                targets: '_all',
                className: 'dt-center',
                data: function (row, type, val, meta) {
                    const method = API_USER_RIGHTS.methodOrder[meta.col - 1];
                    if (type === 'display') {
                        return row[method] ? '<i class="fas fa-check fa-xl text-success"></i>' :
                            '<i class="fas fa-xmark fa-sm text-danger"></i>';
                    }
                    return row[method];
                },
                createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
                    $(cell).attr('data-value', cellData ? 1 : 0);
                }
            }
            ],
            scrollX: true,
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa-solid fa-file-arrow-down"></i> Export CSV',
                    className: 'btn btn-sm btn-success mr-1',
                    action: function () {
                        API_USER_RIGHTS.saveUsersCsv();
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button');
                    },
                }
            ],
            dom: 'Blfrtip',
        });
        $('input.form-check-input').on('change', API_USER_RIGHTS.updateChangeText);
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

    #changeInfo {
        font-size: small;
        margin-right: 10px;
        color: var(--bs-danger, var(--danger));
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
        width: 100% !important;
        display: inline-block;
        padding-right: 5px;
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

    table.scroll-border tbody tr {
        border-bottom: 1px solid #dee2e6 !important;
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

    @media screen and (min-width: 767px) {
        div#center {
            width: calc(100% - 305px);
        }
    }

    .form-check-input,
    .form-check-label {
        cursor: pointer;
    }
</style>