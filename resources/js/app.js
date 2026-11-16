//
import $ from "jquery";
window.$ = window.jQuery = $;

$(document).ready(function () {
    // Hide the success message after 3 seconds
    setTimeout(function () {
        $("#success-message").fadeOut("slow");
    }, 3000);

    //modal toggle
    const modalButton = document.getElementById("create-modal-button");
    const modal = document.getElementById("create-modal");
    const closeModalButton = document.getElementById("close-modal-button");

    modalButton.addEventListener("click", function () {
        modal.classList.remove("hidden");
    });

    closeModalButton.addEventListener("click", function () {
        modal.classList.add("hidden");
    });
});


