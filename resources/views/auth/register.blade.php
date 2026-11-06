<x-layout>
    <x-form title="Register Your Account" description="Start creating Ideas Today">
        <form action="/register" method="POST" class="mt-5 w-full max-w-md">
            @csrf
            <fieldset class="flex flex-col gap-y-3 fieldset bg-base-200 border-primary rounded-2xl w-100 border p-4">

                <x-form.feild name='name' label='Name' />

                <x-form.feild name='email' label='E-mail' />

                <x-form.feild name='password' label='Password' />

                <div class="grid grid-cols-1 gap-4">
                    <button class="btn btn-neutral mt-4 text-lg font-semibold">Create Account</button>
                </div>
            </fieldset>
        </form>
    </x-form>
</x-layout>
