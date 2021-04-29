const categoryID = $("#complaint_category_id").val();

if(categoryID)
{
    $("#complaint_type_id")
        .children()
        .not(`[data-category=${categoryID}]`)
        .hide();
}

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
    let clinic     = $("#clinic_id")
    let manager    = clinic.find("option:selected").data("manager")
    let veterinary = clinic.find("option:selected").data("veterinary");
    let general = clinic.find("option:selected").data("general");

    if(manager)
    {
        $("#regional_manager").val(manager);
    }

    if (veterinary)
    {
        $("#veterinary_manager").val(veterinary);
    }

    if (general)
    {
        $("#general_manager").val(general);
    }
}
