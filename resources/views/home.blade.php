@extends('layouts.app')

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden bg-gradient-to-br from-surface via-surface-lowest to-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h1 class="font-heading text-display-mobile md:text-display text-gray-100 leading-tight">
                    Jual & Sewa<br>
                    <span class="text-amber-500">Akun Game</span>
                </h1>
                <p class="text-gray-400 text-body-lg max-w-lg">
                    Platform terpercaya untuk jual beli dan sewa akun game. Aman, cepat, dan mudah dengan chat langsung ke admin.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('katalog') }}" class="btn-primary">Cari Akun</a>
                    <a href="{{ route('flashsale') }}" class="btn-ghost">Flashsale</a>
                </div>
            </div>

            <div class="hidden lg:flex items-center justify-center">
                <div class="relative w-80 h-80">
                    <div class="absolute inset-0 bg-amber-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute inset-8 bg-gradient-to-br from-amber-500/20 to-indigo-500/20 rounded-full blur-2xl"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="font-heading text-[120px] text-amber-500/10 select-none">V</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Game Categories --}}
@if ($games->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 md:-mt-12 relative z-10">
    <div class="flex gap-3 overflow-x-auto no-scrollbar pb-4">
        <a href="{{ route('katalog') }}" class="whitespace-nowrap px-4 py-2 rounded-pill bg-surface border border-amber-500/30 text-amber-500 font-caption text-sm hover:bg-amber-500/10 transition-colors">Semua Game</a>
        @foreach ($games as $g)
            <a href="{{ route('katalog.game', $g) }}" class="whitespace-nowrap px-4 py-2 rounded-pill bg-surface border border-outline text-gray-400 font-caption text-sm hover:border-amber-500/30 hover:text-amber-500 transition-colors">{{ $g->name }}</a>
        @endforeach
    </div>
</section>
@endif

{{-- Featured Accounts --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="font-heading text-heading text-gray-100">Akun Terbaru</h2>
            <p class="text-gray-500 text-sm mt-1">Akun game siap jual & sewa</p>
        </div>
        <a href="{{ route('katalog') }}" class="text-amber-500 hover:text-amber-400 text-sm font-caption">Lihat Semua</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($featured as $account)
            <x-account-card :account="$account" />
        @empty
            <p class="text-gray-500 col-span-full text-center py-12">Belum ada akun tersedia.</p>
        @endforelse
    </div>
</section>

{{-- How it Works --}}
<section class="bg-surface/50 border-y border-outline/30 py-section-mobile md:py-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-heading text-heading text-gray-100 text-center mb-12">Cara Kerja</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center space-y-3">
                <div class="w-14 h-14 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="font-heading text-xl text-gray-200">Cari Akun</h3>
                <p class="text-gray-500 text-sm">Telusuri katalog, filter per game, cari akun impianmu.</p>
            </div>

            <div class="text-center space-y-3">
                <div class="w-14 h-14 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-heading text-xl text-gray-200">Transaksi Aman</h3>
                <p class="text-gray-500 text-sm">Pembayaran via transfer, akun diamankan sampai konfirmasi.</p>
            </div>

            <div class="text-center space-y-3">
                <div class="w-14 h-14 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <h3 class="font-heading text-xl text-gray-200">Chat Admin</h3>
                <p class="text-gray-500 text-sm">Tanya langsung ke admin via chat real-time.</p>
            </div>
        </div>
    </div>
</section>
@endsection
