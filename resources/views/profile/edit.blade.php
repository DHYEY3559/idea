<x-layout>
    <div class="mt-5">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mx-auto flex w-[90%] max-w-3xl items-start gap-6 sm:w-[80%]">
                <div class="relative h-40 w-40 shrink-0">
                    <img
                        src="{{ $profile->profile_image ? asset('storage/'.$profile->profile_image) : asset('images/logo.png') }}"
                        alt="{{ $profile->user->name }}'s profile photo"
                        class="h-full w-full rounded-full object-cover outline outline-2 outline-offset-2 outline-primary"
                    >
                    <input type="file" name="profile_image" id="upload_profile" accept="image/*" class="sr-only">
                    <label
                        for="upload_profile"
                        class="absolute bottom-1 right-1 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-white text-primary shadow-md"
                        title="Choose a profile photo"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 1-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                    </label>
                </div>

                <div class="flex w-full max-w-3xl font-semibold">
                    <input
                        type="text"
                        name="profile_description"
                        class="mt-6 w-full rounded-lg border-2 p-4"
                        placeholder="Description"
                        value="{{ old('profile_description', $profile->profile_description) }}"
                    >
                </div>
            </div>

            <div class="mt-10 flex px-100">
                <div class="m-auto flex w-full flex-col justify-center gap-2 py-6">
                    <div class="flex w-full flex-col justify-center gap-2 sm:flex-row">
                        <div class="w-full">
                            <dl class="divide-y divide-gray-200 text-gray-900 dark:divide-gray-700 dark:text-white">
                                <div class="flex flex-col pb-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Name</dt>
                                    <input name="name" class="text-lg font-semibold" value="{{ old('name', $profile->user->name) }}">
                                </div>
                                <div class="flex flex-col py-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Date of Birth</dt>
                                    <input type="date" name="DOB" class="text-lg font-semibold" value="{{ old('DOB', $profile->DOB) }}">
                                </div>
                            </dl>
                        </div>
                        <div class="w-full">
                            <dl class="divide-y divide-gray-200 text-gray-900 dark:divide-gray-700 dark:text-white">
                                <div class="flex flex-col py-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Gender</dt>
                                    <input name="Gender" class="text-lg font-semibold" value="{{ old('Gender', $profile->Gender) }}">
                                </div>
                                <div class="flex flex-col pt-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                                    <input name="email" class="text-lg font-semibold" value="{{ $profile->user->email ?? 'Not Provided' }}">
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-100">
                <button class="btn btn-primary sm:w-auto lg:h-12" type="submit">Update</button>
            </div>
        </form>
    </div>
</x-layout>
