@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('katalog') }}" class="hover:text-amber-500 transition-colors">Katalog</a>
        <span>/</span>
        <a href="{{ route('katalog.game', $account->game) }}" class="hover:text-amber-500 transition-colors">{{ $account->game->name }}</a>
        <span>/</span>
        <span class="text-gray-300">{{ $account->title }}</span>
    </div>

    <div class="grid lg:grid-cols-12 gap-8">
        {{-- Gallery --}}
        <div class="lg:col-span-7 space-y-3">
            <div class="aspect-video rounded-card overflow-hidden bg-surface border border-outline">
                @if ($account->primaryImage)
                    <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="{{ $account->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-600">
                        <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>

            @if ($account->images->count() > 1)
            <div class="flex gap-2 overflow-x-auto no-scrollbar">
                @foreach ($account->images as $img)
                    <div class="w-20 h-14 shrink-0 rounded overflow-hidden border border-outline @if($img->is_primary) border-amber-500 @endif">
                        <img src="{{ Storage::url($img->image_path) }}" alt="" class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>
            @endif

            {{-- Specs --}}
            <div class="bg-surface border border-outline rounded-card p-5">
                <h2 class="font-heading text-xl text-gray-100 mb-4">Spesifikasi</h2>
                <div class="grid grid-cols-2 gap-4">
                    @if ($account->platform)
                    <div>
                        <p class="text-gray-500 text-xs font-caption uppercase">Platform</p>
                        <p class="text-gray-200 mt-0.5">{{ $account->platform }}</p>
                    </div>
                    @endif
                    @if ($account->server)
                    <div>
                        <p class="text-gray-500 text-xs font-caption uppercase">Server</p>
                        <p class="text-gray-200 mt-0.5">{{ $account->server }}</p>
                    </div>
                    @endif
                    @if ($account->level)
                    <div>
                        <p class="text-gray-500 text-xs font-caption uppercase">Level</p>
                        <p class="text-gray-200 mt-0.5">{{ $account->level }}</p>
                    </div>
                    @endif
                    @if ($account->bind_status)
                    <div>
                        <p class="text-gray-500 text-xs font-caption uppercase">Bind Status</p>
                        <p class="text-gray-200 mt-0.5">{{ $account->bind_status }}</p>
                    </div>
                    @endif
                    @if ($account->login_method)
                    <div>
                        <p class="text-gray-500 text-xs font-caption uppercase">Login</p>
                        <p class="text-gray-200 mt-0.5">{{ $account->login_method }}</p>
                    </div>
                    @endif
                </div>

                @if ($account->description)
                <div class="mt-4 pt-4 border-t border-outline/30">
                    <p class="text-gray-500 text-xs font-caption uppercase mb-2">Deskripsi</p>
                    <p class="text-gray-300 text-sm">{{ $account->description }}</p>
                </div>
                @endif

                @if ($account->skin_info)
                <div class="mt-4 pt-4 border-t border-outline/30">
                    <p class="text-gray-500 text-xs font-caption uppercase mb-2">Skin & Items</p>
                    <p class="text-gray-300 text-sm">{{ $account->skin_info }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Purchase Widget --}}
        <div class="lg:col-span-5">
            <div class="bg-surface border border-amber-500/20 rounded-card p-6 sticky top-24 space-y-6">
                <div>
                    <h1 class="font-heading text-2xl text-gray-100">{{ $account->title }}</h1>
                    <p class="text-gray-500 text-sm mt-1">{{ $account->game->name }}</p>
                </div>

                {{-- Price --}}
                <div class="flex items-end gap-3">
                    @if ($account->discount_price)
                        <span class="font-heading text-display-mobile text-amber-500">Rp{{ number_format($account->discount_price, 0, ',', '.') }}</span>
                        <span class="text-gray-500 line-through text-lg mb-1">Rp{{ number_format($account->price_sell ?? $account->price_rent, 0, ',', '.') }}</span>
                        @if ($account->discount_percent)
                            <span class="badge-flash text-xs">-{{ $account->discount_percent }}%</span>
                        @endif
                    @elseif ($account->price_sell)
                        <span class="font-heading text-display-mobile text-amber-500">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</span>
                        <span class="text-gray-500 text-sm mb-1.5">Beli</span>
                    @endif
                </div>

                @if ($account->price_rent)
                <div class="pt-4 border-t border-outline/30">
                    <p class="font-caption text-label text-gray-500 uppercase mb-3">Sewa per Jam</p>
                    <p class="font-heading text-2xl text-gray-100 mb-3">Rp{{ number_format($account->price_rent, 0, ',', '.') }} <span class="text-sm text-gray-500 font-body">/jam</span></p>

                    <a href="#rent-section" class="btn-ghost w-full text-center text-sm">Lihat Paket Sewa</a>
                </div>
                @endif

                {{-- Status --}}
                <div class="flex items-center gap-2 pt-4 border-t border-outline/30">
                    <span class="w-2 h-2 rounded-full @if($account->status === 'available') bg-success @else bg-danger @endif"></span>
                    <span class="text-sm text-gray-400">
                        @if($account->status === 'available') Tersedia
                        @elseif($account->status === 'reserved') Direservasi
                        @elseif($account->status === 'sold') Terjual
                        @else Tersewa @endif
                    </span>
                </div>

                {{-- Actions --}}
                <div class="space-y-3 pt-2">
                    @if ($account->price_sell && $account->status === 'available')
                        <a href="{{ route('transactions.beli', $account) }}" class="btn-primary w-full text-center">Beli Sekarang</a>
                    @endif
                    @auth
                        @php $wished = Auth::user()->wishlists()->where('account_id', $account->id)->exists() @endphp
                        <form method="POST" action="{{ route('wishlist.toggle', $account) }}">
                            @csrf
                            <button type="submit" class="btn-ghost w-full text-center text-sm">
                                @if ($wished) Hapus dari Wishlist @else Tambah ke Wishlist @endif
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost w-full text-center text-sm">Login untuk Wishlist</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Related Accounts --}}
    @if ($related->count())
    <section class="mt-16">
        <h2 class="font-heading text-heading text-gray-100 mb-6">Akun Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($related as $r)
                <x-account-card :account="$r" />
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
