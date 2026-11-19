<x-layout>
    <div class="mt-5">
        <div class="">
            <div class="flex items-center justify-end px-40">
                <a class="btn btn-primary" href="{{ route('ideas.index') }}" type="button">Back</a>
            </div>
            <!-- Profile Image -->
            <div class="mx-auto flex w-[90%] max-w-3xl sm:w-[80%]">
                <div class="relative h-40 w-40 shrink-0">
                    <img src="{{ $profile->profile_image ? asset('storage/'.$profile->profile_image) : 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw3fHxwZW9wbGV8ZW58MHwwfHx8MTcxMTExMTM4N3ww&ixlib=rb-4.0.3&q=80&w=1080' }}" alt="{{ $profile->user->name }}'s profile photo"
                        class="outline-primary h-full w-full rounded-full object-cover outline outline-offset-2" />
                </div>
                <!-- FullName -->
                <div class="pl-6 font-semibold">
                    <h1
                        class="h-auto w-full text-left text-xl text-gray-800 sm:text-3xl md:text-3xl lg:text-4xl dark:text-white">
                        {{ $profile->user->name }}
                    </h1>
                    <p class="text-md mt-12 text-gray-700 dark:text-gray-400">
                        {{ $profile->profile_description }}
                    </p>
                </div>
            </div>

            <div
                class="mt-10 justify-items-start px-40">
                <!-- Detail -->
                <div class="my-auto flex w-full flex-col justify-center gap-2 py-6">
                    <div class="flex w-full flex-col justify-center gap-2 sm:flex-row">
                        <div class="w-full">
                            <dl class="divide-y divide-gray-200 text-gray-900 dark:divide-gray-700 dark:text-white">
                                <div class="flex flex-col pb-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Name</dt>
                                    <dd class="text-lg font-semibold">{{ $profile->user->name }}</dd>
                                </div>
                                <div class="flex flex-col py-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Date Of Birth</dt>
                                    <dd class="text-lg font-semibold">{{ $profile->DOB ?? 'Not Provided' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="w-full">
                            <dl class="divide-y divide-gray-200 text-gray-900 dark:divide-gray-700 dark:text-white">
                                <div class="flex flex-col py-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Gender</dt>
                                    <dd class="text-lg font-semibold">{{ $profile->Gender ?? 'Not Provided' }}</dd>
                                </div>
                                <div class="flex flex-col pt-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                                    <dd class="text-lg font-semibold">{{ $profile->user->email ?? 'Not Provided' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <a class="btn btn-primary" href="/profile/edit" type="button">Edit Profile</a>
            </div>
        </div>
    </div>
</x-layout>
