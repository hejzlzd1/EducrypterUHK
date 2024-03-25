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

    $('.primeNumber').on('change', function (event) {
        const value = $(this).val();
        // Check only if value is in <min,max> interval¨- implemented prime validation is not effective for large numbers
        if (value <= 67673697711) {
            if (!isPrime(value)) {
                $(this).css('color', 'red')
                event.target.setCustomValidity(Lang.get('jsErrors.inputCanBeOnlyPrimeNumber'));
            } else {
                $(this).css('color', 'black')
                event.target.setCustomValidity('');
            }
        }
    });

    $('.primitiveRootNumber').on('change', function (event) {
        const value = $(this).val();
        const modulus = $($(this).data('ref')).val();
        if (!isPrimitiveRoot(value, modulus)) {
            $(this).css('color', 'red')
            event.target.setCustomValidity(Lang.get('jsErrors.inputCanBeOnlyPrimitiveRoot'));
        } else {
            $(this).css('color', 'black')
            event.target.setCustomValidity('');
        }
    });

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

    window.generateInput = function (type, size, target, inputValueFrom) {
        if (inputValueFrom !== '') {
            if ($.isNumeric($(inputValueFrom).val()) && isPrime($(inputValueFrom).val())) {
                size = $(inputValueFrom).val();
            } else {
                $(inputValueFrom).val(size);
                $(inputValueFrom).trigger('change');
            }
        }

        const generators = {
            1: generateRandomText,
            2: generateRandomInteger,
            3: generateRandomBinaryString,
            4: generateRandomPrimeNumber,
            5: generateRandomPrimitiveRoot
        };

        const generator = generators[type];
        if (generator) {
            $(target).val(generator(size));
            $(target).trigger('change');
        }
    }
    function generateRandomBinaryString(size) {
        let binaryString = '';
        for (let i = 0; i < size; i++) {
            binaryString += Math.round(Math.random());
        }
        return binaryString;
    }

    function generateRandomInteger(size) {
        return Math.floor(Math.random() * (size - 1 + 1)) + 1;
    }

    const englishWords = [
        "apple", "banana", "carrot", "dog", "elephant", "fish", "giraffe",
        "house", "igloo", "jacket", "kite", "lemon", "monkey", "nest", "orange",
        "penguin", "queen", "rabbit", "sun", "tree", "umbrella", "violet", "whale",
        "xylophone", "yacht", "zebra"
    ];
    function generateRandomText(size) {
        const filteredWords = englishWords.filter(word => word.length <= size);
        if (filteredWords.length === 0) {
            return "randomword";
        }
        const randomIndex = Math.floor(Math.random() * filteredWords.length);
        return filteredWords[randomIndex];
    }

    function generateRandomPrimeNumber(size) {
        let randomNum = Math.floor(Math.random() * (size - 20)) + 20;
        while (!isPrime(randomNum)) {
            randomNum++;
        }

        return randomNum;
    }

    // Function to find the prime factors of a number
    function primeFactors(num) {
        const factors = [];
        for (let i = 2; i <= Math.sqrt(num); i++) {
            while (num % i === 0) {
                factors.push(i);
                num /= i;
            }
        }
        if (num > 1) factors.push(num);
        return factors;
    }

// Function to calculate modular exponentiation (a^b mod n)
    function modExponentiation(base, exponent, modulus) {
        let result = 1;
        base %= modulus;
        while (exponent > 0) {
            if (exponent % 2 === 1) {
                result = (result * base) % modulus;
            }
            exponent = Math.floor(exponent / 2);
            base = (base * base) % modulus;
        }
        return result;
    }

// Function to check if a number is a primitive root modulo n
    function isPrimitiveRoot(g, n) {
        const phi = n - 1;
        const factors = primeFactors(phi);

        for (let factor of factors) {
            if (modExponentiation(g, phi / factor, n) === 1) {
                return false;
            }
        }
        return true;
    }

    // Function to generate a random primitive root modulo n
    function generateRandomPrimitiveRoot(n) {
        let primitiveRoot;
        do {
            primitiveRoot = Math.floor(Math.random() * (n - 1) + 1);
        } while (!isPrimitiveRoot(primitiveRoot, n));
        return primitiveRoot;
    }

});
