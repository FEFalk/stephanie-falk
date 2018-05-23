(function ($) {
    jQuery.each(
        jQuery('#sticky_menu').find('li.menu-item-has-children'),
        function (i, v) {
            jQuery(v).append('<i />');
        }
    );
    jQuery('#sticky_menu').find('li.menu-item-has-children i').bind('click', function () {
        jQuery(this).parent().find('.sub-menu').first().slideToggle('fast').parent().toggleClass('expanded');
    });
    jQuery('.menu-toggle, .sticky_menu_collapse').bind('click', function () {
        if (jQuery('#page').hasClass('shifted')) {
            jQuery('#page').removeClass('shifted');
        }
        else {
            jQuery('#page').addClass('shifted');
        }

    });
	

    jQuery('#booking_form').bind('submit', function (event) {
        console.log('Please wait...');
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        jQuery('.form_message').slideUp().text('');
        jQuery('#booking_form').find('input[type="submit"]').attr('disabled', 'disabled').val('Please wait...');

        var ajax_url = one_ajax.ajaxurl;

        var email = jQuery('#booking_form').find('.booking_email').val();
        var name = jQuery('#booking_form').find('.booking_name').val();
        var message = jQuery('#booking_form').find('.booking_msg').val();
        var subject = jQuery('#booking_form').find('#contact_subject').val();
        var recipient = jQuery('#booking_form').find('#contact_recipient').val();
        var label_1 = jQuery('#booking_form').find('#label_1').val();
        var label_2 = jQuery('#booking_form').find('#label_2').val();
        var label_3 = jQuery('#booking_form').find('#label_3').val();
        var validate_nonce = jQuery('#booking_form').find('#validate_nonce').val();

        /* Data to send */
        data = {
            action: 'send_contact_form',
            name: name,
            email: email,
            message: message,
            subject: subject,
            recipient: recipient,
            label_1: label_1,
            label_2: label_2,
            label_3: label_3,
            validate_nonce:validate_nonce,
        };

        jQuery.post(ajax_url, data, function (response) {


            if (response.type == 'error') {
                jQuery('#booking_form').find('input[type="submit"]').removeAttr('disabled').val('SEND MESSAGE');
                jQuery('.form_message').html(response.text).slideDown();
                console.log(response.text);
            }
            else if (response.type == 'success') {
                jQuery('#booking_form').find('input[type="submit"]').removeAttr('disabled').val('SEND MESSAGE');
                jQuery('#booking_form').trigger('reset');
                jQuery('.form_message').html(response.text).slideDown();
                console.log(response.text);
            }
            else {
                jQuery('#booking_form').find('input[type="submit"]').removeAttr('disabled').val('SEND MESSAGE');
                jQuery('.form_message').html(response.text).slideDown();
                console.log(response.text);
            }

        }, "json");

    });


    jQuery('#subscribe_form').bind('submit', function (event) {
        console.log('Please wait...');
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        jQuery('.form_message').slideUp().text('');
        jQuery('#subscribe_form').find('input[type="submit"]').attr('disabled', 'disabled').val('Please wait...');

        var ajax_url = one_ajax.ajaxurl;

        var email = jQuery('#subscribe_form').find('.sub_email').val();
        var validate_nonce = jQuery('#subscribe_form').find('#validate_nonce').val();

        /* Data to send */
        data = {
            action: 'newsletter_subscribe',
            email: email,
            validate_nonce:validate_nonce,
        };

        jQuery.post(ajax_url, data, function (response) {

            if (response.type == 'error') {
                jQuery('#subscribe_form').find('input[type="submit"]').removeAttr('disabled').val('Subscribe');
                jQuery('.form_message').html(response.text).slideDown();
                console.log(response.text);
            }
            else if (response.type == 'success') {
                jQuery('#booking_form').find('input[type="submit"]').removeAttr('disabled').val('Subscribe');
                jQuery('#subscribe_form').trigger('reset');
                jQuery('.form_message').html(response.text).slideDown();
                console.log(response.text);
            }
            else {
                jQuery('#subscribe_form').find('input[type="submit"]').removeAttr('disabled').val('Subscribe');
                jQuery('.form_message').html(response.text).slideDown();
                console.log(response);
            }

        }, "json");

    });
})(jQuery);