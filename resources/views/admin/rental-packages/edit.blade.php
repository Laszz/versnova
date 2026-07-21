@extends('layouts.admin')

@section('title', 'Edit Package Rental')

@section('content')
<div class="mx-auto max-w-2xl">
    <a href="{{ route('admin.rental-packages.index') }}" class="inline-flex items-center gap-1 text-sm text-[#b7b5b4] hover:text-[#ffb3af] mb-6 transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali
    </a>

    <div class="glass-panel rounded-xl p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-[#ff5357] flex items-center justify-center">
                <span class="material-symbols-outlined text-white">edit_note</span>
            </div>
            <div>
                <h2 class="text-base font-semibold text-[#e5e2e1]">Edit Package</h2>
                <p class="text-xs text-[#b7b5b4]">{{ $rentalPackage->name }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.rental-packages.update', $rentalPackage) }}" class="space-y-6">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Nama Package</label>
                    <input type="text" name="name" value="{{ $rentalPackage->name }}" class="input-admin" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Durasi (jam)</label>
                    <input type="number" name="hours" value="{{ $rentalPackage->hours }}" class="input-admin" min="1" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#b7b5b4] text-sm font-mono">Rp</span>
                    <input type="text" name="price" inputmode="numeric" value="{{ number_format($rentalPackage->price, 0, ',', '.') }}" class="input-admin pl-10 input-rupiah" required>
                </div>
            </div>

            <div class="bg-white/[0.03] rounded-lg p-5 border border-white/5">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-sm text-[#b7b5b4]">schedule</span>
                    <span class="text-sm font-medium text-[#e5e2e1]">Jam Operasional</span>
                    <span class="text-xs text-[#b7b5b4]/60 font-mono">(opsional)</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-[#b7b5b4] mb-1">Buka</label>
                        <input type="time" name="open_time" value="{{ $rentalPackage->open_time ? date('H:i', strtotime($rentalPackage->open_time)) : '' }}" class="input-admin">
                    </div>
                    <div>
                        <label class="block text-xs text-[#b7b5b4] mb-1">Tutup</label>
                        <input type="time" name="close_time" value="{{ $rentalPackage->close_time ? date('H:i', strtotime($rentalPackage->close_time)) : '' }}" class="input-admin">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-admin-primary flex items-center gap-2 px-6">
                    <span class="material-symbols-outlined text-sm">check</span>
                    Update Package
                </button>
                <a href="{{ route('admin.rental-packages.index') }}" class="btn-admin-ghost">Batal</a>
            </div>
        </form>
    </div>

    {{-- Current Preview --}}
    <div class="glass-panel rounded-xl p-6 mt-6">
        <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-outlined text-sm text-[#b7b5b4]">visibility</span>
            <span class="text-xs font-mono text-[#b7b5b4] uppercase tracking-wider">Current Package</span>
        </div>
        <div class="bg-white/[0.03] rounded-lg p-5 border border-white/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-base font-semibold text-[#e5e2e1]">{{ $rentalPackage->name }}</p>
                    <p class="text-sm text-[#b7b5b4] mt-0.5">{{ $rentalPackage->hours }} jam
                        @if ($rentalPackage->open_time)
                            &middot; {{ date('H:i', strtotime($rentalPackage->open_time)) }} - {{ date('H:i', strtotime($rentalPackage->close_time)) }}
                        @endif
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xl font-bold text-[#ffb3af]">Rp{{ number_format($rentalPackage->price, 0, ',', '.') }}</p>
                    <p class="text-[10px] font-mono text-[#b7b5b4]/60 uppercase">/ sesi</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



