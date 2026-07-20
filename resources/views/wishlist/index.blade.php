@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <h1 class="font-heading text-heading text-gray-100 mb-2">Wishlist</h1>
    <p class="text-gray-500 text-sm mb-8">Akun favoritmu</p>

    @if ($accounts->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach ($accounts as $account)
            <x-account-card :account="$account" />
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500">Belum ada akun di wishlist.</p>
        <a href="{{ route('katalog') }}" class="text-amber-500 hover:underline text-sm mt-2 inline-block">Cari akun</a>
    </div>
    @endif
</div>
@endsection
