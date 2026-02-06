<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="bali">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! seo() !!}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col font-sans">
    <x-header />

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
