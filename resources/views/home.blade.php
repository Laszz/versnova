@extends('layouts.app')

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#ff5357]/5 via-[var(--bg)] to-[var(--bg)]"></div>
    <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-[#ff5357]/5 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#ff5357]/3 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[var(--accent-soft)] border border-accent text-xs font-mono text-accent uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#ffb3af]"></span>
                    Platform Terpercaya
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-primary leading-tight">
                    Jual & Sewa<br>
                    <span style="color: #ffb3af;">Akun Game</span>
                </h1>

                <p class="text-base md:text-lg text-secondary max-w-lg leading-relaxed">
                    Platform terpercaya untuk jual beli dan sewa akun game. Aman, cepat, dan mudah dengan chat langsung ke admin.
                </p>

                <div class="flex gap-4 pt-2">
                    <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        Cari Akun
                    </a>
                    <a href="{{ route('flashsale') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-default text-secondary rounded-lg font-medium hover:border-accent hover:text-accent transition-all">
                        <span class="material-symbols-outlined text-[18px]">local_fire_department</span>
                        Flashsale
                    </a>
                </div>

                <div class="flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-accent">verified</span>
                        <span class="text-xs text-secondary">Verifikasi Cepat</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-accent">security</span>
                        <span class="text-xs text-secondary">Transaksi Aman</span>
                    </div>
                </div>
            </div>

            {{-- Visual --}}
            <div class="hidden lg:flex items-center justify-center">
                <div class="relative w-80 h-80">
                    <div class="absolute inset-0 bg-[var(--accent-soft)] rounded-full blur-3xl"></div>
                    <div class="absolute inset-12 bg-gradient-to-br from-[#ff5357]/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-40 h-40 rounded-2xl bg-card border border-subtle flex items-center justify-center">
                            <span style="font-family: 'Space Mono', monospace; font-size: 72px; font-weight: 700; color: #ff5357;">V</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Game Categories --}}
@if ($games->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
    <div class="flex gap-3 overflow-x-auto no-scrollbar pb-4">
        <a href="{{ route('katalog') }}" class="whitespace-nowrap px-5 py-2.5 rounded-lg bg-accent text-white text-sm font-medium">Semua Game</a>
        @foreach ($games as $g)
            <a href="{{ route('katalog.game', $g) }}" class="whitespace-nowrap px-5 py-2.5 rounded-lg border border-default text-sm text-secondary hover:border-accent hover:text-accent">{{ $g->name }}</a>
        @endforeach
    </div>
</section>
@endif



{{-- Featured Accounts --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-lg font-bold text-primary">Akun Terbaru</h2>
            <p class="text-sm text-secondary mt-1">Akun game siap jual & sewa</p>
        </div>
        <a href="{{ route('katalog') }}" class="text-sm text-accent hover:underline font-mono uppercase tracking-wider">Lihat Semua</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($featured as $account)
            <x-account-card :account="$account" />
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-secondary">Belum ada akun tersedia.</p>
            </div>
        @endforelse
    </div>
</section>

{{-- Recent Sold --}}
@if ($recentSold->count())
<section class="border-t border-subtle py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-lg font-bold text-primary">Terbaru Terjual</h2>
                <p class="text-sm text-secondary mt-1">Akun yang sudah laku & dipercaya pembeli</p>
            </div>
        </div>

        <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2">
            @foreach ($recentSold as $s)
            <div class="shrink-0 w-64 bg-card border border-subtle rounded-xl overflow-hidden opacity-60 hover:opacity-90 transition-opacity">
                <div class="relative aspect-[4/3] bg-elevated flex items-center justify-center">
                    @if ($s->primaryImage)
                        <img src="{{ Storage::url($s->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-3xl text-secondary/40">inventory_2</span>
                    @endif
                    <div class="absolute inset-0 bg-[#0e0e0e]/60 flex items-center justify-center">
                        <div class="text-center">
                            <span class="text-xs font-mono uppercase tracking-wider text-secondary/80 block">{{ $s->status === 'sold' ? 'Terjual' : 'Tersewa' }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-sm font-medium text-primary truncate">{{ $s->title }}</p>
                    <p class="text-xs text-secondary font-mono">{{ $s->game->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if ($reviews->count())
<section class="border-t border-subtle py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <div class="text-center">
            <h2 class="text-lg font-bold text-primary">Kata Mereka</h2>
            <p class="text-sm text-secondary mt-1">Review dari pembeli & penyewa</p>
        </div>
    </div>
    <div class="relative">
        <div class="flex gap-6 animate-scroll" style="width: max-content;">
            {{-- Duplicate for seamless loop --}}
            @foreach ($reviews as $r)
            <div class="w-72 shrink-0 bg-card border border-subtle rounded-xl p-5">
                <div class="flex items-center gap-1 mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined text-sm {{ $i <= $r->rating ? 'text-accent' : 'text-secondary/30' }}" style="font-variation-settings: 'FILL' 1">star</span>
                    @endfor
                </div>
                @if ($r->comment)
                    <p class="text-sm text-secondary leading-relaxed italic">"{{ $r->comment }}"</p>
                @endif
                <p class="text-xs font-mono text-accent mt-3">{{ $r->user->name }}</p>
                <p class="text-[10px] text-secondary/60 font-mono">{{ $r->transaction->account->game->name }} &middot; {{ $r->transaction->type === 'buy' ? 'Beli' : 'Sewa' }}</p>
            </div>
            @endforeach
            @foreach ($reviews as $r)
            <div class="w-72 shrink-0 bg-card border border-subtle rounded-xl p-5">
                <div class="flex items-center gap-1 mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined text-sm {{ $i <= $r->rating ? 'text-accent' : 'text-secondary/30' }}" style="font-variation-settings: 'FILL' 1">star</span>
                    @endfor
                </div>
                @if ($r->comment)
                    <p class="text-sm text-secondary leading-relaxed italic">"{{ $r->comment }}"</p>
                @endif
                <p class="text-xs font-mono text-accent mt-3">{{ $r->user->name }}</p>
                <p class="text-[10px] text-secondary/60 font-mono">{{ $r->transaction->account->game->name }} &middot; {{ $r->transaction->type === 'buy' ? 'Beli' : 'Sewa' }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- How it Works --}}
<section class="border-t border-subtle py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-lg font-bold text-primary">Cara Kerja</h2>
            <p class="text-sm text-secondary mt-1">Mulai dalam 3 langkah mudah</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-card border border-subtle rounded-xl p-6 text-center hover:border-accent transition-all">
                <div class="w-12 h-12 rounded-xl bg-[var(--accent-soft)] flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-accent text-[24px]">search</span>
                </div>
                <h3 class="text-base font-semibold text-primary mb-2">Cari Akun</h3>
                <p class="text-sm text-secondary leading-relaxed">Telusuri katalog, filter per game, cari akun impianmu.</p>
            </div>

            <div class="bg-card border border-subtle rounded-xl p-6 text-center hover:border-accent transition-all">
                <div class="w-12 h-12 rounded-xl bg-[var(--accent-soft)] flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-accent text-[24px]">verified</span>
                </div>
                <h3 class="text-base font-semibold text-primary mb-2">Transaksi Aman</h3>
                <p class="text-sm text-secondary leading-relaxed">Pembayaran via transfer, akun diamankan sampai konfirmasi.</p>
            </div>

            <div class="bg-card border border-subtle rounded-xl p-6 text-center hover:border-accent transition-all">
                <div class="w-12 h-12 rounded-xl bg-[var(--accent-soft)] flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-accent text-[24px]">chat</span>
                </div>
                <h3 class="text-base font-semibold text-primary mb-2">Chat Admin</h3>
                <p class="text-sm text-secondary leading-relaxed">Tanya langsung ke admin via chat real-time.</p>
            </div>
        </div>
    </div>
</section>
@endsection






