<x-layout>
    <div class="flex min-h-[calc(100dvh-4rem)] items-center justify-center px-4">
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-2xl w-100 border p-4">
            <legend class="fieldset-legend">Register</legend>
            <label class="label mb-1">Name</label>
            <input type="text" class="input rounded-2xl focus:ring-2 focus:ring-primary" placeholder="Name" />

            <label class="label mt-4 mb-1">Email</label>
            <input type="email" class="input rounded-2xl focus:ring-2 focus:ring-primary" placeholder="Email" />

            <label class="label mt-4 mb-1">Password</label>
            <input type="password" class="input rounded-2xl focus:ring-2 focus:ring-primary" placeholder="Password" />
            <div class="grid grid-cols-1 gap-4">
                <button class="btn btn-neutral mt-4 text-lg font-semibold">Create Account</button>
            </div>
        </fieldset>
    </div>
</x-layout>
