<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Versnova') }} — @yield('title', 'Admin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Space+Mono:wght@400;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <style>
        body {
            font-family: 'Geist', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        @view-transition { navigation: auto; }
        ::view-transition-old(root),
        ::view-transition-new(root) {
            animation-duration: 0.3s;
            animation-timing-function: ease;
        }
    </style>
</head>
<body class="bg-[#0e0e0e] text-[#e5e2e1] antialiased selection:bg-[#ff5357]/30 selection:text-white">
    <div class="flex min-h-screen">
        @include('layouts.admin-nav')

        <main class="flex-1 lg:ml-64 min-h-screen relative">
            <header class="sticky top-0 z-30 glass-topbar flex items-center justify-between px-8 py-3.5">
                <div class="flex items-center gap-6 w-1/2">
                    <h1 class="text-sm font-semibold text-[#e5e2e1]">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <button id="sidebarToggle" class="lg:hidden p-2 text-[#b7b5b4] hover:text-[#ffb3af] transition-colors" title="Toggle sidebar">
                        <span class="material-symbols-outlined text-[20px]">menu</span>
                    </button>
                    <span class="material-symbols-outlined text-[#b7b5b4] hover:text-[#ffb3af] transition-colors cursor-pointer text-[22px]">notifications</span>
                    <span class="material-symbols-outlined text-[#b7b5b4] hover:text-[#ffb3af] transition-colors cursor-pointer text-[22px]">settings</span>
                </div>
            </header>

            <div class="p-8">
                @if (session('success'))
                    <div class="mb-6 px-4 py-3 bg-[#ff5357]/10 border border-[#ff5357]/20 rounded-lg text-[#ffb3af] text-sm">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
