@extends('layouts.app')

@section('title', $account->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <div class="flex items-center gap-2 text-sm text-secondary mb-8 font-mono">
        <a href="{{ route('beli.index') }}" class="hover:text-accent transition-colors">Beli</a>
        <span>/</span>
        <span class="text-primary truncate max-w-[200px]">{{ $account->title }}</span>
    </div>

    <div class="lg:grid lg:grid-cols-12 lg:gap-8 lg:items-start">
        <div class="lg:col-span-7 space-y-4">
            @php $images = $account->images->filter(fn($i) => $i->image_path); @endphp
            <div x-data="{ active: 0 }" class="space-y-3">
                <div class="aspect-video rounded-xl overflow-hidden bg-card border border-subtle relative">
                    @if ($images->count())
                        <template x-for="(img, i) in @js($images->values())" :key="i">
                            <img x-show="active === i" :src="'/storage/' + img.image_path" alt="{{ $account->title }}" class="w-full h-full object-cover absolute inset-0">
                        </template>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-secondary/30">image</span>
                        </div>
                    @endif
                </div>

                @if ($images->count() > 1)
                <div class="flex gap-2 overflow-x-auto no-scrollbar">
                    <template x-for="(img, i) in @js($images->values())" :key="i">
                        <button @click="active = i" :class="active === i ? 'border-accent' : 'border-subtle'" class="w-20 h-14 shrink-0 rounded-lg overflow-hidden border-2 transition-colors">
                            <img :src="'/storage/' + img.image_path" alt="" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
                @endif
            </div>

            @if ($account->description)
            <div class="bg-card border border-subtle rounded-xl p-6">
                <h2 class="text-sm font-semibold text-primary mb-2">Deskripsi</h2>
                <p class="text-sm text-secondary leading-relaxed">{{ $account->description }}</p>
            </div>
            @endif

            <div class="bg-card border border-subtle rounded-xl p-6">
                <h2 class="text-sm font-semibold text-primary mb-4">Spesifikasi</h2>
                <div class="flex flex-wrap gap-2">
                    @if ($account->platform)
                    <div class="px-3 py-2 rounded-lg bg-card border border-subtle text-sm">
                        <p class="text-[10px] text-secondary font-mono uppercase tracking-wider">Platform</p>
                        <p class="text-primary font-medium mt-0.5">{{ $account->platform }}</p>
                    </div>
                    @endif
                    @if ($account->server)
                    <div class="px-3 py-2 rounded-lg bg-card border border-subtle text-sm">
                        <p class="text-[10px] text-secondary font-mono uppercase tracking-wider">Server</p>
                        <p class="text-primary font-medium mt-0.5">{{ $account->server }}</p>
                    </div>
                    @endif
                    @if ($account->level)
                    <div class="px-3 py-2 rounded-lg bg-card border border-subtle text-sm">
                        <p class="text-[10px] text-secondary font-mono uppercase tracking-wider">Level</p>
                        <p class="text-primary font-medium mt-0.5">{{ $account->level }}</p>
                    </div>
                    @endif
                    @if ($account->bind_status)
                    <div class="px-3 py-2 rounded-lg bg-card border border-subtle text-sm">
                        <p class="text-[10px] text-secondary font-mono uppercase tracking-wider">Bind</p>
                        <p class="text-primary font-medium mt-0.5">{{ $account->bind_status }}</p>
                    </div>
                    @endif
                    @if ($account->login_method)
                    <div class="px-3 py-2 rounded-lg bg-card border border-subtle text-sm">
                        <p class="text-[10px] text-secondary font-mono uppercase tracking-wider">Login</p>
                        <p class="text-primary font-medium mt-0.5">{{ $account->login_method }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if ($account->skin_info)
            <div class="bg-card border border-subtle rounded-xl p-6">
                <h2 class="text-sm font-semibold text-primary mb-2">Skin & Items</h2>
                <div class="flex flex-wrap gap-1.5">
                    @foreach (explode(',', $account->skin_info) as $item)
                        <span class="px-2.5 py-1 rounded-md bg-card border border-subtle text-xs text-secondary">{{ trim($item) }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="lg:col-span-5 lg:col-start-9">
            <div class="bg-card border border-accent/30 rounded-xl p-6 lg:sticky lg:top-24 space-y-6">
                <div class="pb-4 border-b border-subtle">
                    <h1 class="text-lg font-bold text-primary leading-tight">{{ $account->title }}</h1>
                    <p class="text-xs text-secondary mt-1 font-mono">{{ $account->game->name }}</p>
                </div>

                <div class="space-y-1">
                    @if ($account->discount_price)
                        <div class="flex items-baseline gap-2">
                            <p class="text-3xl font-bold text-accent">Rp{{ number_format($account->discount_price, 0, ',', '.') }}</p>
                            <span class="text-sm text-secondary line-through">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</span>
                            @if ($account->discount_percent)
                                <span class="px-2 py-0.5 rounded text-xs font-mono bg-accent text-white">-{{ $account->discount_percent }}%</span>
                            @endif
                        </div>
                    @elseif ($account->price_sell)
                        <p class="text-3xl font-bold text-accent">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</p>
                    @endif
                </div>

                <div class="flex items-center gap-2 py-3 px-4 rounded-lg bg-card border border-subtle">
                    <span class="w-2 h-2 rounded-full @if($account->status === 'available') bg-[#10b981] @else bg-secondary/40 @endif"></span>
                    <span class="text-sm text-secondary font-mono">
                        @if($account->status === 'available') Tersedia
                        @elseif($account->status === 'reserved') Dipesan
                        @elseif($account->status === 'sold') Terjual
                        @else Disewa @endif
                    </span>
                </div>

                <div class="flex items-center gap-3 py-3 px-4 rounded-lg bg-card border border-subtle">
                    <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-accent text-lg">verified</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-primary">Penjual Terpercaya</p>
                        <p class="text-xs text-secondary font-mono">Admin Versnova</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @if ($account->status === 'available')
                        <a href="{{ route('transactions.beli', $account) }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 15px rgba(255,83,87,0.25);">
                            <span class="material-symbols-outlined text-lg">shopping_bag</span>
                            Beli Sekarang
                        </a>
                    @endif
                    @auth
                        @php $wished = Auth::user()->wishlists()->where('account_id', $account->id)->exists() @endphp
                        <form method="POST" action="{{ route('wishlist.toggle', $account) }}">
                            @csrf
                            <button type="submit" class="flex items-center justify-center gap-2 w-full px-5 py-3 border border-subtle text-secondary rounded-lg text-sm font-medium hover:border-accent hover:text-accent transition-all">
                                <span class="material-symbols-outlined text-lg" @if($wished) style="font-variation-settings:'FILL'1" @endif>favorite</span>
                                @if ($wished) Di Wishlist @else Tambah ke Wishlist @endif
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 border border-subtle text-secondary rounded-lg text-sm font-medium hover:border-accent hover:text-accent transition-all">
                            <span class="material-symbols-outlined text-lg">favorite</span>
                            Login untuk Wishlist
                        </a>
                    @endauth
                </div>

                <div class="pt-4 border-t border-subtle space-y-2">
                    <div class="flex items-center gap-2 text-xs text-secondary">
                        <span class="material-symbols-outlined text-sm text-accent">verified</span>
                        Pembayaran aman via transfer bank
                    </div>
                    <div class="flex items-center gap-2 text-xs text-secondary">
                        <span class="material-symbols-outlined text-sm text-accent">chat</span>
                        Chat admin untuk bantuan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
