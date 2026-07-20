@extends('layouts.admin')

@section('title', 'Tambah Package Rental')

@section('content')
<div class="mx-auto max-w-2xl space-y-6">

    <div class="glass-panel rounded-xl p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-[#ff5357] flex items-center justify-center">
                <span class="material-symbols-outlined text-white">schedule</span>
            </div>
            <div>
                <h2 class="text-base font-semibold text-[#e5e2e1]">Buat Package Baru</h2>
                <p class="text-xs text-[#b7b5b4]">Tentukan durasi, harga, dan jam operasional</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.rental-packages.store') }}" class="space-y-6">
            @csrf

            {{-- Nama + Durasi --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Nama Package</label>
                    <input type="text" name="name" class="input-admin" placeholder="cth: 1 Jam Trial, Paket Begadang" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Durasi (jam)</label>
                    <input type="number" name="hours" class="input-admin" placeholder="1" min="1" required>
                </div>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#b7b5b4] text-sm font-mono">Rp</span>
                    <input type="number" name="price" step="0.01" class="input-admin pl-10" placeholder="15000" required>
                </div>
            </div>

            {{-- Jam Operasional (opsional) --}}
            <div class="bg-white/[0.03] rounded-lg p-5 border border-white/5">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-sm text-[#b7b5b4]">schedule</span>
                    <span class="text-sm font-medium text-[#e5e2e1]">Jam Operasional</span>
                    <span class="text-xs text-[#b7b5b4]/60 font-mono">(opsional — khusus paket begadang/jam terbatas)</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-[#b7b5b4] mb-1">Buka</label>
                        <input type="time" name="open_time" class="input-admin" value="21:00">
                    </div>
                    <div>
                        <label class="block text-xs text-[#b7b5b4] mb-1">Tutup</label>
                        <input type="time" name="close_time" class="input-admin" value="06:00">
                    </div>
                </div>
                <p class="text-xs text-[#b7b5b4]/40 mt-2">Kosongi jika package tersedia 24 jam</p>
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-admin-primary flex items-center gap-2 px-6">
                    <span class="material-symbols-outlined text-sm">check</span>
                    Simpan Package
                </button>
                <a href="{{ route('admin.rental-packages.index') }}" class="btn-admin-ghost">Batal</a>
            </div>
        </form>
    </div>

    {{-- Preview Card --}}
    <div class="glass-panel rounded-xl p-6" x-data="{ name: '', hours: '', price: '' }">
        <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-outlined text-sm text-[#b7b5b4]">visibility</span>
            <span class="text-xs font-mono text-[#b7b5b4] uppercase tracking-wider">Preview</span>
        </div>
        <div class="bg-white/[0.03] rounded-lg p-5 border border-white/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-base font-semibold text-[#e5e2e1]" x-text="name || 'Nama Package'">Nama Package</p>
                    <p class="text-sm text-[#b7b5b4] mt-0.5">
                        <span x-text="hours || '0'">0</span> jam
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xl font-bold text-[#ffb3af]">
                        Rp<span x-text="price ? Number(price).toLocaleString('id-ID') : '0'">0</span>
                    </p>
                    <p class="text-[10px] font-mono text-[#b7b5b4]/60 uppercase">/ sesi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="name"], input[name="hours"], input[name="price"]').forEach(el => {
        el.addEventListener('input', function () {
            const name = document.querySelector('input[name="name"]').value;
            const hours = document.querySelector('input[name="hours"]').value;
            const price = document.querySelector('input[name="price"]').value;
            const preview = document.querySelector('[x-data]');
            if (preview) {
                preview.__x.$data.name = name;
                preview.__x.$data.hours = hours;
                preview.__x.$data.price = price;
            }
        });
    });
</script>
@endsection
