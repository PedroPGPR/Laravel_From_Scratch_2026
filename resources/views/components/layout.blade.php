@props([
    'title' => 'Laravel from scratch 2026',
])

<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navbar />

    <main class="max-w-3xl mx-auto mt-6">
        {{ $slot }}
    </main>
</body>

</html>
