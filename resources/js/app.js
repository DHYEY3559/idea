import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function () {
    // Hide the success message after 3 seconds
    setTimeout(function () {
        $('#success-message').fadeOut('slow');
    }, 3000);

    //modal toggle
    const modal = $('#create-modal');

    $('#create-modal-button').click(function () {
        modal.removeClass('hidden').fadeIn('slow');
    });

    $('.create-modal-close').click(function () {
        modal.fadeOut('slow', function () {
            modal.addClass('hidden');
        });
    });

    const editModal = $('#edit-modal');

    $('#edit-idea-button').click(function () {
        editModal.removeClass('hidden').fadeIn('slow');
    });

    $('.edit-modal-close').click(function () {
        editModal.fadeOut('slow', function () {
            editModal.addClass('hidden');
        });
    });

    $(document).on('click', '.status-btn', function () {
        $('#status').val($(this).data('status'));
        $('.status-btn').removeClass('btn-primary').addClass('btn-outlined');
        $(this).removeClass('btn-outlined').addClass('btn-primary');
    });

    let linkStack = [];
    $('#create-modal').on('click', '#add-link', function () {
        const newLink = $('#new-link')[0];
        if (!newLink.checkValidity()) {
            newLink.reportValidity();
            return;
        }

        const value = newLink.value.trim();

        if (linkStack.includes(value)) {
            return;
        }
        linkStack.push(value);
        RenderLinks();
        $('#new-link').val('');
    });

    $(document).on('click', '.remove-link', function (e) {
        const index = $(this).data('index');
        linkStack.splice(index, 1);
        RenderLinks();
        e.stopPropagation();
    });

    function RenderLinks() {
        $('#linkStack').html(
            linkStack
                .map(
                    (link, index) =>
                        `
            <div class="flex w-full items-center gap-2" style="margin-bottom: 10px;">
                <input class="input w-full rounded pr-12"
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
            `,
                )
                .join(''),
        );
    }

    let StepStack = [];
    $('#create-modal').on('click', '#add-step', function () {
        const newLink = $('#new-step')[0];
        if (!newLink.checkValidity()) {
            newLink.reportValidity();
            return;
        }

        const value = newLink.value.trim();

        if (StepStack.includes(value)) {
            return;
        }
        StepStack.push(value);
        RenderSteps();
        $('#new-step').val('');
    });

    $(document).on('click', '.remove-step', function (e) {
        const index = $(this).data('index');
        StepStack.splice(index, 1);
        RenderSteps();
        e.stopPropagation();
    });

    function RenderSteps() {
        $('#StepStack').html(
            StepStack.map(
                (Step, index) =>
                    `
            <div class="flex w-full items-center gap-2" style="margin-bottom: 10px;">
                <input class="input w-full rounded pr-12"
                            type="text"
                            data-index="${index}"
                            name="steps[]"
                            value="${Step}">
                </input>
                <button class="remove-step shrink-0 text-2xl leading-none text-red-500"
                        type="button"
                        data-test="remove-step">
                    &times;
                </button>
            </div>
            `,
            ).join(''),
        );
    }
});

// show.blade.php js here
//links guy
$(document).ready(function () {
    let editLinkStack = [];

    //first to start
    $('#edit-idea-button').click(function () {
        editLinkStack = [];
        $('#links-container input[name="links[]"]').each(function () {
            const value = $(this).val().trim();
            if (value) editLinkStack.push(value);
        });
        $('#links-container').empty();
        RenderEditLinks();
    });

    //add link guy

    $(document).on('click', '#add-link', function () {
        const newLink = $('#new-link-edit')[0];
        if (!newLink.checkValidity()) {
            newLink.reportValidity();
            return;
        }

        const value = newLink.value.trim();
        if (editLinkStack.includes(value)) {
            return;
        }
        editLinkStack.push(value);
        RenderEditLinks();
        $('#new-link-edit').val('');
    });

    //remove link guy
    $(document).on('click', '.remove-link-edit', function (e) {
        const index = $(this).data('index');
        editLinkStack.splice(index, 1);
        RenderEditLinks();
        e.stopPropagation();
    });

    //render the links guy
    function RenderEditLinks() {
        $('.editLinkStack').html(
            // Changed from $('#editLinkStack')
            editLinkStack
                .map(
                    (link, index) => `
            <div class="flex w-full items-center gap-2 mb-2">
                <input class="input w-full rounded pr-12" 
                       type="text" 
                       name="links[]" 
                       value="${link}">
                <button type="button" 
                        class="remove-link-edit shrink-0 text-2xl leading-none text-red-500" 
                        data-index="${index}">&times;</button>
            </div>
        `,
                )
                .join(''),
        );
    }
});

//steps guy
$(document).ready(function () {
    let editStepStack = [];

    //first to start
    $('#edit-idea-button').click(function () {
        editStepStack = [];
        $('#steps-container input[name="steps[]"]').each(function () {
            const stepId = $(this).closest('div').find('input[name="step_ids[]"]').val();;
            const description = $(this).val().trim();
            if (description) editStepStack.push({id: stepId || '', description});
        });
        $('#steps-container').empty();
        RenderEditSteps();
    });

    //add step guy

    $(document).on('click', '#add-step-button', function () {
        const newStep = $('#new-step-edit')[0];
        if (!newStep.checkValidity()) {
            newStep.reportValidity();
            return;
        }

        const value = newStep.value.trim();
        
        editStepStack.push({id:'', description: value});
        RenderEditSteps();
        $('#new-step-edit').val('');
    });

    //remove step guy
    $(document).on('click', '.remove-step-edit', function (e) {
        const index = $(this).data('index');
        editStepStack.splice(index, 1);
        RenderEditSteps();
        e.stopPropagation();
    });

    //render the steps guy
    function RenderEditSteps() {
        $('.editStepStack').html(
            // Changed from $('#editStepStack')
            editStepStack
                .map(
                    (step, index) => `
            <div class="flex w-full items-center gap-2 mb-2">
                <input type="hidden" name="step_ids[]" value="${step.id || ''}">
                <input class="input w-full rounded pr-12" 
                       type="text" 
                       name="steps[]" 
                       value="${step.description}">
                <button type="button" 
                        class="remove-step-edit shrink-0 text-2xl leading-none text-red-500" 
                        data-index="${index}">&times;</button>
            </div>
        `,
                )
                .join(''),
        );
    }
});
