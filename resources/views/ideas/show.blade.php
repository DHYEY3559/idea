<x-layout>
    <div class="mx-auto flex max-w-3xl flex-col gap-y-4 py-8">

        <div class="flex justify-between">

            <a href="/ideas" class="flex items-center text-xl font-bold">
                <x-icons.back_arrow/>
                Back
            </a>
            <div class="flex gap-x-2">
                <button class="btn btn-outlined"
                    data-modal-toggle="edit-modal"
                    data-test="edit-idea-button"
                    id="edit-idea-button"
                >
                    Edit Idea
                    <x-icons.external/>
                </button>
                <form action="{{ route('ideas.destroy', $idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outlined text-red-500">Delete Idea</button>
                </form>
            </div>
        </div>
        @if ($idea->image_path)
            <div class="mx-auto h-auto w-3xl">
                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image" class="h-auto w-full rounded-lg object-cover">
            </div>
        @endif

        <h1 class="text-2xl font-bold">{{ $idea->title }}</h1>
        <div class="flex items-center gap-x-2">
            <x-status status="{{ $idea->status->value }}">
                {{ $idea->status->label() }}
            </x-status>
            <div class="text-muted-foreground mt-2 text-sm">Created at: {{ $idea->created_at->format('Y-m-d H:i:s') }}</div>
        </div>
        <x-card>
            <div class="text-foreground max-w-none cursor-pointer">
                {{ $idea->description }}
            </div>
        </x-card>

        @if (!empty($idea->steps))
            <div>
                <h2 class="mb-4 text-2xl font-bold">Steps</h2>
                <div class="flex flex-col gap-y-2">
                    @foreach ($idea->steps as $key => $step)
                        <x-card>
                            <form action="{{ route('steps.update', $step) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="text-muted-foreground flex gap-x-3 text-sm">
                                    <button ype="submit" role="checkbox" class="size-5 flex items-center justify-center rounded-lg text-primary-foreground border border-primary {{ $step->completed ? "bg-primary" : "border border-primary" }}">
                                        &check;
                                    </button>
                                </span>
                                {{ $step->description }}
                                <span>
                                </div>
                            </form>
                        </x-card>
                    @endforeach
                </div>
            </div>
        @endif

        @if (!empty($idea->links))
            <div>
                <h2 class="mb-4 text-2xl font-bold">Link</h2>
                <div class="flex gap-x-4">
                    @foreach ($idea->links as $key => $link)
                        <x-card>
                            {{  $link }}
                        </x-card>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!--modal-->

    <x-modal name="edit" title="Edit Idea">
        <div>
            <form action="{{ route('ideas.update', $idea) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="space-y-6">
                    <div>
                        <label for="title" class="mb-2 block text-sm font-medium">Title</label>
                        <input type="text" name="title" id="title" value="{{ $idea->title }}" class="input w-full">
                    </div>

                    <div class="mt-4">
                        <label for="Status" class="label">Status</label>

                        <div class="mt-2">
                            @foreach( App\IdeaStatus::cases() as $status)
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
                        <label for="description" class="mb-2 block text-sm font-medium">Description</label>
                        <textarea name="description" id="description" rows="4" class="input w-full">{{ $idea->description }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label for="Image" label="Image" class="label mt-2">Image</label>
                        <input type="file" name="image" accept="image/*">

                        <x-form.error name="image" class="text-error text-sm" />

                    </div>

                    <div class="mt-4">
                        <label for="links" class="mb-2 block text-sm font-medium">Steps</label>
                        <div class="flex flex-col gap-y-2">
                            @foreach ($idea->steps as $key => $steps)
                                <div class="flex items-center gap-x-2">
                                    <input type="text" name="steps[]" value="{{ $steps->description }}" class="input w-full">
                                    <button type="button" class="btn btn-outlined">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-step-button" class="btn btn-outlined mt-2">Add Step</button>
                    </div>

                    <div class="mt-4">
                        <label for="links" class="mb-2 block text-sm font-medium">Links</label>
                        <div id="links-container" class="flex flex-col gap-y-2">

                             <input type="text" 
                                        id="new-link-edit" 
                                        class="input w-full">
                            <button type="button" 
                                class="btn btn-outlined">
                                    Add Link
                            </button>

                            @foreach ($idea->links as $index=>$link)
                                <div class="flex items-center gap-x-2">
                                    <input type="text" 
                                        id="new-link-edit" 
                                        name="links[]" 
                                        value="{{ $link }}" 
                                        class="input w-full">
                                    <button type="button" 
                                        class="btn btn-outlined 
                                            remove-link-edit" 
                                        data-index="{{ $index }}">
                                            Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div  class="editLinkStack flex w-full flex-col" ></div>
                    </div>

                    <div class="flex justify-end gap-x-2">
                        <button type="submit" class="btn btn-primary mt-4">Update Idea</button>
                        <button type="button"
                            class="edit-modal-close btn btn-outlined mt-4"
                            data-modal-toggle="edit-modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>


    </x-modal>




</x-layout>
