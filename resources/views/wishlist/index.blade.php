@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <div class="mb-8">
        <h1 class="text-lg font-bold text-primary">Wishlist</h1>
        <p class="text-sm text-secondary mt-1">Akun favoritmu</p>
    </div>

    @if ($accounts->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach ($accounts as $account)
            @php $type = $account->price_sell ? 'buy' : ($account->price_rent ? 'rent' : null) @endphp
            <x-account-card :account="$account" :type="$type" />
        @endforeach
    </div>
    @else
    <div class="text-center py-20">
        <span class="material-symbols-outlined text-5xl text-secondary block mb-4">favorite</span>
        <p class="text-secondary">Belum ada akun di wishlist.</p>
        <a href="{{ route('produk.index') }}" class="text-sm text-accent hover:underline mt-2 inline-block">Cari akun</a>
    </div>
    @endif
</div>
@endsection








