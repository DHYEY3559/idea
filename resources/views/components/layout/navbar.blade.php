<nav class="border-border bg-card border-b">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between">
        <div>
            <a href="/">
                <img src="/images/logo.png" alt="Logo" class="mr-2 inline-block h-8 w-auto">
            </a>
        </div>
        @auth()
            <div class="flex items-center gap-x-4">
                <a href="/profile">
                    <img
                        src="{{ Auth::user()->profile?->profile_image ? asset('storage/'.Auth::user()->profile->profile_image) : asset('images/logo.png') }}"
                        class="h-8 w-8 rounded-full object-cover">
                </a>
                <a href="{{ route('logout') }}" class="btn"> Logout </a>
            </div>
        @endauth
        @guest()
            <div class="flex items-center gap-x-4">
                <a href="/login"> Sign In </a>
                <a href="/register" class="btn"> Register </a>
            </div>
        @endguest
    </div>
</nav>
