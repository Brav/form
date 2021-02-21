require('./bootstrap');

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
