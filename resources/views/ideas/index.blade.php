<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-center text-3xl font-bold tracking-tight">Your Ideas</h1>
            <p class="text-center text-muted-foreground mt-1">Create and Share Your Ideas {{ Auth::user()->name }}</p>
        </header>
        <div class="mt-10">
            <div class="grid md:grid-cols-2 gap-6 ">
                @forelse ($ideas as $idea)
                    <x-card>
                        <h2 class="text-lg font-semibold">{{ $idea->title }}</h2>
                        <div>
                            <span
                                class="text-sm bg-yellow-500/10 rounded-full px-2 py-1 border border-yellow-500/20 text-yellow-500">{{ $idea->status->label() }}</span>
                        </div>
                        <div class="text-muted-foreground mt-1">{{ $idea->description }}</div>
                        <div class="text-sm text-muted-foreground mt-2">Created at:
                            {{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center">
                        <p class="text-muted-foreground">You have no ideas yet. Start creating your first idea!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</x-layout>
