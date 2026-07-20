@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.accounts.index') }}" class="text-gray-500 hover:text-amber-500 text-sm">&larr; Kembali</a>
    <h1 class="font-heading text-heading text-gray-100 mt-2">Tambah Akun</h1>
</div>

<form method="POST" action="{{ route('admin.accounts.store') }}" class="max-w-2xl space-y-4 bg-surface border border-outline rounded-card p-6">
    @csrf

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Game</label>
            <select name="game_id" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500" required>
                @foreach ($games as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Title</label>
            <input type="text" name="title" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500" required>
        </div>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Platform</label>
            <input type="text" name="platform" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500" placeholder="Android/iOS">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Server</label>
            <input type="text" name="server" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Level</label>
            <input type="text" name="level" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Harga Jual</label>
            <input type="number" name="price_sell" step="0.01" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Harga Sewa/jam</label>
            <input type="number" name="price_rent" step="0.01" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Status</label>
        <select name="status" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
            <option value="available">Available</option>
            <option value="reserved">Reserved</option>
            <option value="sold">Sold</option>
        </select>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Skin Info</label>
        <textarea name="skin_info" rows="2" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500"></textarea>
    </div>

    <button type="submit" class="btn-primary">Simpan</button>
</form>
@endsection
