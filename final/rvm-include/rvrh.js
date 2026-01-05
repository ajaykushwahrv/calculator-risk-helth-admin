jQuery(document).on('click', '.prev_action', function() {
    var nextstap = jQuery(this).attr('data-step');
    var currentstep = nextstap - 1;
    jQuery('.wizard-stape-cart').hide();
    jQuery('#wizard_stape_' + currentstep).show();
    jQuery('.pSteps[ data-tab-id="' + currentstep + '"]').removeClass("completeStep");
    jQuery('.pSteps[ data-tab-id="' + currentstep + '"]').addClass("activeStep");
    jQuery('.pSteps[ data-tab-id="' + nextstap + '"]').removeClass("activeStep");
    // jQuery('html, body').animate({
    //     scrollTop: jQuery("body").offset().top
    // }, 1200);
});

jQuery(document).on('click', '.back-step', function() {
    var backstap = parseInt(jQuery(this).attr('data-tab-id'));
    var currentstep = jQuery('.progressBar ul li').length + 1;
    jQuery('.wizard-stape-cart').hide();
    jQuery('#wizard_stape_' + backstap).show();
    jQuery('.pSteps[ data-tab-id="' + backstap + '"]').addClass("activeStep");
    jQuery('.pSteps[ data-tab-id="' + backstap + '"]').removeClass("completeStep");
    // jQuery('html, body').animate({
    //     scrollTop: jQuery("body").offset().top
    // }, 1200);
    for (i = 1; i < currentstep; i++) {
        if (backstap < i) {
            jQuery('.pSteps[ data-tab-id="' + i + '"]').removeClass("completeStep");
            jQuery('.pSteps[ data-tab-id="' + i + '"]').removeClass("activeStep");
        }
    }
});

jQuery(document).on('click', '.next-step', function() {
    var currentstep = parseInt(jQuery(this).attr('data-step'));
    var nextstap = currentstep + 1;
    jQuery('.wizard-stape-cart').hide();
    jQuery('#wizard_stape_' + nextstap).show();
    jQuery('.pSteps[ data-tab-id="' + currentstep + '"]').addClass("completeStep");
    jQuery('.pSteps[ data-tab-id="' + nextstap + '"]').addClass("activeStep");
    jQuery('.pSteps[ data-tab-id="' + currentstep + '"]').removeClass("activeStep");
    // jQuery('html, body').animate({
    //     scrollTop: jQuery("body").offset().top
    // }, 1200);
});

function validate() {
    let valid = true;




    // Name
    if ($("#rvrname").val().trim() === "") {
        $("#rvrname_err").text("Name required");
        $("#rvrname")
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        $("#rvrname_err").text("");
        $("#rvrname")
            .removeClass("error-field")
            .addClass("input-success");
    }

    // Email
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($("#rvremail").val())) {
        $("#rvremail_err").text("Invalid Email");
        $("#rvremail")
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        $("#rvremail_err").text("");
        $("#rvremail")
            .removeClass("error-field")
            .addClass("input-success");
    }

    // Mobile
    if (!/^[6-9]\d{9}$/.test($("#mobile").val())) {
        $("#rvrmobile_err").text("Invalid Mobile");
        $("#mobile")
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        $("#rvrmobile_err").text("");
        $("#mobile")
            .removeClass("error-field")
            .addClass("input-success");
    }

    // Message
    if ($("#rvrmessage").val().trim().length < 5) {
        $("#rvrmessage_err").text("Message too short");
        $("#rvrmessage")
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        $("#rvrmessage_err").text("");
        $("#rvrmessage")
            .removeClass("error-field")
            .addClass("input-success");
    }




    $("#submitBtn").prop("disabled", !valid);
    return valid;
}
$("input, textarea").on("focus", function() {
    $(this)
        .removeClass("error-field input-success")
        .addClass("input-active");
});

$("input, textarea").on("blur", function() {
    $(this).removeClass("input-active");
    validate(); // blur ke baad validate
});
$("#secureForm").on("submit", function(e) {
    if (!validate()) {
        e.preventDefault();
        return;
    }

    // Disable submit button after first click
    $("#submitBtn")
        .prop("disabled", true)
        .text("Please wait...");
});

function rvrefreshCaptcha(key) {
    jQuery.ajax({
        url: "/rvm-include/rvfcaptcha_refresh.php",
        type: "GET",
        data: { key: key },
        success: function (response) {
            jQuery("#cap_" + key).html(response);
        },
        error: function () {
            console.error("Captcha refresh failed");
        }
    });
}