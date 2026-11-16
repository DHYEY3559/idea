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

    $(document).on("click", function (event) {
        const clickedInsideModal = $(event.target).closest("#create-modal > *").length > 0;
        const clickedModalButton = $(event.target).closest("#create-modal-button").length > 0;

        if (!clickedInsideModal && !clickedModalButton) {
            modal.fadeOut("slow", function () {
                modal.addClass("hidden");
            });
        }
    });
});

