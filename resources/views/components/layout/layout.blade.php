<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Idea</title>
</head>

<body class="bg-background text-foreground">
    <x-layout.navbar />
    <main class="mx-auto flex max-w-7xl items-center justify-center px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>
    @session('success')
        <div id="success-message" class="bg-primary text-primary-content fixed bottom-4 right-4 rounded-lg p-4 shadow-lg">
            {{ $value }}
        </div>
    @endsession
</body>

</html>
