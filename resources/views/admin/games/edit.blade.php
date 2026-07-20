@extends('layouts.admin')

@section('title', 'Edit Game')

@section('content')
<div class="mx-auto max-w-lg glass-panel rounded-xl p-6">
    <form method="POST" action="{{ route('admin.games.update', $game) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Nama Game</label>
            <input type="text" name="name" value="{{ $game->name }}" class="input-admin" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Icon</label>
            @if ($game->icon)
                <div class="mb-3">
                    <img src="{{ Storage::url($game->icon) }}" class="w-12 h-12 rounded-lg object-cover">
                </div>
            @endif
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 px-4 py-3 rounded-lg border border-dashed border-white/10 hover:border-[#ff5357]/40 cursor-pointer transition-colors w-full">
                    <span class="material-symbols-outlined text-[#b7b5b4]">upload</span>
                    <span class="text-sm text-[#b7b5b4]">Ganti gambar</span>
                    <input type="file" name="icon" accept="image/*" class="hidden">
                </label>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">Update</button>
            <a href="{{ route('admin.games.index') }}" class="btn-admin-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
