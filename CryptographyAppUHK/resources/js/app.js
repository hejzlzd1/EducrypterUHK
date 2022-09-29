import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function() {
    setTimeout(function(){
        $("#alert-message").fadeTo(2000, 500).slideUp(500, function(){
            $("#alert-message").slideUp(500);
        });
    }, 5000)
});

$(".close").click(function() {
    $(this)
        .parent(".alert")
        .fadeOut();
});
