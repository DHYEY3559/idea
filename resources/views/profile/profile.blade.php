<x-layout>
    <div class="mx-auto max-w-3xl py-4 sm:py-8">
        <div class="mb-6 flex items-center justify-between">
            <a class="text-muted-foreground hover:text-foreground group inline-flex items-center gap-2 text-sm font-semibold transition-colors"
                href="{{ route('ideas.index') }}">
                <span class="border-border/80 bg-card/80 group-hover:border-primary/40 flex size-8 items-center justify-center rounded-xl border transition-colors">
                    <x-icons.back_arrow />
                </span>
                Back to Ideas
            </a>
            <a class="btn" href="/profile/edit">Edit Profile</a>
        </div>

        <x-card is="div" class="overflow-hidden p-0">
            <div class="from-primary/25 via-primary/10 to-card h-28 w-full bg-gradient-to-r"></div>

            <div class="px-6 pb-8 sm:px-8">
                <div class="-mt-14 mb-6 flex flex-col items-start gap-5 sm:flex-row sm:items-end">
                    <div class="relative size-28 shrink-0">
                        <img
                            src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw3fHxwZW9wbGV8ZW58MHwwfHx8MTcxMTExMTM4N3ww&ixlib=rb-4.0.3&q=80&w=1080' }}"
                            alt="{{ $profile->user->name }}'s profile photo"
                            class="border-card ring-primary/40 h-full w-full rounded-full border-4 object-cover ring-2" />
                    </div>

                    <div class="min-w-0 flex-1 pt-2">
                        <h1 class="truncate text-2xl font-bold tracking-tight sm:text-3xl">
                            {{ $profile->user->name }}
                        </h1>
                        @if ($profile->profile_description)
                            <p class="text-muted-foreground mt-1 text-sm leading-relaxed sm:text-base">
                                {{ $profile->profile_description }}
                            </p>
                        @else
                            <p class="text-muted-foreground/70 mt-1 text-sm italic">
                                No bio added yet.
                            </p>
                        @endif
                    </div>
                </div>

                <div class="border-border/80 grid gap-4 border-t pt-6 sm:grid-cols-2">
                    <div class="border-border/60 bg-background/40 rounded-xl border p-4">
                        <dt class="text-muted-foreground text-xs font-medium tracking-wide uppercase">Name</dt>
                        <dd class="mt-1 text-base font-semibold">{{ $profile->user->name }}</dd>
                    </div>

                    <div class="border-border/60 bg-background/40 rounded-xl border p-4">
                        <dt class="text-muted-foreground text-xs font-medium tracking-wide uppercase">Email</dt>
                        <dd class="mt-1 truncate text-base font-semibold">{{ $profile->user->email ?? 'Not Provided' }}</dd>
                    </div>

                    <div class="border-border/60 bg-background/40 rounded-xl border p-4">
                        <dt class="text-muted-foreground text-xs font-medium tracking-wide uppercase">Date Of Birth</dt>
                        <dd class="mt-1 text-base font-semibold">{{ $profile->DOB ?? 'Not Provided' }}</dd>
                    </div>

                    <div class="border-border/60 bg-background/40 rounded-xl border p-4">
                        <dt class="text-muted-foreground text-xs font-medium tracking-wide uppercase">Gender</dt>
                        <dd class="mt-1 text-base font-semibold">{{ $profile->Gender ?? 'Not Provided' }}</dd>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</x-layout>
