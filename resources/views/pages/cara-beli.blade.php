@extends('layouts.app')

@section('title', 'Cara Beli Akun')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <h1 class="text-lg font-bold text-primary mb-2">Cara Beli Akun</h1>
    <p class="text-sm text-secondary mb-8">Panduan lengkap membeli akun game di Versnova</p>

    <div class="space-y-8">
        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">1</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Cari Akun</h2>
                    <p class="text-sm text-secondary mt-1">Telusuri halaman <a href="{{ route('produk.index') }}" class="text-accent hover:underline">Beli</a>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">2</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Klik Beli</h2>
                    <p class="text-sm text-secondary mt-1">Klik tombol "Beli" pada akun yang kamu pilih. Kamu akan diarahkan ke halaman checkout untuk konfirmasi.</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">3</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Transfer Pembayaran</h2>
                    <p class="text-sm text-secondary mt-1">Transfer sejumlah total harga ke rekening admin yang tertera. Simpan bukti transfer.</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">4</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Upload Bukti</h2>
                    <p class="text-sm text-secondary mt-1">Upload bukti transfer di halaman transaksi. Admin akan memverifikasi pembayaranmu.</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                    <span class="text-accent font-bold text-sm">5</span>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-primary">Terima Akun</h2>
                    <p class="text-sm text-secondary mt-1">Setelah dikonfirmasi, admin akan mengirimkan kredensial akun melalui chat. Cek halaman <a href="{{ route('chat') }}" class="text-accent hover:underline">Chat</a> untuk menerima detail login.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

