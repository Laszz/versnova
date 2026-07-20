@extends('layouts.admin')

@section('title', request('type') === 'rent' ? 'Tambah Akun Sewa' : 'Tambah Akun Jual')

@section('content')
<div class="mx-auto max-w-2xl glass-panel rounded-xl p-6">
    <form method="POST" action="{{ route('admin.accounts.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="type" value="{{ request('type', 'buy') }}">

        <div class="flex items-center gap-4 pb-4 border-b border-white/5">
            <div class="w-10 h-10 rounded-lg bg-[#ff5357] flex items-center justify-center">
                <span class="material-symbols-outlined text-white">{{ request('type') === 'rent' ? 'schedule' : 'sell' }}</span>
            </div>
            <div>
                <h2 class="text-base font-semibold text-[#e5e2e1]">{{ request('type') === 'rent' ? 'Tambah Akun Sewa' : 'Tambah Akun Jual' }}</h2>
                <p class="text-xs text-secondary">Isi detail akun di bawah</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Game</label>
                <select name="game_id" class="select-admin">
                    @foreach ($games as $g) <option value="{{ $g->id }}">{{ $g->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Title</label>
                <input type="text" name="title" class="input-admin" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="input-admin"></textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Platform</label>
                <input type="text" name="platform" class="input-admin" placeholder="Android">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Server</label>
                <input type="text" name="server" class="input-admin" placeholder="Asia">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Level</label>
                <input type="text" name="level" class="input-admin" placeholder="250">
            </div>
        </div>

        {{-- Harga based on type --}}
        @if (request('type') === 'rent')
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Sewa /jam</label>
            <input type="text" name="price_rent" inputmode="numeric" class="input-admin input-rupiah" placeholder="Rp 5.000" required>
        </div>
        @else
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Jual</label>
            <input type="text" name="price_sell" inputmode="numeric" class="input-admin input-rupiah" placeholder="Rp 150.000" required>
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
                    <input type="text" name="discount_amount" inputmode="numeric" class="input-admin input-rupiah" placeholder="Rp 20.000">
                    <p class="text-[10px] text-secondary/60 mt-1">Isi nominal potongan harga</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Mulai</label>
                    <input type="datetime-local" name="discount_start" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Selesai</label>
                    <input type="datetime-local" name="discount_until" class="input-admin">
                    <p class="text-[10px] text-secondary/60 mt-1">Kosongi tidak ada batas</p>
                </div>
            </div>
        </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Status</label>
            <select name="status" class="select-admin">
                <option value="available">Available</option>
                <option value="reserved">Reserved</option>
                <option value="sold">Sold</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Skin / Items</label>
            <textarea name="skin_info" rows="2" class="input-admin"></textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">Simpan</button>
            <a href="{{ route('admin.accounts.index') }}" class="btn-admin-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
