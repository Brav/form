require('./bootstrap');
require('select2')
require('./clinic');

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
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

$(document).on("submit", "#delete-form", function (event) {
    event.preventDefault();

    let $this = $(this)
    let id    = $this.find('input[name=id]').val()

    $.ajax({
        url: $this.attr('action'),
        type: "DELETE",
        beforeSend: function () {
            $("#loader").show();
        },
        // return the result
        success: function (result) {
            $("#smallModal").modal("hide");
            $(`#item-${id}`).remove()
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

