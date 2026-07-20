<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Versnova') }} — @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=teko:400,500,600,700|sora:400,500,600,700|jetbrains-mono:400,500,700&display=swap" rel="stylesheet">

    @vite(['resources/css/auth.css', 'resources/js/auth.js'])
</head>
<body class="bg-surface-lowest text-gray-100 font-body antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="/" class="font-heading text-display-mobile text-amber-500">Versnova</a>
        </div>

        <div class="bg-surface border border-outline rounded-card p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
