
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
        const clickedCancelButton = $(event.target).closest("#create-modal .btn-outlined").length > 0;
        if (!clickedInsideModal && !clickedModalButton) {
            modal.fadeOut("slow", function () {
                modal.addClass("hidden");
            });
        }
        if (clickedCancelButton) {
            modal.fadeOut("slow", function () {
                modal.addClass("hidden");
            });
        }
    });

    $(document).on("click", ".status-btn", function () {
        $("#status").val($(this).data("status"));
        $(".status-btn").removeClass("btn-primary").addClass("btn-outlined");
        $(this).removeClass("btn-outlined").addClass("btn-primary");
    });

    let linkStack = [];
    $(document).on("click","#add-link", function(){
        if($("#new-link").val().trim() !== ""){
            const value = $("#new-link").val();
            linkStack.push(value);
            RenderLinks();
            $("#new-link").val("");
        }
    });

    $(document).on("click", ".remove-link", function (e) {
        const index = $(this).data("index");
        linkStack.splice(index, 1);
        RenderLinks();
        e.stopPropagation();
    });

    function RenderLinks() {
        $("#linkStack").html(linkStack.map((link, index) =>
            `<input class=input flex-1
                        -mt-1.5 w-full
                        rounded"
                        type="text"
                        data-indes="${index}"
                        name="links[]"
                        value="${link}">
            </input>
            <button class="absolute right-110 remove-link"
                    type="button"
                    data-test="remove-link">
                <x-icons.close/>
            </button>

            `
    ).join(""));
    };
});

