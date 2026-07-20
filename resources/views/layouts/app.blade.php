<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Versnova') }} — @yield('title', 'Jual & Sewa Akun Game')</title>
    <meta name="description" content="@yield('description', 'Platform jual beli dan sewa akun game terpercaya. Aman, cepat, dan mudah.')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=teko:400,500,600,700|sora:400,500,600,700|jetbrains-mono:400,500,700&display=swap" rel="stylesheet">

    @stack('seo')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="theme" class="bg-surface-lowest text-gray-100 font-body antialiased min-h-screen">
    <div class="flex flex-col min-h-screen">
        @include('layouts.navigation')

        <main class="flex-1">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>
