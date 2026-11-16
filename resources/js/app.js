//
import $ from "jquery";
window.$ = window.jQuery = $;

$(document).ready(function () {
    // Hide the success message after 3 seconds
    setTimeout(function () {
        $("#success-message").fadeOut("slow");
    }, 3000);

    //modal toggle
    const modal = $('#create-modal');

    $("#create-modal-button").click(function () {
        modal.removeClass("hidden").hide().fadeIn("slow");
    });

    $("#close-modal-button").click(function () {
        modal.fadeOut("slow", function () {
            modal.addClass("hidden");
        });
    });
});


