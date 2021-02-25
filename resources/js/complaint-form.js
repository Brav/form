
const categoryID = $("#complaint_category_id").val();

$("#complaint_type_id").children().not(`[data-category=${categoryID}]`).hide();
$("#complaint_channel_id").children().hide();

$('body').on('change', '#complaint_category_id', function (e) {

    let category = $(this).val()
    let type     = $("#complaint_type_id")
    let channel  = $("#complaint_channel_id")

    type.find('option').hide()

    let options = type.find(`option[data-category=${category}]`)

    if(options.length > 0)
    {
        type.attr("readonly", false);
        type.attr("disabled", false);
        options.show()
    } else
    {

        type.attr('readonly', true)
        type.attr('disabled', true)

        channel.attr('readonly', true)
        channel.attr('disabled', true)
    }

});

$("body").on("change", "#complaint_type_id", function (e) {

    let typeID  = $(this).val();
    let channel = $("#complaint_channel_id");

    console.log(typeID);

    channel.find("option").hide();

    let options = channel.find(`option[data-type=${typeID}]`);

    if (options.length > 0) {
        channel.attr("readonly", false);
        channel.attr("disabled", false);
        options.show();
    } else {
        channel.attr("readonly", true);
        channel.attr("disabled", true);
    }
});
