<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-center text-3xl font-bold tracking-tight">Your Ideas</h1>
            <p class="text-center text-muted-foreground mt-1">Create and Share Your Ideas {{ Auth::user()->name }}</p>
        </header>
        <div class="mt-10">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 ">
                @forelse ($ideas as $idea)
                    <div class="border border-border rounded-lg p-4 md:test-sm block">
                        <h2 class="text-lg font-semibold">{{ $idea->title }}</h2>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center">
                        <p class="text-muted-foreground">You have no ideas yet. Start creating your first idea!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</x-layout>
