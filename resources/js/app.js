require('./bootstrap');
require("select2");
require('./clinic');
require('./complaint-form');
require('./paginate');

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(".select2").select2({
    placeholder: "Select an option",
});

$(document).on("click", "a[role=smallModal]", function (event) {
    event.preventDefault();
    let href = $(this).attr("data-attr");
    $.ajax({
        url: href,
        beforeSend: function () {
            $("#loader").show();
        },
        // return the result
        success: function (result) {
            $("#smallModal").modal("show");
            $("#smallBody").html(result).show();
        },
        complete: function () {
            $("#loader").hide();
        },
        error: function (jqXHR, testStatus, error) {
        alert("Page " + href + " cannot open. Error:" + error);
            $("#loader").hide();
        },
        timeout: 8000,
    });
});

$(document).on("click", "a[role=bigModal]", function (event) {
    event.preventDefault();
    let href = $(this).attr("data-attr");
    $.ajax({
        url: href,
        beforeSend: function () {
            $("#loader").show();
        },
        // return the result
        success: function (result) {
            $("#bigModal").modal("show");
            $("#bigBody").html(result).show();
        },
        complete: function () {
            $("#loader").hide();
        },
        error: function (jqXHR, testStatus, error) {
            alert("Page " + href + " cannot open. Error:" + error);
            $("#loader").hide();
        },
        timeout: 8000,
    });
});


$(document).on("submit", "#formAjax", function (event) {
    event.preventDefault();

    let $this  = $(this)
    let table  = $this.find('#table').val()
    let method = $this.find("input[name=_method]").val() || "POST"
    let action = $this.find('#action').val()

    $.ajax({
        url: $this.attr('action'),
        type: method,
        data: $this.serialize(),
        beforeSend: function () {
            $("#loader").show();
        },
        // return the result
        success: function (result) {

            if (action === 'create') {
                $(`#${table}`).find("tbody").append(result);
            }

            if (action === 'edit') {

                let id = $this.find('#_id').val()

                $(`#${table}`).find(`#item-${id}`).replaceWith(result);

                if(table === 'complaint-category')
                {
                    $(`.complaint-type-category-${id}`).text(
                        $(`#${table}`).find(`#item-${id}`).find(".title").text()
                    );
                }
            }

            $("#bigModal").modal("hide");
        },
        complete: function () {
            $("#loader").hide();
        },
        error: function (jqXHR, testStatus, error) {
            showValidationErrors(jqXHR.responseJSON.errors);
            $("#loader").hide();
        }
    });
});

$(document).on("submit", "#delete-form", function (event) {
    event.preventDefault();

    let $this = $(this)
    let id    = $this.find('input[name=id]').val()
    let table = $this.find('#table')

    $.ajax({
        url: $this.attr("action"),
        type: "DELETE",
        data: { _token: $('meta[name="csrf-token"]').attr("content") },
        beforeSend: function () {
            $("#loader").show();
        },
        // return the result
        success: function (result) {
            $("#smallModal").modal("hide");

            if (table.length === 0) {
                $(`#item-${id}`).remove();
            } else {
                $(`#${table.val()}`).find(`#item-${id}`).remove();
            }
        },
        complete: function () {
            $("#loader").hide();
        },
        error: function (jqXHR, testStatus, error) {
            alert("Page " + error + " cannot open. Error:" + error);
            $("#loader").hide();
        },
        timeout: 8000,
    });
});

$(document).on('click', "#generate-password", function () {

    let randomString = Math.random().toString(36).substr(2, 18);

    $('#password').val(randomString)
});

$(document).on("change", "#admin", function () {
    if($(this).is(':checked')){
       $('#can_login').attr('checked', true);
    }
});

$(document).on("click", "#can_login", function (e) {
    if ($('#admin').is(":checked")) {
         e.preventDefault();
    }
});

function showValidationErrors(errors)
{
    for(error in errors)
    {
        let message = errors[error].join('\n')
        $(`
            <div id="${error}-error" class="text-danger is-invalid">
                ${message}
            </div>
        `).insertAfter($(`#${error}`));
    }
}

$('body').on('change', '#documents', function () {

    let files       = $(this).prop('files')
    let fileInput   = document.getElementById("hidden-documents");
    let hiddenFiles = fileInput.files

    document.getElementById("hidden-documents").files = new FileListItems([
        ...files,
        ...hiddenFiles,
    ]);

    appendFileNames(document.getElementById("hidden-documents").files);
});

$('body').on('click', '.file-remove', function (e)
{
    e.preventDefault()

    let index    = $(this).data('order')
    let files    = Array.from(document.getElementById("hidden-documents").files)

    files.splice(index, 1)

    document.getElementById("hidden-documents").files = new FileListItems(files);

    appendFileNames(files)

});

$("body").on("click", ".file-delete", function (e) {
    e.preventDefault();

    let $this = $(this);

    if(!confirm("Are you sure you want to delete this file?"))
    {
        return;
    }

    $.ajax({
        url: $this.data("route"),
        type: "DELETE",
        data: {
            file: $this.data("file"),
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            $(`#${$this.data("id")}`).remove();
        },
    });
});

/**
 * @params {File[]} files Array of files to add to the FileList
 * @return {FileList}
 */
function FileListItems (files) {

  let b = new ClipboardEvent("").clipboardData || new DataTransfer()
  for (let i = 0, len = files.length; i<len; i++) b.items.add(files[i])

  return b.files
}

function appendFileNames(files)
{

    let allFiles = [];

    for (let i = 0, l = files.length; i < l; i++) {
        allFiles.push(
            `<span class="font-weight-bold d-block">${files[i].name}
                <i class="fas fa-trash-alt file-remove"
                data-order="${i}"></i>
            </span>`
        );
    }

    $("#files-for-upload")
        .removeClass("d-none")
        .find(".files")
        .html(allFiles.join(""));
}
