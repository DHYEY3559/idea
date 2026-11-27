<x-layout>
    <div class="mx-auto max-w-3xl py-4 sm:py-8">
        <div class="mb-6 flex items-center justify-between">
            <a href="/profile"
                class="text-muted-foreground hover:text-foreground group inline-flex items-center gap-2 text-sm font-semibold transition-colors">
                <span class="border-border/80 bg-card/80 group-hover:border-primary/40 flex size-8 items-center justify-center rounded-xl border transition-colors">
                    <x-icons.back_arrow />
                </span>
                Back to Profile
            </a>
            <h1 class="text-lg font-bold tracking-tight sm:text-xl">Edit Profile</h1>
        </div>

        <x-card is="div" class="p-6 sm:p-8">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="border-border/80 flex flex-col items-center gap-6 border-b pb-6 sm:flex-row sm:items-start">
                    <div class="relative size-28 shrink-0">
                        <img
                            src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('images/default.png') }}"
                            alt="{{ $profile->user->name }}'s profile photo"
                            class="border-card ring-primary/40 h-full w-full rounded-full border-4 object-cover ring-2"
                        >
                        <input type="file" name="profile_image" id="upload_profile" accept="image/*" class="sr-only">
                        <label
                            for="upload_profile"
                            class="bg-primary text-primary-foreground border-card absolute right-0 bottom-0 flex size-9 cursor-pointer items-center justify-center rounded-full border-2 shadow-lg transition-transform hover:scale-105"
                            title="Choose a profile photo"
                        >
                            <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 1-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        </label>
                    </div>

                    <div class="w-full space-y-1.5">
                        <label for="profile_description" class="label">Bio / Description</label>
                        <input
                            type="text"
                            id="profile_description"
                            name="profile_description"
                            class="input w-full"
                            placeholder="Tell others a little about yourself..."
                            value="{{ old('profile_description', $profile->profile_description) }}"
                        >
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label for="name" class="label">Name</label>
                        <input id="name" name="name" class="input w-full" value="{{ old('name', $profile->user->name) }}">
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="label">Email</label>
                        <input id="email" name="email" class="input w-full" value="{{ $profile->user->email ?? 'Not Provided' }}">
                    </div>

                    <div class="space-y-1.5">
                        <label for="DOB" class="label">Date of Birth</label>
                        <input id="DOB" type="date" name="DOB" class="input w-full" value="{{ old('DOB', $profile->DOB) }}">
                    </div>

                    <div class="space-y-1.5">
                        <label for="Gender" class="label">Gender</label>
                        <input id="Gender" name="Gender" class="input w-full" placeholder="e.g. Female, Male, Non-binary" value="{{ old('Gender', $profile->Gender) }}">
                    </div>
                </div>

                <div class="border-border/80 flex items-center justify-end gap-3 border-t pt-5">
                    <a href="/profile" class="btn btn-outlined">Cancel</a>
                    <button class="btn" type="submit">Save Changes</button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
