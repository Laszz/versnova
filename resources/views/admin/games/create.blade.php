@extends('layouts.admin')

@section('title', 'Tambah Game')

@section('content')
<div class="mx-auto max-w-lg glass-panel rounded-xl p-6">
    <form method="POST" action="{{ route('admin.games.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Nama Game</label>
            <input type="text" name="name" class="input-admin" placeholder="Free Fire" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Icon</label>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 px-4 py-3 rounded-lg border border-dashed border-white/10 hover:border-[#ff5357]/40 cursor-pointer transition-colors w-full">
                    <span class="material-symbols-outlined text-[#b7b5b4]">upload</span>
                    <span class="text-sm text-[#b7b5b4]">Upload gambar</span>
                    <input type="file" name="icon" accept="image/*" class="hidden">
                </label>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">Simpan</button>
            <a href="{{ route('admin.games.index') }}" class="btn-admin-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection


