<div class="flex min-h-[calc(100dvh-5rem)] items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <div class="border-primary/25 bg-primary/10 text-primary mx-auto mb-4 flex size-12 items-center justify-center rounded-2xl border">
                <img src="/images/logo.png" alt="Logo" class="h-7 w-7 rounded-md object-contain">
            </div>
            <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">{{ $title }}</h1>
            <p class="text-muted-foreground mt-1.5 text-sm sm:text-base">{{ $description }}</p>
        </div>
        {{ $slot }}
    </div>
</div>
