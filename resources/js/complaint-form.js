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


    $("#regional_manager").not('.edit').val(manager);
    $("#veterinary_manager").not('.edit').val(veterinary);
    $("#general_manager").not('.edit').val(general);

}

$("body").on("submit", "#complaint_form", function(e) {
    $("#compaint-submitted")
        .removeClass('d-none')
        .addClass('d-inline')

    $("#submit-form").attr("disabled", true);
});

$("body").on("change", "#aggression_choice", function(e){

    let aggressionSelect = $("#aggression");

    this.value === "yes"
        ? aggressionSelect.attr("disabled", false)
        : aggressionSelect.attr("disabled", true);
});

$(function() {

    let complaintTypeText = $('#complaint_type_id').find('option:selected').text().toLowerCase();

    if(complaintTypeText === 'other' || complaintTypeText === 'others'){
        $('#other-type-of-complaint-container').removeClass('d-none')
    }
});

$(function() {
    if($('#complaint_category_id').find('option:selected').text().toLowerCase() === 'near miss'){
        $('#near-miss-description-container').removeClass('d-none')
    }
});

$('body').on('change', '#complaint_category_id', function (e) {
    let optionSelected = $(this).find('option:selected').text().toLowerCase()
    $('#near-miss-description-container').addClass('d-none')

    if(optionSelected === 'near miss'){
        $('#near-miss-description-container').removeClass('d-none')
        $('#other-type-of-complaint-container').addClass('d-none')
    }
})

$('body').on('change', '#complaint_type_id', function (e) {
    let optionSelected = $(this).find('option:selected').text().toLowerCase()
    $('#other-type-of-complaint-container').addClass('d-none')

    if(optionSelected === 'other' || optionSelected === 'others'){
        $('#other-type-of-complaint-container').removeClass('d-none')
    }
})
