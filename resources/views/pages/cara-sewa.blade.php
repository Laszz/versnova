@extends('layouts.app')

@section('title', 'Cara Sewa Akun')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <h1 class="text-lg font-bold text-primary mb-2">Cara Sewa Akun</h1>
    <p class="text-sm text-secondary mb-8">Panduan lengkap menyewa akun game di Versnova</p>

    <div class="space-y-8">
        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">1</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Cari Akun Sewa</h2>
                    <p class="text-sm text-secondary mt-1">Kunjungi halaman <a href="{{ route('sewa.index') }}" class="text-accent hover:underline">Sewa</a>. Filter per game dan pilih akun yang ingin kamu sewa.</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">2</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Pilih Paket Sewa</h2>
                    <p class="text-sm text-secondary mt-1">Pilih durasi sewa yang kamu inginkan (1 jam, 3 jam, 6 jam, atau Paket Begadang). Setiap paket memiliki harga berbeda.</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">3</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Bayar & Upload Bukti</h2>
                    <p class="text-sm text-secondary mt-1">Transfer sesuai total harga dan upload bukti pembayaran. Admin akan memverifikasi.</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">4</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Mulai Main</h2>
                    <p class="text-sm text-secondary mt-1">Admin akan mengirimkan akses akun via chat. Timer sewa akan berjalan otomatis. Mainkan sampai waktu habis!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-card border border-accent/20 rounded-xl p-5 mt-8">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-accent text-sm mt-0.5">schedule</span>
            <div>
                <p class="text-sm font-medium text-primary">Paket Begadang</p>
                <p class="text-sm text-secondary mt-1">Khusus untuk paket Begadang (21:00 - 06:00 WIB), kamu bisa menikmati harga spesial untuk sesi malam hari. Timer akan berjalan otomatis sesuai durasi paket.</p>
            </div>
        </div>
    </div>
</div>
@endsection

