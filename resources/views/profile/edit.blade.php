<x-layout>
    <div class="mt-5">
    <div class="">
        <!-- Profile Image -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="sm:w-[80%] w-[90%] mx-auto">
                <!--<img src="https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw3fHxwZW9wbGV8ZW58MHwwfHx8MTcxMTExMTM4N3ww&ixlib=rb-4.0.3&q=80&w=1080" alt="User Profile"
                class="rounded-md lg:w-48 lg:h-48 md:w-40 md:h-40 sm:w-32 sm:h-32 w-28 h-28 outline outline-offset-2 outline-blue-500" />
                -->
                <!-- Profile Image -->
                        <div
                            class="m-auto flex justify-center w-35.25 h-35.25 bg-blue-300/20 rounded-full bg-cover bg-center bg-no-repeat"
                            style="background-image: url('{{ $profile->profile_image ? asset('storage/'.$profile->profile_image) : 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw3fHxwZW9wbGV8ZW58MHwwfHx8MTcxMTExMTM4N3ww&ixlib=rb-4.0.3&q=80&w=1080' }}')">

                            <div class="bg-white/90 rounded-full w-6 h-6 text-center ml-28 mt-4">

                                <input type="file" name="profile_image" id="upload_profile" hidden>

                                <label for="upload_profile">
                                        <svg data-slot="icon" class="w-6 h-5 text-blue-700" fill="none"
                                            stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z">
                                            </path>
                                        </svg>
                                    </label>
                            </div>
                        </div>

                <!-- FullName -->
                <div class="flex m-auto max-w-3xl pl-6 font-semibold">
                    <input type="text"
                                    name="profile_description"
                                    class="mt-6 p-4 w-full  border-2 rounded-lg"
                                    placeholder="Description"
                                    value="{{ old('profile_description', $profile->profile_description) }}">
                </div>
        </div>

        <div
            class="flex mt-10 px-100 justify-items-start  ">
            <!-- Description -->


            <!-- Detail -->
            <div class="w-full m-auto py-6 flex flex-col justify-center gap-2">
                <div class="w-full flex sm:flex-row flex-col gap-2 justify-center">
                    <div class="w-full">
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
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
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Gender</dt>
                                <input name="Gender" class="text-lg font-semibold" value="{{ old('Gender', $profile->Gender) }}">
                            </div>
                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                                <input name="email" class="text-lg font-semibold" value="{{ $profile->user->email ?? 'Not Provided' }}"></input>
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
