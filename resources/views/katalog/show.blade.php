@extends('layouts.app')

@section('title', $account->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-secondary mb-6 font-mono">
        <a href="{{ route('katalog') }}" class="hover:text-accent transition-colors">Katalog</a>
        <span>/</span>
        <a href="{{ route('katalog.game', $account->game) }}" class="hover:text-accent transition-colors">{{ $account->game->name }}</a>
        <span>/</span>
        <span class="text-primary">{{ Str::limit($account->title, 30) }}</span>
    </div>

    <div class="grid lg:grid-cols-12 gap-8">
        {{-- Gallery --}}
        <div class="lg:col-span-7 space-y-4">
            <div class="aspect-video rounded-xl overflow-hidden bg-card border border-subtle">
                @if ($account->primaryImage)
                    <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="{{ $account->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-secondary">image</span>
                    </div>
                @endif
            </div>

            @if ($account->images->count() > 1)
            <div class="flex gap-2 overflow-x-auto no-scrollbar">
                @foreach ($account->images as $img)
                    <div class="w-20 h-14 shrink-0 rounded-lg overflow-hidden border @if($img->is_primary) border-accent @else border-subtle @endif">
                        <img src="{{ Storage::url($img->image_path) }}" alt="" class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>
            @endif

            {{-- Specs --}}
            <div class="bg-card border border-subtle rounded-xl p-6">
                <h2 class="text-sm font-semibold text-primary mb-4">Spesifikasi</h2>
                <div class="grid grid-cols-2 gap-5 text-sm">
                    @if ($account->platform)
                    <div>
                        <p class="text-xs text-secondary font-mono uppercase">Platform</p>
                        <p class="text-primary mt-0.5">{{ $account->platform }}</p>
                    </div>
                    @endif
                    @if ($account->server)
                    <div>
                        <p class="text-xs text-secondary font-mono uppercase">Server</p>
                        <p class="text-primary mt-0.5">{{ $account->server }}</p>
                    </div>
                    @endif
                    @if ($account->level)
                    <div>
                        <p class="text-xs text-secondary font-mono uppercase">Level</p>
                        <p class="text-primary mt-0.5">{{ $account->level }}</p>
                    </div>
                    @endif
                    @if ($account->bind_status)
                    <div>
                        <p class="text-xs text-secondary font-mono uppercase">Bind</p>
                        <p class="text-primary mt-0.5">{{ $account->bind_status }}</p>
                    </div>
                    @endif
                    @if ($account->login_method)
                    <div>
                        <p class="text-xs text-secondary font-mono uppercase">Login</p>
                        <p class="text-primary mt-0.5">{{ $account->login_method }}</p>
                    </div>
                    @endif
                </div>

                @if ($account->description)
                <div class="mt-5 pt-5 border-t border-subtle">
                    <p class="text-xs text-secondary font-mono uppercase mb-2">Deskripsi</p>
                    <p class="text-sm text-secondary leading-relaxed">{{ $account->description }}</p>
                </div>
                @endif

                @if ($account->skin_info)
                <div class="mt-5 pt-5 border-t border-subtle">
                    <p class="text-xs text-secondary font-mono uppercase mb-2">Skin & Items</p>
                    <p class="text-sm text-secondary leading-relaxed">{{ $account->skin_info }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Purchase Widget --}}
        <div class="lg:col-span-5">
            <div class="bg-card border border-accent rounded-xl p-6 sticky top-24 space-y-6">
                <div>
                    <h1 class="text-xl font-bold text-primary">{{ $account->title }}</h1>
                    <p class="text-sm text-secondary mt-0.5 font-mono">{{ $account->game->name }}</p>
                </div>

                {{-- Price --}}
                <div class="flex items-end gap-3">
                    @if ($account->discount_price)
                        <p class="text-3xl font-bold text-accent">Rp{{ number_format($account->discount_price, 0, ',', '.') }}</p>
                        <span class="text-sm text-secondary line-through mb-1">Rp{{ number_format($account->price_sell ?? $account->price_rent, 0, ',', '.') }}</span>
                        @if ($account->discount_percent)
                            <span class="px-2 py-0.5 rounded text-xs font-mono bg-accent text-white">-{{ $account->discount_percent }}%</span>
                        @endif
                    @elseif ($account->price_sell)
                        <p class="text-3xl font-bold text-accent">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</p>
                    @endif
                </div>

                @if ($account->price_rent)
                <div class="pt-4 border-t border-subtle">
                    <p class="text-xs font-mono text-secondary uppercase tracking-wider mb-2">Sewa</p>
                    <p class="text-lg font-bold text-primary">Rp{{ number_format($account->price_rent, 0, ',', '.') }} <span class="text-sm text-secondary font-normal">/jam</span></p>
                </div>
                @endif

                {{-- Status --}}
                <div class="flex items-center gap-2 pt-4 border-t border-subtle">
                    <span class="w-2 h-2 rounded-full @if($account->status === 'available') bg-[#ff5357] @else bg-[#b7b5b4]/40 @endif"></span>
                    <span class="text-sm text-secondary font-mono">
                        @if($account->status === 'available') Available
                        @elseif($account->status === 'reserved') Reserved
                        @elseif($account->status === 'sold') Sold
                        @else Rented @endif
                    </span>
                </div>

                {{-- Actions --}}
                <div class="space-y-3">
                    @if ($account->price_sell && $account->status === 'available')
                        <a href="{{ route('transactions.beli', $account) }}" class="block w-full text-center px-5 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 15px rgba(255,83,87,0.3);">Beli Sekarang</a>
                    @endif
                    @auth
                        @php $wished = Auth::user()->wishlists()->where('account_id', $account->id)->exists() @endphp
                        <form method="POST" action="{{ route('wishlist.toggle', $account) }}">
                            @csrf
                            <button type="submit" class="block w-full text-center px-5 py-3 border border-default text-secondary rounded-lg text-sm font-medium hover:border-accent hover:text-accent transition-all">
                                @if ($wished) Hapus dari Wishlist @else Tambah ke Wishlist @endif
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-5 py-3 border border-default text-secondary rounded-lg text-sm font-medium hover:border-accent hover:text-accent transition-all">Login untuk Wishlist</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Related --}}
    @if ($related->count())
    <section class="mt-16">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-sm font-bold text-primary">Akun Lainnya</h2>
            <a href="{{ route('katalog') }}" class="text-xs text-accent hover:underline font-mono uppercase tracking-wider">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($related as $r)
                <x-account-card :account="$r" />
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection



