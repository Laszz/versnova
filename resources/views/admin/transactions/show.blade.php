@extends('layouts.admin')

@section('content')
<a href="{{ route('admin.transactions.index') }}" class="text-gray-500 hover:text-amber-500 text-sm mb-6 inline-block">&larr; Kembali</a>

<div class="bg-surface border border-outline rounded-card p-6 max-w-2xl">
    <div class="flex justify-between items-start mb-4">
        <h1 class="font-heading text-heading text-gray-100">Detail Transaksi</h1>
        <span class="text-xs font-mono text-gray-500">{{ $transaction->invoice_number }}</span>
    </div>

    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Akun</span><p class="text-gray-200">{{ $transaction->account->title }}</p></div>
            <div><span class="text-gray-500">User</span><p class="text-gray-200">{{ $transaction->user->name }}</p></div>
            <div><span class="text-gray-500">Tipe</span><p class="text-gray-200 capitalize">{{ $transaction->type }}</p></div>
            <div><span class="text-gray-500">Total</span><p class="text-amber-500 font-heading text-xl">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p></div>
            <div><span class="text-gray-500">Status</span><p class="text-gray-200 capitalize">{{ str_replace('_', ' ', $transaction->status) }}</p></div>
            @if ($transaction->rent_end)
            <div><span class="text-gray-500">Sewa sampai</span><p class="text-gray-200">{{ $transaction->rent_end }}</p></div>
            @endif
        </div>

        @if ($transaction->payment_proof)
        <div>
            <p class="text-gray-500 text-sm mb-2">Bukti Pembayaran</p>
            <img src="{{ Storage::url($transaction->payment_proof) }}" class="max-w-sm rounded border border-outline">
        </div>
        @endif

        @if ($transaction->status === 'waiting_confirmation')
        <div class="flex gap-3 pt-4 border-t border-outline/30">
            <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="confirmed">
                <button type="submit" class="btn-primary text-sm">Konfirmasi</button>
            </form>
            <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="cancelled">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-btn text-sm hover:bg-red-500">Tolak</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
