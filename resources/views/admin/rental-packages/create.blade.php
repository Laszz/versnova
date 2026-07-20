@extends('layouts.admin')

@section('content')
<a href="{{ route('admin.rental-packages.index') }}" class="text-gray-500 hover:text-amber-500 text-sm mb-6 inline-block">&larr; Kembali</a>
<h1 class="font-heading text-heading text-gray-100 mt-2 mb-6">Tambah Package</h1>

<form method="POST" action="{{ route('admin.rental-packages.store') }}" class="max-w-md space-y-4 bg-surface border border-outline rounded-card p-6">
    @csrf
    <div>
        <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Nama</label>
        <input type="text" name="name" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5" required>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Jam</label>
            <input type="number" name="hours" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5" required>
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Harga</label>
            <input type="number" name="price" step="0.01" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5" required>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Buka (HH:MM)</label>
            <input type="text" name="open_time" placeholder="21:00" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5">
        </div>
        <div>
            <label class="font-caption text-label text-gray-400 uppercase mb-1 block">Tutup (HH:MM)</label>
            <input type="text" name="close_time" placeholder="06:00" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5">
        </div>
    </div>
    <button type="submit" class="btn-primary">Simpan</button>
</form>
@endsection
