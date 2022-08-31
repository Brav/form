const categoryID = $("#complaint_category_id").val();

if(categoryID)
{
    $("#complaint_type_id")
        .not(".filter")
        .children()
        .not(`[data-category=${categoryID}]`)
        .hide();
}

$('.no-keyboard').on('keypress', function (e)
{
    e.preventDefault()
})

$('body').on('change', '#complaint_category_id', function (e) {

    if($(this).hasClass('filter'))
    {
        return
    }

    let category = $(this).val() || 'empty'
    let type     = $("#complaint_type_id")

    let channels   = $(this).find(':selected').data('channels')
    let severities = $(this).find(":selected").data("severities");

    const channelOptions  = $("#complaint_channel_id option");
    const severityOptions = $("#severity_id option");

    channelOptions.show()
    severityOptions.show();

    if (channels !== undefined) {

        channelOptions.each(function(){

            if(!Object.values(channels).includes($(this).val()))
            {
                $(this).hide()
            }

        });

        channelOptions.each(function () {

            if ($(this).css("display") === "block") {
                $(this).prop("selected", true);

                return false;
            }

        });

    }

    if (severities !== undefined) {
        severityOptions.each(function () {
            if (!Object.values(severities).includes($(this).val())) {
                $(this).hide();
            }
        });

        severityOptions.each(function () {
            if ($(this).css("display") === "block") {
                $(this).prop("selected", true);

                return false;
            }
        });

    }

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

    type.prop("selectedIndex", 0);

});

$(function () {
   setManager();
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

$("body").on("submit", "#complaint_form", function(e) {
    $("#compaint-submitted")
        .removeClass('d-none')
        .addClass('d-inline')

    $("#submit-form").attr("disabled", true);
});
