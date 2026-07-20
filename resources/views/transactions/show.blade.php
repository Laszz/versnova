@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <a href="{{ route('riwayat') }}" class="text-gray-500 hover:text-amber-500 text-sm mb-6 inline-block">&larr; Riwayat</a>

    <div class="bg-surface border border-outline rounded-card p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="font-heading text-heading text-gray-100">Transaksi</h1>
            <span class="text-xs font-caption uppercase text-gray-500">{{ $transaction->invoice_number }}</span>
        </div>

        <div class="flex gap-4 items-center pb-4 border-b border-outline/30">
            <div class="w-16 h-12 rounded overflow-hidden bg-surface-bright shrink-0">
                @if ($transaction->account->primaryImage)
                    <img src="{{ Storage::url($transaction->account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <p class="text-gray-200 font-semibold">{{ $transaction->account->title }}</p>
                <p class="text-gray-500 text-sm">{{ $transaction->type === 'buy' ? 'Beli' : 'Sewa' }} | {{ $transaction->account->game->name }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Status</p>
                <p class="text-gray-200 font-semibold capitalize">{{ str_replace('_', ' ', $transaction->status) }}</p>
            </div>
            <div>
                <p class="text-gray-500">Total</p>
                <p class="text-amber-500 font-heading text-xl">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            </div>
            @if ($transaction->rent_end)
            <div>
                <p class="text-gray-500">Sewa sampai</p>
                <p class="text-gray-200">{{ $transaction->rent_end->format('d M Y H:i') }}</p>
            </div>
            @endif
        </div>

        {{-- Payment Proof Upload --}}
        @if ($transaction->status === 'waiting_payment')
        <div class="bg-amber-500/5 border border-amber-500/20 rounded-card p-4 space-y-3">
            <p class="text-sm text-gray-200 font-semibold">Instruksi Pembayaran</p>
            <p class="text-sm text-gray-400">Transfer ke rekening admin sebesar <span class="text-amber-500 font-semibold">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</span></p>
            <p class="text-sm text-gray-500">Bank: BCA | No Rek: 1234567890 | A/N: Admin Versnova</p>

            <form method="POST" action="{{ route('transactions.bukti', $transaction) }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <label class="block">
                    <span class="font-caption text-label text-gray-500 uppercase mb-1 block">Upload Bukti Transfer</span>
                    <input type="file" name="payment_proof" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-btn file:border-0 file:bg-amber-500 file:text-black file:font-semibold hover:file:bg-amber-600" required>
                </label>
                <button type="submit" class="btn-primary w-full text-center text-sm">Kirim Bukti</button>
            </form>
            <p class="text-xs text-gray-500">Batalkan otomatis dalam 24 jam jika tidak ada pembayaran.</p>
        </div>
        @endif

        @if ($transaction->status === 'confirmed' || $transaction->status === 'completed')
            @if ($transaction->type === 'buy')
                <p class="text-gray-500 text-sm">Akun sudah dikirim admin via chat. Cek halaman chat untuk detail login.</p>
                <a href="{{ route('chat') }}" class="text-amber-500 text-sm hover:underline">Buka Chat</a>
            @endif
        @endif
    </div>
</div>
@endsection
