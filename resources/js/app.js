//
import $ from "jquery";
window.$ = window.jQuery = $;

$(document).ready(function () {
    // Hide the success message after 3 seconds
    setTimeout(function () {
        $("#success-message").fadeOut("slow");
    }, 3000);
});
