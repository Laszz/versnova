@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <a href="{{ route('katalog.show', $account) }}" class="text-gray-500 hover:text-amber-500 text-sm mb-6 inline-block">&larr; Kembali</a>

    <div class="bg-surface border border-outline rounded-card p-6 space-y-6">
        <h1 class="font-heading text-heading text-gray-100">Konfirmasi Pembelian</h1>

        <div class="flex gap-4 items-center pb-4 border-b border-outline/30">
            <div class="w-20 h-16 rounded overflow-hidden bg-surface-bright shrink-0">
                @if ($account->primaryImage)
                    <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <h2 class="font-heading text-xl text-gray-100">{{ $account->title }}</h2>
                <p class="text-gray-500 text-sm">{{ $account->game->name }} | Level {{ $account->level }}</p>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Harga</span>
                <span class="text-gray-200">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</span>
            </div>
            @if ($account->discount_percent)
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Diskon</span>
                <span class="text-success">-{{ $account->discount_percent }}%</span>
            </div>
            @endif
            <div class="flex justify-between text-lg pt-3 border-t border-outline/30">
                <span class="text-gray-200 font-semibold">Total</span>
                <span class="font-heading text-amber-500">Rp{{ number_format($account->discount_price ?? $account->price_sell, 0, ',', '.') }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('transactions.beli', $account) }}">
            @csrf
            <p class="text-gray-500 text-sm mb-4">Pembayaran via transfer bank ke rekening admin. Detail rekening akan ditampilkan setelah checkout.</p>
            <button type="submit" class="btn-primary w-full text-center">Checkout</button>
        </form>
    </div>
</div>
@endsection
