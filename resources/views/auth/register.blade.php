<x-layout>
    <div class="flex min-h-[calc(100dvh-4rem)] items-center justify-center px-4">
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-2xl w-xs border p-4">
            <legend class="fieldset-legend">Register</legend>
            <label class="label">Name</label>
            <input type="text" class="input" placeholder="Name" />

            <label class="label mt-4">Email</label>
            <input type="email" class="input" placeholder="Email" />

            <label class="label mt-4">Password</label>
            <input type="password" class="input" placeholder="Password" />

            <button class="btn btn-neutral mt-4">Register</button>
        </fieldset>
    </div>
</x-layout>
