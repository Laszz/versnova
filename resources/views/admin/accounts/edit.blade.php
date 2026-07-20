@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.accounts.index') }}" class="text-gray-500 hover:text-amber-500 text-sm">&larr; Kembali</a>
    <h1 class="font-heading text-heading text-gray-100 mt-2">Edit Akun</h1>
</div>

<form method="POST" action="{{ route('admin.accounts.update', $account) }}" class="max-w-2xl space-y-4 bg-surface border border-outline rounded-card p-6">
    @csrf @method('PUT')

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Game</label>
            <select name="game_id" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500" required>
                @foreach ($games as $g)
                    <option value="{{ $g->id }}" @if($account->game_id === $g->id) selected @endif>{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Title</label>
            <input type="text" name="title" value="{{ $account->title }}" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500" required>
        </div>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">{{ $account->description }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Platform</label>
            <input type="text" name="platform" value="{{ $account->platform }}" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Server</label>
            <input type="text" name="server" value="{{ $account->server }}" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Level</label>
            <input type="text" name="level" value="{{ $account->level }}" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Harga Jual</label>
            <input type="number" name="price_sell" value="{{ $account->price_sell }}" step="0.01" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Harga Sewa/jam</label>
            <input type="number" name="price_rent" value="{{ $account->price_rent }}" step="0.01" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
        </div>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Status</label>
        <select name="status" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">
            <option value="available" @if($account->status === 'available') selected @endif>Available</option>
            <option value="reserved" @if($account->status === 'reserved') selected @endif>Reserved</option>
            <option value="sold" @if($account->status === 'sold') selected @endif>Sold</option>
            <option value="rented" @if($account->status === 'rented') selected @endif>Rented</option>
        </select>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Skin Info</label>
        <textarea name="skin_info" rows="2" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500">{{ $account->skin_info }}</textarea>
    </div>

    <button type="submit" class="btn-primary">Update</button>
</form>
@endsection
