
jQuery(document).ready(function($){

    $('.joinUp input').on('keyup', function (e) {
        var thisForm = $('.joinUp form');
        thisForm.find('input').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');


            }
        });

        var reg = /[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/,
            patt = new RegExp(reg);

        thisForm.find('input[type=email]').each(function () {
            if (!patt.test($(this).val())) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });


        if ((thisForm.find('input[type=password]').eq(0).val() === thisForm.find('input[type=password]').eq(1).val()) && (thisForm.find('input[type=password]').eq(0).val().length >= 5)) {
            thisForm.find('input[type=password]').parent('.input').removeClass('error');
        } else {
            thisForm.find('input[type=password]').parent('.input').addClass('error');
        }


        if (thisForm.find('.input.error').length === 0) {
            thisForm.find('input[type=submit]').removeClass('disabled').addClass('enabled');
        } else {
            thisForm.find('.hint p').hide();
            thisForm.find('.hint p.obligatory').show();
            thisForm.find('input[type=submit]').addClass('disabled')

        }

        return false;
    });
    $('.joinUp').on('click', 'input[type=submit]', function (e) {
        $('.joinUp form input').trigger('keyup');
        return false;
    });

    $('.joinUp').on('click', 'input[type=submit].disabled', function (e) {

        return false;
    });


    $('.joinUp').on('click', 'input[type=submit].enabled', function (e) {

        var thisForm = $('.joinUp form');
        $(thisForm).slideUp(400, function () {
            $(thisForm).siblings('.sended').find('span').html(thisForm.find('input[type=email]').val());
            $(thisForm).siblings('.sended').slideDown(400);
        });

        return false;
    });


    $('.sendForm').on('click', function (e) {
        var thisForm = $(e.target).parent('form');
        thisForm.find('input').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });

        $(e.target).parent('form').find('textarea').each(function (e) {
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