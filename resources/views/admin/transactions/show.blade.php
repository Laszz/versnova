@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="glass-panel rounded-xl p-6">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <h2 class="text-lg font-bold text-[#e5e2e1]">Transaksi</h2>
                    <p class="font-mono text-xs text-[#b7b5b4] mt-1">{{ $transaction->invoice_number }}</p>
                </div>
                @php
                    $sc = match($transaction->status) {
                        'waiting_payment' => 'bg-amber-500/10 text-amber-400',
                        'waiting_confirmation' => 'bg-blue-500/10 text-blue-400',
                        'confirmed' => 'bg-[#ff5357]/10 text-[#ffb3af]',
                        'completed' => 'bg-emerald-500/10 text-emerald-400',
                        'cancelled', 'expired' => 'bg-red-500/10 text-red-400',
                        default => 'bg-white/10 text-[#b7b5b4]/60',
                    };
                @endphp
                <span class="text-xs px-3 py-1 rounded-full font-medium {{ $sc }}">{{ str_replace('_', ' ', $transaction->status) }}</span>
            </div>

            <div class="grid grid-cols-2 gap-5 text-sm">
                <div><p class="text-[#b7b5b4]">Akun</p><p class="text-[#e5e2e1] font-medium mt-0.5">{{ $transaction->account->title }}</p></div>
                <div><p class="text-[#b7b5b4]">Pembeli</p><p class="text-[#e5e2e1] font-medium mt-0.5">{{ $transaction->user->name }}</p></div>
                <div><p class="text-[#b7b5b4]">Tipe</p><p class="text-[#e5e2e1] font-medium mt-0.5 capitalize">{{ $transaction->type }}</p></div>
                <div><p class="text-[#b7b5b4]">Total</p><p class="text-lg font-bold text-[#e5e2e1] mt-0.5">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p></div>
                @if ($transaction->rentalPackage)
                <div><p class="text-[#b7b5b4]">Paket</p><p class="text-[#e5e2e1] font-medium mt-0.5">{{ $transaction->rentalPackage->name }} ({{ $transaction->rentalPackage->hours }}j)</p></div>
                @endif
                @if ($transaction->rent_end)
                <div><p class="text-[#b7b5b4]">Sewa sampai</p><p class="text-[#e5e2e1] font-medium mt-0.5">{{ $transaction->rent_end->format('d M Y H:i') }}</p></div>
                @endif
            </div>

            @if ($transaction->payment_proof)
            <div class="mt-6 pt-5 border-t border-white/5">
                <p class="text-sm font-medium text-[#e5e2e1] mb-3">Bukti Pembayaran</p>
                <img src="{{ Storage::url($transaction->payment_proof) }}" class="max-w-sm rounded-lg border border-white/10">
            </div>
            @endif
        </div>
    </div>

    <div class="space-y-6">
        @if ($transaction->status === 'waiting_confirmation')
        <div class="glass-panel rounded-xl p-6">
            <h3 class="text-sm font-semibold text-[#e5e2e1] mb-4">Konfirmasi</h3>
            <div class="space-y-3">
                <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="w-full btn-admin-primary text-center">Terima & Kirim Akses</button>
                </form>
                <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button class="w-full btn-admin-danger text-center">Tolak</button>
                </form>
            </div>
        </div>
        @endif
        @if ($transaction->status === 'confirmed')
        <div class="glass-panel rounded-xl p-6">
            <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="completed">
                <button type="submit" class="w-full btn-admin-primary text-center">Tandai Selesai</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection



