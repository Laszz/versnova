@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <a href="{{ route('riwayat') }}" class="inline-flex items-center gap-1 text-sm text-secondary hover:text-accent mb-6 transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Riwayat
    </a>

    <div class="bg-card border border-subtle rounded-xl p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-bold text-primary">Transaksi</h1>
            <span class="text-xs font-mono text-secondary">{{ $transaction->invoice_number }}</span>
        </div>

        <div class="flex gap-4 items-center pb-4 border-b border-subtle">
            <div class="w-16 h-12 rounded-lg overflow-hidden bg-elevated shrink-0">
                @if ($transaction->account->primaryImage)
                    <img src="{{ Storage::url($transaction->account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <p class="text-sm font-semibold text-primary">{{ $transaction->account->title }}</p>
                <p class="text-xs text-secondary font-mono">{{ $transaction->type === 'buy' ? 'Beli' : 'Sewa' }} | {{ $transaction->account->game->name }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-xs text-secondary font-mono uppercase">Status</p>
                <p class="text-primary font-medium mt-0.5 capitalize">{{ str_replace('_', ' ', $transaction->status) }}</p>
            </div>
            <div>
                <p class="text-xs text-secondary font-mono uppercase">Total</p>
                <p class="text-lg font-bold text-accent mt-0.5">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            </div>
            @if ($transaction->rent_end)
            <div>
                <p class="text-xs text-secondary font-mono uppercase">Sewa sampai</p>
                <p class="text-primary font-medium mt-0.5">{{ $transaction->rent_end->format('d M Y H:i') }}</p>
            </div>
            @endif
        </div>

        @if ($transaction->status === 'waiting_payment')
        <div class="bg-[#ff5357]/5 border border-accent rounded-xl p-5 space-y-4">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-primary">Instruksi Pembayaran</p>
                <span class="text-[10px] font-mono text-accent" x-data="c('{{ $transaction->created_at->addMinutes(5)->timestamp }}')" x-init="init()" x-text="d"></span>
            </div>
            <p class="text-sm text-secondary">Transfer <span class="text-accent font-semibold">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</span> ke rekening admin</p>
            <p class="text-sm text-secondary font-mono">BCA 1234567890 a/n Admin Versnova</p>

            <form method="POST" action="{{ route('transactions.bukti', $transaction) }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <label class="block">
                    <span class="text-xs text-secondary block mb-1">Upload Bukti Transfer</span>
                    <input type="file" name="payment_proof" accept="image/*" class="block w-full text-sm text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#ff5357] file:text-white file:font-medium hover:file:brightness-110" required>
                </label>
                    <button type="submit" class="w-full px-5 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all text-sm">Kirim Bukti</button>
                </div>
            </form>
            <form method="POST" action="{{ route('transactions.cancel', $transaction) }}">
                @csrf
                <button type="submit" class="w-full px-5 py-3 border border-subtle text-secondary rounded-lg text-sm font-medium hover:border-accent hover:text-accent transition-all" onclick="return confirm('Yakin batalkan pesanan?')">Batalkan Pesanan</button>
            </form>
            <p class="text-xs text-secondary">Pesanan otomatis dibatalkan jika tidak ada bukti dalam 5 menit.</p>
        </div>
        @endif

        @if ($transaction->status === 'completed')
            @php $userReview = $transaction->review; @endphp
            <div class="bg-card border border-subtle rounded-xl p-5 mt-6">
                <h3 class="text-sm font-semibold text-primary mb-3">Beri Rating & Review</h3>
                @if ($userReview)
                    <div class="flex items-center gap-1 mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-sm {{ $i <= $userReview->rating ? 'text-accent' : 'text-secondary/30' }}" style="font-variation-settings: 'FILL' 1">star</span>
                        @endfor
                    </div>
                    @if ($userReview->comment)
                        <p class="text-sm text-secondary italic">"{{ $userReview->comment }}"</p>
                    @endif
                    <p class="text-xs text-secondary/60 mt-2">Review kamu sudah dikirim. Terima kasih!</p>
                @else
                <form method="POST" action="{{ route('transactions.review', $transaction) }}" class="space-y-3">
                    @csrf
                    <div x-data="{ rate: 0 }">
                        <p class="text-xs text-secondary mb-2">Rating</p>
                        <div class="flex flex-row-reverse justify-end gap-1">
                            @for ($i = 5; $i >= 1; $i--)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden" @click="rate = {{ $i }}">
                                <span class="material-symbols-outlined text-2xl transition-colors" :class="rate >= {{ $i }} ? 'text-accent' : 'text-secondary/30'" style="font-variation-settings: 'FILL' 1">star</span>
                            </label>
                            @endfor
                        </div>
                    </div>
                    <textarea name="comment" rows="2" placeholder="Komentar (opsional)..." class="w-full bg-card border border-subtle rounded-lg px-4 py-2.5 text-sm text-primary placeholder-secondary focus:outline-none focus:border-accent transition-colors"></textarea>
                    <button type="submit" class="px-5 py-2 bg-accent text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all">Kirim Review</button>
                </form>
                @endif
            </div>
        @elseif ($transaction->status === 'confirmed')
            @if ($transaction->type === 'buy')
                <p class="text-sm text-secondary mt-4">Akun sudah dikirim admin via chat. Cek halaman chat untuk detail login.</p>
                <a href="{{ route('chat') }}" class="inline-flex items-center gap-1 text-sm text-accent hover:underline mt-1">
                    <span class="material-symbols-outlined text-sm">chat</span> Buka Chat
                </a>
            @endif
        @endif
    </div>
</div>
@endsection






