import './bootstrap';
import jQuery from 'jquery';
import * as Sentry from "@sentry/browser";

Sentry.init({
    dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
});

window.$ = jQuery;

$(document).ready(function () {
    var delay = 10000
    $($('.js-timer').get().reverse()).each((i, obj) => {
        closeMessage(obj, delay);
        delay += 5000;
    });
});

function closeMessage(obj, delay) {
    setTimeout(() => {
        $(obj).addClass("is-hidden");
    }, delay)
}

$('.js-messageClose').on('click', function () {
    closeMessage($(this).closest('.Message'));
});

$(".close").click(function () {
    $(this)
        .parent(".alert")
        .fadeOut();
});

window.clickToCopyText = function (textToCopy, elem) {
    navigator.clipboard.writeText(textToCopy);
    let iconElement = $(elem).find('i').first();
    let copyDoneElement = $(elem).find('.copyDone').first();
    iconElement.removeClass('fa-copy');
    iconElement.addClass('fa-check wiggle');
    copyDoneElement.show();

    setTimeout(function () {
        // After 3 seconds, remove the 'wiggle' class to stop the animation and add copy icon
        iconElement.removeClass('fa-check wiggle');
        iconElement.addClass('fa-copy');
        copyDoneElement.hide();
    }, 3000);
}

$(document).ready(function () {
    $('.disableOnEncrypt').hide();

    $('#encrypt').on('change', function () {
        $('.disableOnEncrypt').attr('disabled', true).hide(500)
        $('.disableOnDecrypt').removeAttr('disabled').show(500)
    });

    $('#decrypt').on('change', function () {
        $('.disableOnEncrypt').removeAttr('disabled').show(500)
        $('.disableOnDecrypt').attr('disabled', true).hide(500)
    });

    $('.binaryValidation').on('input', function (event) {
        const inputValue = $(this).val();
        const binaryPattern = /^[01]+$/;

        if (!binaryPattern.test(inputValue)) {
            event.target.setCustomValidity(Lang.get('jsErrors.inputCanBeOnlyBinary'));
        } else {
            event.target.setCustomValidity('');
        }
    });

    $('.primeNumber').each(function () {
        $(this).on('change', function () {
            checkPrimeInputs();
        });
    });

    function checkPrimeInputs() {
        const primeNumber1 = $('#primeNumber1');
        const primeNumber2 = $('#primeNumber2');

        let firstResult = isPrime(primeNumber1.val());
        let secondResult = isPrime(primeNumber2.val());

        if (!firstResult || !secondResult) {
            showErrorDialog();
            if (!firstResult) {
                primeNumber1.css('color', 'red');
            } else {
                primeNumber1.css('color', 'black');
            }

            if (!secondResult) {
                primeNumber2.css("color", "red");
            } else {
                primeNumber2.css('color', 'black');
            }

            $("#submit").prop('disabled', true);
        } else {
            hideErrorDialog();
            primeNumber1.css('color', 'black');
            primeNumber2.css('color', 'black');
            $("#submit").prop('disabled', false);
        }
    }

    function isPrime(number) {
        if (isNaN(number)) {
            return false;
        }
        if (number <= 1) {
            return false;
        }

        const sqrt = Math.floor(Math.sqrt(number));
        for (let i = 2; i <= sqrt; i++) {
            if (number % i === 0) {
                return false;
            }
        }
        return true;
    }

    function showErrorDialog() {
        const errorDialog = $('#error-dialog');
        errorDialog.css('display', 'block');
    }

    function hideErrorDialog() {
        const errorDialog = $('#error-dialog');
        errorDialog.css('display', 'none');
    }
});