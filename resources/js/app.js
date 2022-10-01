import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function() {
    var delay = 5000
    $($('.js-timer').get().reverse()).each((i, obj) => {
        closeMessage(obj,delay);
        delay += 4000;
    });
});

function closeMessage(obj, delay) {
    setTimeout(()=>{
        $(obj).addClass("is-hidden");
    },delay)
}

$('.js-messageClose').on('click', function(e) {
    closeMessage($(this).closest('.Message'));
});

$(".close").click(function() {
    $(this)
        .parent(".alert")
        .fadeOut();
});
