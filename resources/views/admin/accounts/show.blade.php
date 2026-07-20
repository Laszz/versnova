@extends('layouts.admin')

@section('title', $account->title)

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="glass-panel rounded-xl p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 class="text-lg font-bold text-[#e5e2e1]">{{ $account->title }}</h2>
                    <p class="text-sm text-[#b7b5b4] mt-0.5">{{ $account->game->name }} &middot; Level {{ $account->level ?? '-' }}</p>
                </div>
                @php
                    $sc = match($account->status) {
                        'available' => 'bg-[#ff5357]/10 text-[#ffb3af]',
                        'reserved' => 'bg-blue-500/10 text-blue-400',
                        'sold', 'rented' => 'bg-white/10 text-[#b7b5b4]/60',
                        default => 'bg-white/10 text-[#b7b5b4]/60',
                    };
                @endphp
                <span class="text-xs px-3 py-1 rounded-full font-medium {{ $sc }}">{{ $account->status }}</span>
            </div>
            @if ($account->description)
                <p class="text-sm text-[#b7b5b4] leading-relaxed">{{ $account->description }}</p>
            @endif
            <div class="grid grid-cols-4 gap-4 mt-6">
                <div class="bg-white/[0.03] rounded-lg p-3">
                    <p class="text-[#b7b5b4]/60 text-xs font-mono uppercase">Jual</p>
                    <p class="text-sm font-semibold text-[#e5e2e1] mt-1">Rp{{ number_format($account->price_sell ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/[0.03] rounded-lg p-3">
                    <p class="text-[#b7b5b4]/60 text-xs font-mono uppercase">Sewa/jam</p>
                    <p class="text-sm font-semibold text-[#e5e2e1] mt-1">Rp{{ number_format($account->price_rent ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/[0.03] rounded-lg p-3">
                    <p class="text-[#b7b5b4]/60 text-xs font-mono uppercase">Diskon</p>
                    <p class="text-sm font-semibold text-[#e5e2e1] mt-1">{{ $account->discount_percent ? $account->discount_percent.'%' : '-' }}</p>
                </div>
                <div class="bg-white/[0.03] rounded-lg p-3">
                    <p class="text-[#b7b5b4]/60 text-xs font-mono uppercase">Transaksi</p>
                    <p class="text-sm font-semibold text-[#e5e2e1] mt-1">{{ $account->transactions->count() }}x</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        @if ($account->images->count())
        <div class="glass-panel rounded-xl p-6">
            <h3 class="text-sm font-semibold text-[#e5e2e1] mb-3">Galeri ({{ $account->images->count() }})</h3>
            <div class="grid grid-cols-2 gap-2">
                @foreach ($account->images as $img)
                    <img src="{{ Storage::url($img->image_path) }}" class="rounded-lg object-cover h-20 w-full">
                @endforeach
            </div>
        </div>
        @endif
        <div class="glass-panel rounded-xl p-6 space-y-3">
            <a href="{{ route('admin.accounts.edit', $account) }}" class="btn-admin-primary block text-center w-full">Edit Akun</a>
            <form method="POST" action="{{ route('admin.accounts.destroy', $account) }}" onsubmit="return confirm('Hapus?')">
                @csrf @method('DELETE')
                <button class="btn-admin-danger block text-center w-full">Hapus Akun</button>
            </form>
        </div>
    </div>
</div>
@endsection
