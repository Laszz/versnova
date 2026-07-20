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

    @php
        $notifPending = \App\Models\Transaction::where('status', 'waiting_confirmation')->count();
        $notifUnread = \App\Models\ChatMessage::where('receiver_id', Auth::id())->where('is_read', false)->count();
        $notifTotal = $notifPending + $notifUnread;
        $notifTransactions = \App\Models\Transaction::with('user', 'account')
            ->where('status', 'waiting_confirmation')
            ->latest()->take(5)->get();
        $notifChats = \App\Models\User::whereHas('sentMessages', function($q) {
            $q->where('receiver_id', Auth::id())->where('is_read', false);
        })->take(3)->get();
    @endphp
</head>
<body class="bg-[#0e0e0e] text-[#e5e2e1] antialiased selection:bg-[#ff5357]/30 selection:text-white">
    <div class="flex min-h-screen">
        @include('layouts.admin-nav')

        <main class="flex-1 lg:ml-64 min-h-screen relative overflow-x-hidden">
            <header class="sticky top-0 z-30 glass-topbar flex items-center justify-between px-4 md:px-6 lg:px-8 py-3.5 gap-3">
                <h1 class="text-sm font-semibold text-[#e5e2e1] truncate">@yield('title', 'Dashboard')</h1>

                <div class="flex items-center gap-2 md:gap-3 shrink-0">
                    <button id="sidebarToggle" class="lg:hidden p-1.5 text-[#b7b5b4] hover:text-[#ffb3af] transition-colors rounded-lg hover:bg-white/5" title="Toggle sidebar">
                        <span class="material-symbols-outlined text-[20px]">menu</span>
                    </button>

                    {{-- Notifications --}}
                    <div class="relative" x-data="{ notifOpen: false }" @click.outside="notifOpen = false">
                        <button @click="notifOpen = !notifOpen" class="p-1.5 text-[#b7b5b4] hover:text-[#ffb3af] transition-colors rounded-lg hover:bg-white/5 relative">
                            <span class="material-symbols-outlined text-[20px]">notifications</span>
                            @if ($notifTotal > 0)
                                <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-[#ff5357] text-white text-[9px] font-bold rounded-full flex items-center justify-center" style="box-shadow: 0 0 6px rgba(255,83,87,0.6);">{{ $notifTotal > 9 ? '9+' : $notifTotal }}</span>
                            @endif
                        </button>

                        <div x-show="notifOpen" x-cloak class="absolute right-0 mt-2 w-80 bg-[#1c1b1b] border border-white/5 rounded-xl shadow-2xl z-50" style="backdrop-filter: blur(20px);">
                            <div class="p-3 border-b border-white/5">
                                <p class="text-xs font-semibold text-[#e5e2e1]">Notifikasi</p>
                            </div>
                            <div class="max-h-80 overflow-y-auto custom-scrollbar">
                                @if ($notifTransactions->count())
                                    <div class="px-3 pt-3 pb-1">
                                        <p class="text-[10px] font-mono text-accent uppercase tracking-wider">Konfirmasi Pembayaran</p>
                                    </div>
                                    @foreach ($notifTransactions as $t)
                                    <a href="{{ route('admin.transactions.show', $t) }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-full bg-[#ff5357]/10 flex items-center justify-center text-accent">
                                            <span class="material-symbols-outlined text-sm">payments</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-[#e5e2e1] truncate">{{ $t->user->name }} - {{ $t->account->title }}</p>
                                            <p class="text-[10px] text-secondary font-mono">Rp{{ number_format($t->total_price, 0, ',', '.') }}</p>
                                        </div>
                                        <span class="material-symbols-outlined text-sm text-[#474746]">chevron_right</span>
                                    </a>
                                    @endforeach
                                @endif

                                @if ($notifChats->count())
                                    <div class="px-3 pt-3 pb-1 @if($notifTransactions->count()) border-t border-white/5 mt-2 @endif">
                                        <p class="text-[10px] font-mono text-accent uppercase tracking-wider">Pesan Baru</p>
                                    </div>
                                    @foreach ($notifChats as $u)
                                    <a href="{{ route('admin.chat.show', $u) }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-mono text-[#b7b5b4]">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-[#e5e2e1] truncate">{{ $u->name }}</p>
                                            <p class="text-[10px] text-secondary">Pesan baru dari user</p>
                                        </div>
                                        <span class="material-symbols-outlined text-sm text-[#474746]">chevron_right</span>
                                    </a>
                                    @endforeach
                                @endif

                                @if ($notifTotal === 0)
                                    <div class="text-center py-8 text-secondary text-xs">Tidak ada notifikasi</div>
                                @endif
                            </div>
                            @if ($notifPending > 0)
                            <a href="{{ route('admin.transactions.index') }}" class="block p-3 border-t border-white/5 text-center text-xs text-accent hover:underline">Lihat semua transaksi</a>
                            @endif
                        </div>
                    </div>

                    <span class="material-symbols-outlined text-[#b7b5b4] hover:text-[#ffb3af] transition-colors cursor-pointer text-[20px]">settings</span>
                </div>
            </header>

            <div class="p-4 md:p-6 lg:p-8 overflow-x-auto">
                @if (session('success'))
                    <div class="mb-6 px-4 py-3 bg-[#ff5357]/10 border border-[#ff5357]/20 rounded-lg text-[#ffb3af] text-sm">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
