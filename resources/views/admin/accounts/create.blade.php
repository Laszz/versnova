@extends('layouts.admin')

@section('title', 'Tambah Akun')

@section('content')

<div class="mx-auto max-w-2xl glass-panel rounded-xl p-6">
    <form method="POST" action="{{ route('admin.accounts.store') }}" class="space-y-5">
        @csrf
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
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Jual</label>
                <input type="number" name="price_sell" step="0.01" class="input-admin" placeholder="150000">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Sewa/jam</label>
                <input type="number" name="price_rent" step="0.01" class="input-admin" placeholder="5000">
            </div>
        </div>
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
