<x-layout>
    <div class="mx-auto flex flex-col max-w-7xl justify-center px-4 sm:px-6 lg:px-8">
        <header class="py-8 md:py-12">
            <h1 class="text-center text-3xl font-bold tracking-tight">Your Ideas</h1>
            <p class="text-center text-muted-foreground mt-1">Create and Share Your Ideas {{ Auth::user()->name }}</p>
        </header>

        <x-card
        is="button" id="create-modal-button" data-modal-toggle="create-modal"
        class="mt-10 cursor-pointer h-32 w-full text-left mb-10">

            <p> what is your idea? </p>

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
    <div id="create-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black/50 backdrop-blur-xs hidden">
        <x-card>
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Create New Idea</h3>
            <form class="space-y-6" action="" method="POST">
                @csrf
                <x-form.feild label="Title" name="title"/>
                <x-form.feild label="Description" name="description"/>
                <x-form.feild label="Links" name="links"/>
                <button type="submit" class="btn w-full">Create Idea</button>
            </form>
        </x-card>
    </div>


</x-layout>
