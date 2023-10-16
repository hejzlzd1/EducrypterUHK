function clickToCopyText(textToCopy, elem) {
    navigator.clipboard.writeText(textToCopy);
    let iconElement = $(elem).find('i').first();
    let copyDoneElement = $(elem).find('.copyDone').first();
    iconElement.removeClass('fa-copy');
    iconElement.addClass('fa-check wiggle');
    copyDoneElement.show();

    setTimeout(function() {
        // After 3 seconds, remove the 'wiggle' class to stop the animation and add copy icon
        iconElement.removeClass('fa-check wiggle');
        iconElement.addClass('fa-copy');
        copyDoneElement.hide();
    }, 3000);
}

$(document).ready(function() {
    $('.binaryValidation').on('input', function(event) {
        const inputValue = $(this).val();
        const binaryPattern = /^[01]+$/;

        if (!binaryPattern.test(inputValue)) {
            event.target.setCustomValidity('Invalid input. Only 0 and 1 are allowed.');
        } else {
            event.target.setCustomValidity('');
        }
    });
});