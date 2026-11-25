<x-layout>
    <div class="mx-auto flex max-w-7xl flex-col">
        <header class="pt-4 pb-8 md:pt-8 md:pb-10">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <div class="border-primary/25 bg-primary/10 text-primary mb-3 inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold tracking-wide uppercase">
                        <span class="bg-primary size-1.5 rounded-full"></span>
                        Idea Workspace
                    </div>
                    <h1 class="text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">Your Ideas</h1>
                    <p class="text-muted-foreground mt-2 max-w-2xl text-base sm:text-lg">
                        Capture sparks, break them into steps, and ship what matters, {{ Auth::user()->name }}.
                    </p>
                </div>

                <div class="text-muted-foreground hidden items-center gap-2 text-sm md:flex">
                    <span class="border-border/80 bg-card/70 rounded-xl border px-3 py-1.5 font-medium">
                        {{ $ideas->count() }} {{ Str::plural('idea', $ideas->count()) }} shown
                    </span>
                </div>
            </div>
        </header>

        <x-card
            is="button"
            id="create-modal-button"
            data-modal-toggle="create-modal"
            data-test="create-idea-button"
            class="group hover:border-primary/50 hover:bg-card mb-6 flex w-full cursor-pointer items-center justify-between gap-4 px-5 py-4 text-left shadow-md">
            <div class="flex items-center gap-3.5">
                <span class="bg-primary/15 text-primary group-hover:bg-primary group-hover:text-primary-foreground flex size-10 shrink-0 items-center justify-center rounded-xl transition-colors duration-200">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <div>
                    <p class="text-foreground text-base font-semibold">What is your idea?</p>
                    <p class="text-muted-foreground text-xs sm:text-sm">Click to add a title, status, steps, links, or cover image</p>
                </div>
            </div>
            <span class="btn hidden shrink-0 sm:inline-flex">New Idea</span>
        </x-card>

        <div class="border-border/80 bg-card/50 flex flex-wrap items-center gap-2 rounded-2xl border p-2">
            <a class="btn {{ request()->has('status') ? 'btn-outlined border-transparent bg-transparent' : '' }}" href="/ideas">
                All
            </a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') === $status->value ? '' : 'btn-outlined border-transparent bg-transparent' }}">
                    <span>{{ $status->label() }}</span>
                    <span class="{{ request('status') === $status->value ? 'bg-black/20 text-primary-foreground' : 'bg-white/10 text-muted-foreground' }} rounded-full px-2 py-0.5 text-xs font-semibold">
                        {{ $statusCounts->get($status->value, 0) }}
                    </span>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('ideas.show', $idea) }}"
                        class="group hover:border-primary/45 hover:bg-card flex h-full flex-col justify-between gap-4 hover:-translate-y-0.5 hover:shadow-xl">
                        <div>
                            @if ($idea->image_path)
                                <div class="border-border/60 mb-4 aspect-video w-full overflow-hidden rounded-xl border">
                                    <img src="{{ asset('storage/' . $idea->image_path) }}"
                                        alt="Idea Image"
                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            @endif

                            <div class="mb-3 flex items-start justify-between gap-3">
                                <h2 class="group-hover:text-primary line-clamp-2 text-lg font-semibold tracking-tight transition-colors">
                                    {{ $idea->title }}
                                </h2>
                            </div>

                            <x-status status="{{ $idea->status->value }}">
                                {{ $idea->status->label() }}
                            </x-status>

                            @if ($idea->description)
                                <p class="text-muted-foreground mt-3 line-clamp-3 text-sm leading-relaxed">
                                    {{ $idea->description }}
                                </p>
                            @endif
                        </div>

                        <div class="border-border/60 text-muted-foreground flex items-center justify-between border-t pt-3 text-xs">
                            <span>{{ $idea->created_at->diffForHumans() }}</span>
                            <span class="group-hover:text-primary inline-flex items-center gap-1 font-medium transition-colors">
                                Open
                                <svg class="size-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </div>
                    </x-card>
                @empty
                    <div class="border-border/80 bg-card/40 col-span-full flex flex-col items-center justify-center rounded-2xl border border-dashed px-6 py-16 text-center">
                        <div class="bg-primary/10 text-primary mb-4 flex size-14 items-center justify-center rounded-2xl">
                            <i data-lucide = "lightbulb"></i>
                            <script>lucide.createIcons();</script>
                        </div>
                        <h3 class="text-foreground text-lg font-semibold">No ideas yet</h3>
                        <p class="text-muted-foreground mt-1 max-w-sm text-sm">
                            You have no ideas in this view. Click "What is your idea?" above to capture your first one.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!--modal-->
    <x-modal name="create" title="Create New Idea">
        <form action="{{ route('ideas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <x-form.feild label='Title' data-test="modal-idea-title" type="text" name="title" placeholder="Enter your idea title" required />

            <div>
                <label for="Status" class="label mb-2">Status</label>
                <div class="flex flex-wrap gap-2">
                    @foreach (App\IdeaStatus::cases() as $status)
                        <button type="button"
                            data-status="{{ $status->value }}"
                            data-test="status-button-{{ $status->value }}"
                            class="btn status-btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                            {{ $status->label() }}
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="status" value="" id="status">
            </div>

            <div class="space-y-1.5">
                <label for="Image" class="label">Cover Image</label>
                <input type="file" name="image" accept="image/*">
                <x-form.error name="image" class="text-error text-xs" />
            </div>

            <x-form.feild label='Description' type="textarea" data-test="modal-idea-description" name="description" placeholder="Describe your idea, goals, or inspiration..." />

            <fieldset class="flex w-full flex-col space-y-2.5">
                <legend class="label">Steps</legend>
                <div class="relative w-full">
                    <input
                        type="text"
                        id="new-step"
                        data-test="new-step"
                        placeholder="Add an actionable step..."
                        class="input w-full pr-12"
                    >
                    <button
                        type="button"
                        id="add-step"
                        data-test="add-step"
                        class="text-muted-foreground hover:text-primary absolute top-1/2 right-2.5 -translate-y-1/2 rounded-lg p-1.5 transition-colors"
                    >
                        <x-icons.add />
                    </button>
                </div>
                <div id="StepStack" class="flex w-full flex-col"></div>
            </fieldset>

            <fieldset class="flex w-full flex-col space-y-2.5">
                <legend class="label">Links</legend>
                <div class="relative w-full">
                    <input
                        type="url"
                        id="new-link"
                        data-test="new-link"
                        placeholder="https://example.com"
                        autocomplete="url"
                        spellcheck="false"
                        class="input w-full pr-12"
                    >
                    <button
                        type="button"
                        id="add-link"
                        data-test="add-link"
                        class="text-muted-foreground hover:text-primary absolute top-1/2 right-2.5 -translate-y-1/2 rounded-lg p-1.5 transition-colors"
                    >
                        <x-icons.add />
                    </button>
                </div>
                <div id="linkStack" class="flex w-full flex-col"></div>
            </fieldset>

            <div class="border-border/80 flex items-center justify-end gap-2 border-t pt-4">
                <button type="button" class="create-modal-close btn btn-outlined" data-modal-toggle="create-modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">Create Idea</button>
            </div>
        </form>
    </x-modal>
</x-layout>
