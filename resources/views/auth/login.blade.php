<x-layout>
    <x-form title="Glad, To Have You Back" description="Start creating Ideas Today">
        <form action="/login" method="POST" class="mt-5 w-full max-w-md">
            @csrf
            <fieldset class="flex flex-col gap-y-3 fieldset bg-base-200 border-primary rounded-2xl w-100 border p-4">


                <x-form.feild name='email' label='E-mail' />
                <x-form.error name="email" class="text-error text-sm" />
                <x-form.feild name='password' label='Password' />
                <x-form.error name="password" class="text-error text-sm" />

                <div class="grid grid-cols-1 gap-4">
                    <button class="btn btn-neutral mt-4 text-lg font-semibold" type="submit">Login</button>
                </div>
            </fieldset>
        </form>
    </x-form>
</x-layout>
