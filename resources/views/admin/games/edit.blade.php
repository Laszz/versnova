@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.games.index') }}" class="text-gray-500 hover:text-amber-500 text-sm">&larr; Kembali</a>
    <h1 class="font-heading text-heading text-gray-100 mt-2">Edit Game</h1>
</div>

<form method="POST" action="{{ route('admin.games.update', $game) }}" class="max-w-md space-y-4 bg-surface border border-outline rounded-card p-6">
    @csrf @method('PUT')

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Nama Game</label>
        <input type="text" name="name" value="{{ $game->name }}" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none" required>
    </div>

    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Icon</label>
        <input type="text" name="icon" value="{{ $game->icon }}" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none">
    </div>

    <button type="submit" class="btn-primary">Update</button>
</form>
@endsection
