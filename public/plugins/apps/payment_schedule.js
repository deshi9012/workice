function toFixed(value, precision) {
    var power = Math.pow(10, precision || 0);
    return String(Math.round(value * power) / power);
}

// Hide and show Multiparts

function hideMultiparts() {
    $('.partial-addmore a span').html($('.partial-addmore a').data('disabled'));
    $('.partial-addmore a').addClass('disabled');

    if ($('.partial-inputs').length > 1) {
        $('.partial-inputs:not(:first-child)').slideUp();
        $('.partial-inputs:first-child .partial-amount').data('old-value', $('.partial-inputs:first-child .partial-amount').val()).val(100);
        $('.partial-inputs:first-child .partial-percentage select').data('old-value', $('.partial-inputs:first-child .partial-percentage select').val()).val(1);
        $('.partial-inputs:first-child .partial-percentage .selector span').html($('.partial-inputs:first-child .partial-percentage select option:selected').html());
    }
}

function showMultiparts() {
    $('.partial-addmore a span').html($('.partial-addmore a').data('enabled'));
    $('.partial-addmore a').removeClass('disabled');

    if ($('.partial-inputs').length > 1 && $('.partial-inputs:first-child .partial-amount').data('old-value') != undefined) {
        $('.partial-inputs:not(:first-child)').slideDown();
        $('.partial-inputs:first-child .partial-amount').val($('.partial-inputs:first-child .partial-amount').data('old-value'));
        $('.partial-inputs:first-child .partial-percentage select').val($('.partial-inputs:first-child .partial-percentage select').data('old-value'));
        $('.partial-inputs:first-child .partial-percentage .selector span').html($('.partial-inputs:first-child .partial-percentage select option:selected').html());
    }
}


function delete_partial_payment() {
    $(this).parents('.partial-inputs').slideUp(function () {
        $(this).remove();
    });
    return false;
}


$(function () {

    if ($('.partial-payment-details').length == 0) {
        $('div.partial-inputs .partial-notes').width(386);
    }

    $('.partial-payment-delete:first').hide();

    $('.partial-addmore a').click(function () {
        if (!$(this).is(':disabled')) {
            // Button is not disabled, let's create another row for partial payments.

            newLength = ($('.partial-inputs').length + 1);
            // Destroy the first date picker, then rebuild it after cloning.
            // $('.partial-inputs:first-child .datepicker-input').datepicker('destroy');
            newPartial = $('.partial-inputs:first-child').clone();
            newPartial.find('.datepicker-input').attr('name', 'partial-due_date' + '[' + newLength + ']').datepicker({autoclose: true});
            // Set the new name, then call datepicker again.
            $('.partial-inputs:first-child .datepicker-input').each(function () {
                $(this).datepicker({
                    autoclose: true
                });
            });

            newPartial.find('a').data('details', newLength).removeClass('key_1').addClass('key_' + newLength);
            newPartial.find('.partial-payment-details span').html($('.partial-input-container').data('markaspaid'));
            newPartial.find('input:not([type=checkbox])').val('');

            newPartial.find('input[type=checkbox]:checked').click();
            newPartial.find('input:not(.datepicker-input), select').each(function () {
                $(this).attr('name', $(this).attr('name').replace('[1]', '[' + newLength + ']'))
            });
            select = newPartial.find('select');
            check = newPartial.find('input[type=checkbox]');

            check.attr('id', check.attr('id') + newLength);
            select.attr('id', select.attr('id') + newLength);
            select.val(0);

            newPartial.find('input[type=text]').each(function () {
                $(this).attr('id', $(this).attr('id') + newLength);
            });

            $(newPartial).find('.partial-percentage > .selector').replaceWith(select);

            $(newPartial).find('.checker').replaceWith(check);
            $(newPartial).find('.partial-payment-delete').show();
            newPartial.hide().appendTo('.partial-input-container');
            $('.partial-input-container *:hidden').slideDown('normal');
            $('.partial-payment-delete:first').hide();
            return false;

        }
    });


    // $('input[name=type], #client').change();

});

$(document).on('click', '.partial-payment-delete', delete_partial_payment);
