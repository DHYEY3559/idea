<x-layout>
    <div class="mx-auto flex flex-col max-w-7xl justify-center px-4 sm:px-6 lg:px-8">
        <header class="py-8 md:py-12">
            <h1 class="text-center text-3xl font-bold tracking-tight">Your Ideas</h1>
            <p class="text-center text-muted-foreground mt-1">Create and Share Your Ideas {{ Auth::user()->name }}</p>
        </header>

        <x-card
        is="button"
            id="create-modal-button"
            data-modal-toggle="create-modal"
            data-test="create-idea-button"
            class="mt-10 cursor-pointer w-full text-left mb-10">
            <p>
                what is your idea?
            </p>
        </x-card>

        <div class="flex align-items-left gap-2">
            <a class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}" href="/ideas">All</a>
            @foreach ( App\IdeaStatus::cases() as $status)
            <a href="/ideas?status={{ $status->value }}" class="
                btn
                {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                {{ $status->label() }}
                <span>
                    {{ $statusCounts->get($status->value) }}
                </span>
            </a>
            @endforeach
        </div>

        <div class="mt-10">
            <div class="grid md:grid-cols-2 gap-6 ">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('ideas.show', $idea) }}"
                        class="hover:bg-base-200 transition-colors duration-300">
                        <h2 class="text-lg font-semibold mb-5">{{ $idea->title }}</h2>
                        <x-status status="{{ $idea->status->value }}">
                            {{ $idea->status->label() }}
                        </x-status>
                        <div class="text-muted-foreground mt-3">{{ $idea->description }}</div>
                        <div class="text-sm text-muted-foreground mt-2">Created at:
                            {{ $idea->created_at->diffForHumans() }}
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center">
                        <p class="text-muted-foreground">You have no ideas yet. Start creating your first idea!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>



    <!--modal-->
    <x-modal name="create" title="Create New Idea">
        <div>
            <form action="{{ route('ideas.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-form.feild label='Title' type="text" name="title" placeholder="Enter your idea title" required/>
                </div>

                <div class="mt-4">
                    <label for="Status" class="label">Status</label>

                    <div class="mt-2">
                        @foreach( App\IdeaStatus::cases() as $status)
                            <button type="button"
                            data-status="{{ $status->value }}"
                            data-test="status-button-{{ $status->value }}"
                            class="btn status-btn
                            {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                            {{ $status->label() }}
                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="status" value="" id="status">

                    <div class="mt-4">
                        <x-form.feild label='Description' type="textarea" name="description" placeholder="Enter your idea description" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Create Idea</button>
                        <button type="button" class="btn btn-outlined mt-4"
                            data-modal-toggle="create-modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-modal>
</x-layout>

<!-- 300th contribution of 2026 -->
