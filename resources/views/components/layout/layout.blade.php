<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://cdn.jsdelivr.net/npm/lucide@1.80.0/dist/umd/lucide.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Idea</title>
</head>

<body class="bg-background text-foreground selection:bg-primary/25 selection:text-primary relative min-h-screen">
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
        <div class="bg-primary/10 absolute -top-40 left-1/2 h-112 w-4xl -translate-x-1/2 rounded-full blur-3xl"></div>
    </div>

    <x-layout.navbar />

    <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    @session('success')
        <div id="success-message"
            class="border-primary/30 bg-card/95 text-foreground fixed right-5 bottom-5 z-50 flex items-center gap-3 rounded-2xl border px-4 py-3 text-sm font-medium shadow-2xl backdrop-blur-xl">
            <span class="bg-primary/15 text-primary flex size-7 shrink-0 items-center justify-center rounded-full">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </span>
            <span>{{ $value }}</span>
        </div>
    @endsession

    @session('error')
        <div id="success-message"
            class="fixed right-5 bottom-5 z-50 flex items-center gap-3 rounded-2xl border border-red-500/30 bg-red-950/90 px-4 py-3 text-sm font-medium text-red-100 shadow-2xl backdrop-blur-xl">
            <span class="flex size-7 shrink-0 items-center justify-center rounded-full bg-red-500/20 text-red-400">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            <span>{{ $value }}</span>
        </div>
    @endsession
</body>

</html>
