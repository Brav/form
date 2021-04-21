const categoryID = $("#complaint_category_id").val();

$("#complaint_type_id").children().not(`[data-category=${categoryID}]`).hide();

$('body').on('change', '#complaint_category_id', function (e) {

    let category = $(this).val()
    let type     = $("#complaint_type_id")

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
    }

});

$(document).ready(function () {
    setManager()
});

$('body').on('change', '#clinic_id', function () {
    setManager()
});

function setManager()
{
    let manager = $("#clinic_id").find("option:selected").data("manager")

    if(manager)
    {
        $("#regional_manager").val(manager);
    }
}
