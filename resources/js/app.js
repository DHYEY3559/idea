
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
        const newLink = $("#new-link")[0];
        if(!newLink.checkValidity()){
            newLink.reportValidity();
            return;
        }

        const value = newLink.value.trim();

        if(linkStack.includes(value)){
            return;
        }
        linkStack.push(value);
        RenderLinks();
        $("#new-link").val("");
    });

    $(document).on("click", ".remove-link", function (e) {
        const index = $(this).data("index");
        linkStack.splice(index, 1);
        RenderLinks();
        e.stopPropagation();
    });

    function RenderLinks() {
        $("#linkStack").html(linkStack.map((link, index) =>
            `
            <div class="flex w-full items-center gap-2" style="margin-bottom: 10px;">
                <input class=input w-full
                            rounded pr-12"
                            type="text"
                            data-index="${index}"
                            name="links[]"
                            value="${link}">
                </input>
                <button class="remove-link shrink-0 text-2xl leading-none text-red-500"
                        type="button"
                        data-test="remove-link">
                    &times;
                </button>
            </div>
            `
    ).join(""));
    };


    let StepStack = [];
    $(document).on("click","#add-step", function(){
        const newLink = $("#new-step")[0];
        if(!newLink.checkValidity()){
            newLink.reportValidity();
            return;
        }

        const value = newLink.value.trim();

        if(StepStack.includes(value)){
            return;
        }
        StepStack.push(value);
        RenderSteps();
        $("#new-step").val("");
    });

    $(document).on("click", ".remove-step", function (e) {
        const index = $(this).data("index");
        StepStack.splice(index, 1);
        RenderSteps();
        e.stopPropagation();
    });

    function RenderSteps() {
        $("#StepStack").html(StepStack.map((Step, index) =>
            `
            <div class="flex w-full items-center gap-2" style="margin-bottom: 10px;">
                <input class=input w-full
                            rounded pr-12"
                            type="text"
                            data-index="${index}"
                            name="steps"
                            value="${Step}">
                </input>
                <button class="remove-step shrink-0 text-2xl leading-none text-red-500"
                        type="button"
                        data-test="remove-step">
                    &times;
                </button>
            </div>
            `
    ).join(""));
    };

});

