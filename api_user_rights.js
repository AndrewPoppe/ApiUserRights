API_USER_RIGHTS.saveSnapshot = function () {
    API_USER_RIGHTS.ajax('saveApiUserRightsSnapshot', {})
        .then(response => {
            if (!response.success) {
                Swal.fire({
                    title: 'Error saving snapshot',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                return;
            }
            $('#snapshotModalLink').text(response.tstext);
        })
        .catch(error => {
            Swal.fire({
                title: 'Error saving snapshot',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        });
}

API_USER_RIGHTS.getSnapshotsTableData = function (snapshots) {
    let tableData = '';
    snapshots.forEach(snapshot => {
        tableData += `<tr>
        <td>${snapshot.tsFormatted}</td>
        <td>${snapshot.username} (${snapshot.name})</td>
        <td><i class="fa-solid fa-file-arrow-down text-success"></i> <a href="#" onclick="API_USER_RIGHTS.downloadSnapshot(${snapshot.id})">Download CSV</a></td>
        </tr>`;
    });
    return tableData;
}

API_USER_RIGHTS.openSnapshotModal = function () {
    if ($('#api_user_rights_snapshots').hasClass('dataTable')) {
        $('#api_user_rights_snapshots').DataTable().destroy();
    }
    API_USER_RIGHTS.ajax('getSnapshotsInfo')
        .then(response => {
            if (!response.success) {
                Swal.fire({
                    title: 'Error getting snapshots',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                return;
            }

            $('#api_user_rights_snapshots').DataTable({
                data: response.snapshots,
                columns: [
                    { data: 'tsFormatted' },
                    {
                        data: function (row, type, val, meta) {
                            if (type === 'display') {
                                return `${row['username']} (${row['name']})`;
                            }
                            return row['username'];
                        }
                    },
                    {
                        data: function (row, type, val, meta) {
                            if (type === 'display') {
                                return '<i class="fa-solid fa-file-arrow-down text-success"></i> <a href="#" onclick="API_USER_RIGHTS.downloadSnapshot(' + row["id"] + ')">Download CSV</a>';
                            }
                            return row["id"];
                        }
                    }
                ],
                order: [[0, 'desc']],
                initComplete: function () {
                    $('#snapshotsModal').modal('show');
                }
            });
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                title: 'Error getting snapshots',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        });
}

API_USER_RIGHTS.downloadSnapshot = function (id) {
    API_USER_RIGHTS.ajax('downloadSnapshot', { snapshotId: id })
        .then(response => {
            if (!response.success) {
                Swal.fire({
                    title: 'Error downloading snapshot',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                return;
            }
            const header = Array.concat(['username'], API_USER_RIGHTS.methodOrder);
            const data = response.snapshot.map((row, i) => {
                const newRow = [];
                newRow.push(row['username']);
                API_USER_RIGHTS.methodOrder.forEach(method => {
                    newRow.push(row[method] ? 1 : 0);
                });
                return newRow;
            });
            const csvData = {
                header: header,
                rows: data
            };
            const filename = 'API_User_Rights_Snapshot_' + response.tsFormatted + '.csv';
            API_USER_RIGHTS.saveCsv(csvData, filename);
        })
        .catch(error => {
            Swal.fire({
                title: 'Error downloading snapshot',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        });
}

API_USER_RIGHTS.encodeUsername = function (username) {
    return username.replace(/^[0-9-]|[^a-zA-Z0-9-_]/g, function (match) {
        return '\\' + match;
    });
}

API_USER_RIGHTS.openRightsEditor = function (username) {
    $("#aur-filter-methods").val('').trigger('keyup');
    const data = JSON.parse($('#aur_' + API_USER_RIGHTS.encodeUsername(username)).data('rights'));
    $('#editorForm').find('input[type="checkbox"]').each(function (i, el) {
        const checked = data[$(el).attr('name')] ? true : false;
        $(el).prop('checked', checked);
        $(el).data('origChecked', checked);
        $(el).data('origText', $(el).siblings('label').eq(0).text());
    });
    $('#editor').find('.modal-title').html('<i class="fa-solid fa-user-edit"></i> Editing ' + username);
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
    const filename = 'API_User_Rights_PID' + pid + '_' + new Date().toISOString().slice(0, 10) + '.csv';
    API_USER_RIGHTS.saveCsv(csvData, filename);
}


API_USER_RIGHTS.importCsv = function () {
    $('#importUsersFile').click();
}

API_USER_RIGHTS.handleImportError = function (errorData) {
    let body = errorData.errors.join('<br>') + "<div class='container'>";
    if (errorData.badUsers.length) {
        body +=
            "<div class='row justify-content-center m-2'>" +
            `<table><thead><tr><th>Username</th></tr></thead><tbody>`;
        errorData.badUsers.forEach((user) => {
            body += `<tr><td>${user}</td></tr>`;
        });
        body += "</tbody></table></div>";
    }
    if (errorData.badMethods.length) {
        body +=
            "<div class='row justify-content-center m-2'>" +
            `<table><thead><tr><th>API Method</th></tr></thead><tbody>`;
        errorData.badMethods.forEach((method) => {
            body += `<tr><td>${method}</td></tr>`;
        });
        body += "</tbody></table></div>";
    }
    body += "</div>";
    Swal.fire({
        title: 'Error',
        html: body,
        icon: 'error',
        confirmButtonText: 'OK',
    });
}

API_USER_RIGHTS.handleFiles = function () {
    if (this.files.length !== 1) {
        return;
    }
    const file = this.files[0];
    this.value = null;

    if (file.type !== "text/csv" && file.name.toLowerCase().indexOf('.csv') === -1) {
        return;
    }

    Swal.fire({
        title: 'Loading...',
        onOpen: () => {
            Swal.showLoading();
        }
    });

    const reader = new FileReader();
    reader.onload = (e) => {
        API_USER_RIGHTS.csv_file_contents = e.target.result;
        API_USER_RIGHTS.ajax('importRightsCsv', { data: API_USER_RIGHTS.csv_file_contents })
            .then((result) => {
                Swal.close();
                if (result.status != 'error') {
                    $(result.data).modal('show');
                } else {
                    API_USER_RIGHTS.handleImportError(result.data);
                }
            })
            .catch((error) => {
                Swal.close();
                console.error(error);
            });
    };
    reader.readAsText(file);
}

API_USER_RIGHTS.confirmImport = function () {
    $('.modal').modal('hide');
    if (!API_USER_RIGHTS.csv_file_contents || API_USER_RIGHTS.csv_file_contents === "") {
        return;
    }
    API_USER_RIGHTS.ajax('importRightsCsv', { data: API_USER_RIGHTS.csv_file_contents, confirm: true })
        .then((result) => {
            if (result.status != 'error') {
                API_USER_RIGHTS.dt.ajax.reload();
                Swal.fire({
                    icon: 'success',
                    html: 'Successfully imported API User Rights',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'OK',
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    html: 'Error importing CSV'
                });
            }
        })
        .catch((error) => {
            Toast.fire({
                icon: 'error',
                html: 'Error importing CSV'
            });
            console.error(error);
        });
}



$(document).ready(function () {

    window.Toast = Swal.mixin({
        toast: true,
        position: 'middle',
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true
    });

    const importFileElement = document.getElementById("importUsersFile");
    importFileElement.addEventListener("change", API_USER_RIGHTS.handleFiles);

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    API_USER_RIGHTS.dt = $('#api_user_rights').DataTable({
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
                    return row[method] ? '<i class="fa-solid fa-check fa-xl text-success"></i>' :
                        '<i class="fa-solid fa-xmark fa-sm text-danger"></i>';
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
                text: '<i class="fa-solid fa-file-arrow-up"></i> Import CSV',
                className: 'btn btn-xs btn-primary',
                action: function () {
                    API_USER_RIGHTS.importCsv();
                },
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                    $(node).css('margin-bottom', '-10px');
                },
            },
            {
                extend: 'csv',
                text: '<i class="fa-solid fa-file-arrow-down"></i> Export CSV',
                className: 'btn btn-xs btn-success mr-2',
                action: function () {
                    API_USER_RIGHTS.saveUsersCsv();
                },
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                    $(node).css('margin-bottom', '-10px');
                },
            }
        ],
        dom: 'Blfrtip'
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