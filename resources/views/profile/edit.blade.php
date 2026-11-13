<x-layout>
    <section class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl border border-border bg-card shadow-2xl shadow-black/20">
            <div class="h-32 bg-gradient-to-r from-primary/30 via-primary/10 to-transparent sm:h-40"></div>

            <div class="-mt-16 px-6 pb-8 sm:-mt-20 sm:px-10">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                    <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-end">
                        <div class="relative">
                            <img
                                src="{{ $profile->profile_image ? asset('storage/'.$profile->profile_image) : 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?auto=format&fit=crop&w=320&q=80' }}"
                                alt="{{ $profile->user->name }}'s profile photo"
                                class="h-32 w-32 rounded-full border-4 border-card object-cover shadow-xl sm:h-40 sm:w-40"
                            >
                        </div>

                        <div class="text-center sm:pb-2 sm:text-left">
                            <p class="text-sm font-medium text-muted-foreground">Your profile</p>
                            <h1 class="mt-1 text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
                                {{ $profile->user->name }}
                            </h1>
                            <p class="mt-2 text-sm text-muted-foreground">{{ $profile->user->email }}</p>
                        </div>
                    </div>

                    <a href="/profile" class="inline-flex items-center justify-center rounded-lg border border-border px-4 py-2 text-sm font-medium text-foreground transition hover:border-primary hover:text-primary">
                        View profile
                    </a>
                </div>

                <div class="mt-10 grid gap-8 lg:grid-cols-[1.4fr_1fr]">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-border bg-background/40 p-6">
                        @csrf
                        @method('PATCH')

                        <div class="mb-5">
                            <h2 class="text-lg font-semibold text-foreground">Profile photo</h2>
                            <p class="mt-1 text-sm text-muted-foreground">Choose a JPG, PNG, or WEBP image up to 2 MB.</p>
                        </div>

                        <label for="profile_image" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-border px-6 py-8 text-center transition hover:border-primary hover:bg-primary/5">
                            <svg class="h-8 w-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16.5V20h3.5L18.8 8.7a2.1 2.1 0 0 0-3-3L3.5 18.5M14.5 7.5l2 2" />
                            </svg>
                            <span class="mt-3 text-sm font-semibold text-foreground">Choose a new profile picture</span>
                            <span class="mt-1 text-xs text-muted-foreground">Click to browse your files</span>
                            <input id="profile_image" name="profile_image" type="file" accept="image/*" class="sr-only" required>
                        </label>

                        @error('profile_image')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="mt-5 inline-flex w-full items-center justify-center rounded-lg bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:brightness-110">
                            Save profile picture
                        </button>
                    </form>

                    <div class="rounded-2xl border border-border bg-background/40 p-6">
                        <div class="mb-5">
                            <h2 class="text-lg font-semibold text-foreground">About you</h2>
                            <p class="mt-1 text-sm text-muted-foreground">Your saved profile description.</p>
                        </div>

                        <div>
                            <label for="profile_description" class="mb-2 block text-sm font-medium text-foreground">
                                Description
                            </label>
                            <textarea
                                id="profile_description"
                                name="profile_description"
                                rows="6"
                                readonly
                                class="block w-full resize-none rounded-xl border border-border bg-card px-4 py-3 text-sm leading-6 text-foreground outline-none placeholder:text-muted-foreground"
                                placeholder="No description has been added yet."
                            >{{ $profile->profile_description }}</textarea>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-border bg-background/40 p-6">
                        <h2 class="text-lg font-semibold text-foreground">Personal details</h2>
                        <dl class="mt-5 divide-y divide-border">
                            <div class="flex items-center justify-between gap-4 py-4 first:pt-0">
                                <dt class="text-sm text-muted-foreground">Name</dt>
                                <dd class="text-right text-sm font-semibold text-foreground">{{ $profile->user->name }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-4">
                                <dt class="text-sm text-muted-foreground">Date of birth</dt>
                                <dd class="text-right text-sm font-semibold text-foreground">{{ $profile->DOB ?? 'Not provided' }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-4">
                                <dt class="text-sm text-muted-foreground">Gender</dt>
                                <dd class="text-right text-sm font-semibold text-foreground">{{ $profile->Gender ?? 'Not provided' }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 pt-4">
                                <dt class="text-sm text-muted-foreground">Email</dt>
                                <dd class="max-w-[65%] break-all text-right text-sm font-semibold text-foreground">{{ $profile->user->email }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
