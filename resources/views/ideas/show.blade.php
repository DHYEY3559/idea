<x-layout>
    <div class="mx-auto flex max-w-4xl flex-col gap-y-6 py-4 sm:py-8">

        <div class="flex flex-wrap items-center justify-between gap-4">
            <a href="/ideas" class="text-muted-foreground hover:text-foreground group inline-flex items-center gap-2 text-sm font-semibold transition-colors">
                <span class="border-border/80 bg-card/80 group-hover:border-primary/40 flex size-8 items-center justify-center rounded-xl border transition-colors">
                    <x-icons.back_arrow />
                </span>
                Back to Ideas
            </a>

            <div class="flex items-center gap-2.5">
                <button class="btn btn-outlined"
                    data-modal-toggle="edit-modal"
                    data-test="edit-idea-button"
                    id="edit-idea-button"
                >
                    Edit Idea
                    <x-icons.external />
                </button>

                <form action="{{ route('ideas.destroy', $idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outlined border-red-500/30 text-red-400 hover:border-red-500/60 hover:bg-red-500/10">
                        Delete Idea
                    </button>
                </form>
            </div>
        </div>

        @if ($idea->image_path)
            <div class="border-border/80 bg-card overflow-hidden rounded-2xl border shadow-lg">
                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image" class="max-h-105 w-full object-cover">
            </div>
        @endif

        <div class="space-y-3">
            <div class="flex flex-wrap items-center gap-3">
                <x-status status="{{ $idea->status->value }}">
                    {{ $idea->status->label() }}
                </x-status>
                <span class="text-muted-foreground text-xs sm:text-sm">
                    Created {{ $idea->created_at->format('M d, Y · H:i') }}
                </span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight sm:text-4xl">{{ $idea->title }}</h1>
        </div>

        @if ($idea->description)
            <x-card is="div" class="p-6">
                <p class="text-foreground/90 text-sm leading-relaxed whitespace-pre-line sm:text-base">
                    {{ $idea->description }}
                </p>
            </x-card>
        @endif

        @if (!empty($idea->steps) && count($idea->steps) > 0)
            <section class="space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold tracking-tight sm:text-xl">Steps</h2>
                    <span class="text-muted-foreground text-xs font-medium">
                        {{ $idea->steps->where('completed', true)->count() }} / {{ $idea->steps->count() }} completed
                    </span>
                </div>

                <div class="flex flex-col gap-y-2.5">
                    @foreach ($idea->steps as $key => $step)
                        <x-card is="div" class="hover:border-primary/40 px-4 py-3.5">
                            <form action="{{ route('steps.update', $step) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center gap-x-3.5 text-sm">
                                    <button type="submit" role="checkbox"
                                        aria-checked="{{ $step->completed ? 'true' : 'false' }}"
                                        class="flex size-5 shrink-0 items-center justify-center rounded-md border transition-colors {{ $step->completed ? 'bg-primary border-primary text-primary-foreground' : 'border-border bg-background/60 hover:border-primary text-transparent' }}">
                                        &check;
                                    </button>
                                    <span class="{{ $step->completed ? 'text-muted-foreground line-through' : 'text-foreground font-medium' }}">
                                        {{ $step->description }}
                                    </span>
                                </div>
                            </form>
                        </x-card>
                    @endforeach
                </div>
            </section>
        @endif

        @if (!empty($idea->links) && count($idea->links) > 0)
            <section class="space-y-3">
                <h2 class="text-lg font-bold tracking-tight sm:text-xl">Links</h2>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach ($idea->links as $key => $link)
                        <x-card is="a" href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                            class="hover:border-primary/45 group flex items-center justify-between gap-3 px-4 py-3.5">
                            <span class="text-foreground/90 group-hover:text-primary truncate text-sm font-medium transition-colors">
                                {{ $link }}
                            </span>
                            <span class="text-muted-foreground group-hover:text-primary shrink-0 transition-colors">
                                <x-icons.external />
                            </span>
                        </x-card>
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    <!--modal-->
    <x-modal name="edit" title="Edit Idea">
        <form action="{{ route('ideas.update', $idea) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label for="title" class="label mb-1.5">Title</label>
                <input type="text" name="title" id="title" value="{{ $idea->title }}" class="input w-full">
            </div>

            <div>
                <label for="Status" class="label mb-2">Status</label>
                <div class="flex flex-wrap gap-2">
                    @foreach (App\IdeaStatus::cases() as $status)
                        <button type="button"
                            data-status="{{ $status->value }}"
                            data-test="status-button-{{ $status->value }}"
                            class="btn status-btn {{ $idea->status->value === $status->value ? '' : 'btn-outlined' }}">
                            {{ $status->label() }}
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="status" value="{{ $idea->status->value }}" id="status">
            </div>

            <div>
                <label for="description" class="label mb-1.5">Description</label>
                <textarea name="description" id="description" rows="4" class="textarea w-full">{{ $idea->description }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label for="Image" class="label">Cover Image</label>
                <input type="file" name="image" accept="image/*">
                <x-form.error name="image" class="text-error text-xs" />
            </div>

            <div>
                <label for="steps" class="label mb-2">Steps</label>
                <div class="mb-3 flex gap-2">
                    <input type="text" id="new-step-edit" placeholder="Add a Step" class="input w-full">
                    <button type="button" id="add-step-button" class="btn btn-primary shrink-0">Add Step</button>
                </div>
                <div id="steps-container" class="flex flex-col gap-y-2">
                    @foreach ($idea->steps as $index => $steps)
                        <div class="flex items-center gap-x-2">
                            <input type="hidden" name="step_ids[]" value="{{ $step->id }}">
                            <input type="text" name="steps[]" value="{{ $steps->description }}" class="input w-full">
                            <button type="button" class="btn btn-outlined remove-step-edit shrink-0" data-index="{{ $index }}">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="editStepStack flex w-full flex-col"></div>
            </div>

            <div>
                <label for="links" class="label mb-2">Links</label>
                <div class="mb-3 flex gap-2">
                    <input type="url" data-test="new-link-edit" id="new-link-edit" placeholder="https://example.com" class="input w-full">
                    <button type="button" id="add-link" class="btn btn-primary shrink-0">Add Link</button>
                </div>
                <div id="links-container" class="flex flex-col gap-y-2">
                    @foreach ($idea->links as $index => $link)
                        <div class="flex items-center gap-x-2">
                            <input type="text" name="links[]" value="{{ $link }}" class="input w-full">
                            <button type="button" class="btn btn-outlined remove-link-edit shrink-0" data-index="{{ $index }}">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="editLinkStack mt-2 flex w-full flex-col"></div>
            </div>

            <div class="border-border/80 flex justify-end gap-x-2 border-t pt-4">
                <button type="button" class="edit-modal-close btn btn-outlined" data-modal-toggle="edit-modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">Update Idea</button>
            </div>
        </form>
    </x-modal>
</x-layout>
