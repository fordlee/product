jQuery(document).ready(function ($) {

    $('.joinUp').on('click', 'input[type=submit]', function (e) {
        $('form input').trigger('change');
        return $('form input[type=submit]').hasClass('enabled');
    });

    // $('.joinUp').on('click', 'input[type=submit].disabled', function (e) {
    // 
    //     return false;
    // });
    // 
    // 
    // $('.joinUp').on('click', 'input[type=submit].enabled', function (e) {
    // 
    //     // var thisForm = $('.thisForm');
    //     // $(thisForm).slideUp(400, function () {
    //     //     $(thisForm).siblings('.sended').find('span').html(thisForm.find('input[type=email]').val());
    //     //     $(thisForm).siblings('.sended').slideDown(400);
    //     // });
    // 
    //     return true;
    // });

    // if ($('form').siblings('.sended').is(':hidden') == false) {
    //     $('form').siblings('.sended').find('span').html($('form').find('input[type=email]').val());
    // }

    $('.sendForm').on('click', function (e) {
        var thisForm = $('.thisForm');
        thisForm.find('input').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });

        $('.thisForm').find('textarea').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });
        thisForm.find('.hint').remove();
        if (thisForm.find('.input.error').length === 0) {
            thisForm.append('<p class="hint success">Message sent successfully</p>')
        } else {
            thisForm.append('<p class="hint error text-right">Please fill the obligatory fields <span>*</span></p>')
        }

        return false;
    });
});