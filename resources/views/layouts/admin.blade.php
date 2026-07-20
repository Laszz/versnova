<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Versnova') }} — Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=teko:400,500,600,700|sora:400,500,600,700|jetbrains-mono:400,500,700&display=swap" rel="stylesheet">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body x-data="theme" class="bg-surface-lowest text-gray-100 font-body antialiased min-h-screen">
    @include('layouts.admin-nav')

    <div class="admin-content">
        @yield('content')
    </div>
</body>
</html>
