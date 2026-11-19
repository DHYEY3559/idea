<x-layout>
    <div class="max-w-3xl flex flex-col gap-y-4 py-8 mx-auto">

        <div class="flex justify-between ">

            <a href="/ideas" class="flex items-center text-xl font-bold">
                <x-icons.back_arrow/>
                Back
            </a>
            <div class="flex gap-x-2">
                <button class="btn btn-outlined">Edit Idea
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
            <div class="w-3xl h-auto mx-auto">
                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image" class="w-full h-auto object-cover rounded-lg">
            </div>
        @endif

        <h1 class="text-2xl font-bold">{{ $idea->title }}</h1>
        <div class="flex gap-x-2 items-center">
            <x-status status="{{ $idea->status->value }}">
                {{ $idea->status->label() }}
            </x-status>
            <div class="text-sm text-muted-foreground mt-2">Created at: {{ $idea->created_at->format('Y-m-d H:i:s') }}</div>
        </div>
        <x-card>
            <div class="text-foreground max-w-none cursor-pointer">
                {{ $idea->description }}
            </div>
        </x-card>

        @if (!empty($idea->steps))
            <div>
                <h2 class="text-2xl mb-4 font-bold">Steps</h2>
                <div class="flex flex-col gap-y-2">
                    @foreach ($idea->steps as $key => $step)
                    <x-card>
                        {{ $step->description }}
                    </x-card>
                    @endforeach
                </div>
            </div>
        @endif



        @if (!empty($idea->links))
            <div>
                <h2 class="text-2xl mb-4 font-bold">Link</h2>
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
