<nav class="border-border/80 bg-background/80 sticky top-0 z-40 border-b backdrop-blur-xl">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            
            @auth()
            <div class="hidden items-center gap-1 sm:flex">
                    <a href="{{ route('ideas.index') }}"
                    class="{{ request()->routeIs('ideas.*') ? 'bg-white/8 text-foreground' : 'text-muted-foreground hover:text-foreground hover:bg-white/5' }} flex items-center gap-2 rounded-xl px-3 py-1.5 text-sm font-medium transition-colors">
                    <img src="/images/logo.png" alt="Logo" class="h-8 w-auto rounded-lg transition-transform duration-200 group-hover:scale-105">
                        Ideas
                    </a>
                </div>
            @endauth
        </div>

        @auth()
            <div class="flex items-center gap-3">
                <a href="/profile"
                    class="border-border/80 bg-card/70 hover:border-primary/40 hover:bg-card flex items-center gap-2.5 rounded-full border py-1 pr-3 pl-1 transition-all duration-200">
                    <img
                        src="{{ Auth::user()->profile?->profile_image ? asset('storage/'.Auth::user()->profile->profile_image) : asset('images/default.png') }}"
                        alt="{{ Auth::user()->name }}"
                        class="ring-primary/30 h-7 w-7 rounded-full object-cover ring-1">
                    <span class="hidden text-sm font-medium sm:inline">{{ Auth::user()->name }}</span>
                </a>
                <a href="{{ route('logout') }}" class="btn btn-outlined h-8.5 px-3 text-xs sm:text-sm">Logout</a>
            </div>
        @endauth

        @guest()
            <div class="flex items-center gap-3">
                <a href="/login" class="btn btn-ghost">Sign In</a>
                <a href="/register" class="btn">Register</a>
            </div>
        @endguest
    </div>
</nav>
