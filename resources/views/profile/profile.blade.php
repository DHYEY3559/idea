<x-layout>
    <div class="mt-5">
    <div class="">
        <!-- Profile Image -->
        <div class="sm:w-[80%] w-[90%] max-w-3xl mx-auto flex">
            <img src="{{ $profile->profile_image ? asset('storage/'.$profile->profile_image) : 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw3fHxwZW9wbGV8ZW58MHwwfHx8MTcxMTExMTM4N3ww&ixlib=rb-4.0.3&q=80&w=1080' }}" alt="{{ $profile->user->name }}'s profile photo"
                    class="rounded-md lg:w-48 lg:h-48 md:w-40 md:h-40 sm:w-32 sm:h-32 w-28 h-28 outline outline-offset-2 outline-blue-500" />

            <!-- FullName -->
            <div class="pl-6 font-semibold">
                <h1
                    class="h-auto w-full text-left text-gray-800 dark:text-white lg:text-4xl md:text-3xl sm:text-3xl text-xl">
                    {{ $profile->user->name }}
                </h1>
                <p class=" text-gray-700 dark:text-gray-400 text-md mt-12">
                        {{ $profile->profile_description }}
                </p>
            </div>

        </div>

        <div
            class="flex mt-10 px-100 justify-items-start  ">
            <!-- Description -->


            <!-- Detail -->
            <div class="w-full my-auto py-6 flex flex-col justify-center gap-2">
                <div class="w-full flex sm:flex-row flex-col gap-2 justify-center">
                    <div class="w-full">
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
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
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
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
</div>
</x-layout>
