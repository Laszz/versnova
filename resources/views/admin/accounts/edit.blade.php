@extends('layouts.admin')

@section('title', $account->price_sell ? 'Edit Akun Jual' : 'Edit Akun Sewa')

@section('content')
<div class="mx-auto max-w-2xl glass-panel rounded-xl p-6">
    <form method="POST" action="{{ route('admin.accounts.update', $account) }}" class="space-y-5">
        @csrf @method('PUT')
        <input type="hidden" name="type" value="{{ $account->price_sell ? 'buy' : 'rent' }}">

        <div class="flex items-center gap-4 pb-4 border-b border-white/5">
            <div class="w-10 h-10 rounded-lg bg-[#ff5357] flex items-center justify-center">
                <span class="material-symbols-outlined text-white">{{ $account->price_sell ? 'sell' : 'schedule' }}</span>
            </div>
            <div>
                <h2 class="text-base font-semibold text-[#e5e2e1]">{{ $account->price_sell ? 'Edit Akun Jual' : 'Edit Akun Sewa' }}</h2>
                <p class="text-xs text-secondary">{{ $account->title }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Game</label>
                <select name="game_id" class="select-admin">
                    @foreach ($games as $g) <option value="{{ $g->id }}" @selected($account->game_id === $g->id)>{{ $g->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Title</label>
                <input type="text" name="title" value="{{ $account->title }}" class="input-admin" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="input-admin">{{ $account->description }}</textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Platform</label>
                <input type="text" name="platform" value="{{ $account->platform }}" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Server</label>
                <input type="text" name="server" value="{{ $account->server }}" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Level</label>
                <input type="text" name="level" value="{{ $account->level }}" class="input-admin">
            </div>
        </div>

        @if ($account->price_sell)
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Jual</label>
            <input type="text" name="price_sell" inputmode="numeric" value="{{ number_format($account->price_sell, 0, ',', '.') }}" class="input-admin input-rupiah" required>
        </div>

        <div class="bg-[#1c1b1b] border border-white/5 rounded-lg p-5 space-y-4">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-[#ffb3af]">local_fire_department</span>
                <h3 class="text-sm font-medium text-[#e5e2e1]">Flashsale / Diskon</h3>
                <span class="text-[10px] text-secondary font-mono">(opsional)</span>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Besar Diskon</label>
                    @php $discountAmount = $account->price_sell && $account->discount_price ? $account->price_sell - $account->discount_price : 0; @endphp
                    <input type="text" name="discount_amount" inputmode="numeric" value="{{ $discountAmount ? number_format($discountAmount, 0, ',', '.') : '' }}" class="input-admin input-rupiah" placeholder="Rp 20.000">
                    <p class="text-[10px] text-secondary/60 mt-1">Nominal potongan harga</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Mulai</label>
                    <input type="datetime-local" name="discount_start" value="{{ $account->discount_start ? date('Y-m-d\TH:i', strtotime($account->discount_start)) : '' }}" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Selesai</label>
                    <input type="datetime-local" name="discount_until" value="{{ $account->discount_until ? date('Y-m-d\TH:i', strtotime($account->discount_until)) : '' }}" class="input-admin">
                </div>
            </div>
            @if ($account->discount_percent)
                <p class="text-xs text-accent">Diskon {{ $account->discount_percent }}% — Hemat Rp{{ number_format($discountAmount, 0, ',', '.') }}</p>
            @endif
        </div>
        @else
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Sewa /jam</label>
            <input type="text" name="price_rent" inputmode="numeric" value="{{ number_format($account->price_rent, 0, ',', '.') }}" class="input-admin input-rupiah" required>
        </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Status</label>
            <select name="status" class="select-admin">
                @foreach (['available','reserved','sold','rented'] as $s) <option value="{{ $s }}" @selected($account->status === $s)>{{ ucfirst($s) }}</option> @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Skin / Items</label>
            <textarea name="skin_info" rows="2" class="input-admin">{{ $account->skin_info }}</textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">Update</button>
            <a href="{{ route('admin.accounts.index') }}" class="btn-admin-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection

