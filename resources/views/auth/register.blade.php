<x-layout>
    <x-form title="Register Your Account" description="Start creating Ideas Today">
        <form action="/register" method="POST" class="mt-5 w-full max-w-md">
            @csrf
            <fieldset class="fieldset bg-base-200 border-primary flex w-100 flex-col gap-y-3 rounded-2xl border p-4">

                <x-form.feild name='name' label='Name' />

                <x-form.feild name='email' label='E-mail' type="email" />

                <x-form.feild name='password' label='Password' type="password" />

                <div class="grid grid-cols-1 gap-4">
                    <button class="btn btn-neutral mt-4 text-lg font-semibold">Create Account</button>
                </div>
            </fieldset>
        </form>
    </x-form>
</x-layout>
