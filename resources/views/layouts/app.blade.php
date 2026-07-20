<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>!function(){var s=localStorage.getItem('versnova-theme');if(s==='dark'||(!s&&window.matchMedia('(prefers-color-scheme:dark)').matches)){document.documentElement.classList.add('dark')}}()</script>

    <title>{{ config('app.name', 'Versnova') }} — @yield('title', 'Jual & Sewa Akun Game')</title>
    <meta name="description" content="@yield('description', 'Platform jual beli dan sewa akun game terpercaya. Aman, cepat, dan mudah.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Space+Mono:wght@400;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0..1&display=swap" rel="stylesheet">

    @stack('seo')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-primary antialiased selection:bg-[#ff5357]/30 selection:text-white min-h-screen">
    <div class="flex flex-col min-h-screen">
        @include('layouts.navigation')

        <main class="flex-1">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>
