@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <h1 class="text-lg font-bold text-primary mb-2">Kebijakan Privasi</h1>
    <p class="text-sm text-secondary mb-8">Terakhir diperbarui: {{ date('d F Y') }}</p>

    <div class="space-y-6 text-sm text-secondary leading-relaxed">
        <div class="bg-card border border-subtle rounded-xl p-6">
            <h2 class="text-sm font-semibold text-primary mb-2">1. Informasi yang Kami Kumpulkan</h2>
            <p>Kami mengumpulkan informasi yang Anda berikan saat mendaftar, seperti nama, alamat email, dan informasi lain yang diperlukan untuk proses transaksi. Data pembayaran tidak disimpan oleh kami karena diproses secara manual via transfer bank.</p>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <h2 class="text-sm font-semibold text-primary mb-2">2. Penggunaan Informasi</h2>
            <p>Informasi Anda digunakan untuk memproses transaksi, memberikan layanan chat support, dan meningkatkan pengalaman pengguna. Kami tidak akan menjual atau menyewakan data pribadi Anda kepada pihak ketiga.</p>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <h2 class="text-sm font-semibold text-primary mb-2">3. Keamanan Data</h2>
            <p>Kami menggunakan enkripsi untuk melindungi data sensitif seperti password dan pesan chat. Seluruh komunikasi antara pengguna dan admin diamankan dengan enkripsi end-to-end.</p>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <h2 class="text-sm font-semibold text-primary mb-2">4. Cookie</h2>
            <p>Kami menggunakan cookie untuk menyimpan preferensi tema (dark/light mode) dan sesi login. Anda dapat menghapus cookie kapan saja melalui pengaturan browser.</p>
        </div>

        <div class="bg-card border border-subtle rounded-xl p-6">
            <h2 class="text-sm font-semibold text-primary mb-2">5. Hak Anda</h2>
            <p>Anda berhak mengakses, mengubah, atau menghapus data pribadi Anda kapan saja melalui halaman profil. Untuk pertanyaan lebih lanjut, hubungi kami melalui <a href="{{ route('chat') }}" class="text-accent hover:underline">halaman chat</a> atau email support@versnova.id.</p>
        </div>
    </div>
</div>
@endsection

