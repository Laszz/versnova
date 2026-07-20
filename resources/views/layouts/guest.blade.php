<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>!function(){var s=localStorage.getItem('versnova-theme');if(s==='dark'||(!s&&window.matchMedia('(prefers-color-scheme:dark)').matches)){document.documentElement.classList.add('dark')}}()</script>

    <title>{{ config('app.name', 'Versnova') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=teko:400,500,600,700|sora:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/auth.css', 'resources/js/auth.js'])
</head>
<body class="bg-surface-lowest text-gray-100 font-body antialiased min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <a href="/" class="block text-center mb-8">
            <span class="font-heading text-display-mobile text-amber-500">Versnova</span>
        </a>

        <div class="card-surface rounded-card p-6">
            {{ $slot }}
        </div>
    </div>
</body>
</html>

