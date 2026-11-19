<x-layout>
    <div class="mx-auto flex max-w-3xl flex-col gap-y-4 py-8">

        <div class="flex justify-between">

            <a href="/ideas" class="flex items-center text-xl font-bold">
                <x-icons.back_arrow/>
                Back
            </a>
            <div class="flex gap-x-2">
                <button class="btn btn-outlined"
                    data-test="edit-idea-button"
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
</x-layout>
