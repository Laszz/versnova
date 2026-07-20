@extends('layouts.app')

@section('title', 'Konfirmasi Pembelian')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <a href="{{ route('katalog.show', $account) }}" class="inline-flex items-center gap-1 text-sm text-secondary hover:text-accent mb-6 transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali
    </a>

    <div class="bg-card border border-subtle rounded-xl p-6 space-y-6">
        <h1 class="text-lg font-bold text-primary">Konfirmasi Pembelian</h1>

        <div class="flex gap-4 items-center pb-4 border-b border-subtle">
            <div class="w-20 h-16 rounded-lg overflow-hidden bg-elevated shrink-0">
                @if ($account->primaryImage)
                    <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <h2 class="text-base font-semibold text-primary">{{ $account->title }}</h2>
                <p class="text-sm text-secondary font-mono">{{ $account->game->name }} | Level {{ $account->level }}</p>
            </div>
        </div>

        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-secondary">Harga</span>
                <span class="text-primary">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</span>
            </div>
            @if ($account->discount_percent)
            <div class="flex justify-between">
                <span class="text-secondary">Diskon</span>
                <span class="text-accent">-{{ $account->discount_percent }}%</span>
            </div>
            @endif
            <div class="flex justify-between text-base pt-3 border-t border-subtle">
                <span class="text-primary font-semibold">Total</span>
                <span class="text-lg font-bold text-accent">Rp{{ number_format($account->discount_price ?? $account->price_sell, 0, ',', '.') }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('transactions.beli', $account) }}">
            @csrf
            <p class="text-sm text-secondary mb-4">Pembayaran via transfer bank ke rekening admin. Detail rekening akan ditampilkan setelah checkout.</p>
            <button type="submit" class="w-full text-center px-5 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all">Checkout</button>
        </form>
    </div>
</div>
@endsection






