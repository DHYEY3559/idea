<x-layout>
    <x-form title="Create your account" description="Start capturing and organizing your ideas today.">
        <form action="/register" method="POST" class="w-full">
            @csrf
            <fieldset class="border-border/80 bg-card/85 flex w-full flex-col gap-y-4 rounded-2xl border p-6 shadow-xl backdrop-blur-sm">
                <x-form.feild name='name' label='Name' placeholder="Your full name" />

                <x-form.feild name='email' label='E-mail' type="email" placeholder="you@example.com" />

                <x-form.feild name='password' label='Password' type="password" placeholder="••••••••" />

                <button class="btn mt-2 h-10 w-full text-sm font-semibold" type="submit">Create Account</button>

                <p class="text-muted-foreground pt-1 text-center text-xs">
                    Already have an account?
                    <a href="/login" class="text-primary font-medium hover:underline">Sign in</a>
                </p>
            </fieldset>
        </form>
    </x-form>
</x-layout>
