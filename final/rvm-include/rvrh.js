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
 function fid(id, key) {
    return `#${id}_${key}`;
}
function validate(form) {
    let valid = true;
    const key = $(form).data("key");

    // Name
    if (jQuery(fid("rvrname", key)).val().trim() === "") {
        jQuery(fid("rvrname_err", key)).text("Name required");
        jQuery(fid("rvrname", key))
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        jQuery(fid("rvrname_err", key)).text("");
        jQuery(fid("rvrname", key))
            .removeClass("error-field")
            .addClass("input-success");
    }

    // Email
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(jQuery(fid("rvremail", key)).val())) {
        jQuery(fid("rvremail_err", key)).text("Invalid Email");
        jQuery(fid("rvremail", key))
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        jQuery(fid("rvremail_err", key)).text("");
        jQuery(fid("rvremail", key))
            .removeClass("error-field")
            .addClass("input-success");
    }

    // Mobile
    if (!/^[6-9]\d{9}$/.test(jQuery(fid("mobile", key)).val())) {
        jQuery(fid("rvrmobile_err", key)).text("Invalid Mobile");
        jQuery(fid("mobile", key))
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        jQuery(fid("rvrmobile_err", key)).text("");
        jQuery(fid("mobile", key))
            .removeClass("error-field")
            .addClass("input-success");
    }

    // Message
    if (jQuery(fid("rvrmessage", key)).val().trim().length < 5) {
        jQuery(fid("rvrmessage_err", key)).text("Message too short");
        jQuery(fid("rvrmessage", key))
            .removeClass("input-success")
            .addClass("error-field");
        valid = false;
    } else {
        jQuery(fid("rvrmessage_err", key)).text("");
        jQuery(fid("rvrmessage", key))
            .removeClass("error-field")
            .addClass("input-success");
    }

    jQuery(fid("submitBtn", key)).prop("disabled", !valid);
    return valid;
}
jQuery(".secureForm").on("submit", function (e) {
    if (!validate(this)) {
        e.preventDefault();
        return;
    }

    const key = $(this).data("key");
    jQuery(fid("submitBtn", key))
        .prop("disabled", true)
        .text("Please wait...");
});
jQuery("input, textarea").on("focus", function () {
    $(this).removeClass("error-field input-success").addClass("input-active");
});

jQuery("input, textarea").on("blur", function () {
    $(this).removeClass("input-active");
    validate($(this).closest("form"));
});
function refreshCaptcha(key) {
    fetch("/rvm-include/rvfcaptcha_generate.php?refresh=1&key=" + key)
        .then(res => res.text())
        .then(data => {
            document.getElementById("cap_" + key).innerHTML = data;
        });
}