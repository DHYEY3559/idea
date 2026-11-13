<nav class="border-b border-border bg-card">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/">
                <img src="/images/logo.png" alt="Logo" class="h-8 w-auto inline-block mr-2">
            </a>
        </div>
        @auth()
            <div class="flex gap-x-4 items-center">
                <!--<a href="/profile" class="btn"> Profile </a>-->
                <img
                    src="{{ Auth::user()->profile?->profile_image ? asset('storage/'.Auth::user()->profile->profile_image) : asset('images/logo.png') }}"
                    alt="{{ Auth::user()->name }}'s profile image"
                    class="h-8 w-8 rounded-full object-cover">
                <a href="/logout" class="btn"> Logout </a>
            </div>
        @endauth
        @guest()
            <div class="flex gap-x-4 items-center">
                <a href="/login"> Sign In </a>
                <a href="/register" class="btn"> Register </a>
            </div>
        @endguest
    </div>
</nav>
