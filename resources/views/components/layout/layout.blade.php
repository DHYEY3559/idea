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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-2xl font-bold py-4"></p>
        {{ $slot }}
    </main>
</body>

</html>
