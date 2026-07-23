@extends('layouts.app')

@section('title', 'Transaksi')

@php
    $statusColors = [
        'waiting_payment' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
        'waiting_confirmation' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
        'confirmed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        'completed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
        'expired' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
    ];
    $sc = $statusColors[$transaction->status] ?? 'bg-gray-500/10 text-gray-400';
@endphp

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    {{-- Header Card --}}
    <div class="bg-card border border-subtle rounded-xl overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-subtle">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-accent">{{ $transaction->type === 'buy' ? 'shopping_bag' : 'schedule' }}</span>
                <h1 class="text-base font-semibold text-primary">{{ $transaction->type === 'buy' ? 'Produk' : 'Rental' }}</h1>
            </div>
        </div>

        <div class="flex items-center gap-4 px-6 py-4 border-b border-subtle">
            <div class="w-14 h-11 rounded-lg overflow-hidden bg-elevated shrink-0">
                @if ($transaction->account->primaryImage)
                    <img src="{{ Storage::url($transaction->account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-primary truncate">{{ $transaction->account->title }}</p>
                <p class="text-xs text-secondary font-mono">{{ $transaction->account->game->name }}</p>
            </div>
            <span class="text-xs px-3 py-1 rounded-full font-mono font-medium border {{ $sc }}">
                {{ str_replace('_', ' ', $transaction->status) }}
            </span>
        </div>

        <div class="px-6 py-5 space-y-4">
            <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div>
                    <p class="text-xs text-secondary font-mono uppercase tracking-wider">Tipe</p>
                    <p class="text-primary font-medium mt-0.5">{{ $transaction->type === 'buy' ? 'Produk' : 'Rental' }}</p>
                </div>
                <div>
                    <p class="text-xs text-secondary font-mono uppercase tracking-wider">Tanggal</p>
                    <p class="text-primary font-medium mt-0.5">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs text-secondary font-mono uppercase tracking-wider">Total</p>
                    <p class="text-lg font-bold text-accent mt-0.5">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                </div>
                @if ($transaction->rentalPackage)
                <div>
                    <p class="text-xs text-secondary font-mono uppercase tracking-wider">Paket Sewa</p>
                    <p class="text-primary font-medium mt-0.5">{{ $transaction->rentalPackage->name }}</p>
                </div>
                @endif
                @if ($transaction->rent_end)
                <div>
                    <p class="text-xs text-secondary font-mono uppercase tracking-wider">Sewa sampai</p>
                    <p class="text-primary font-medium mt-0.5">{{ $transaction->rent_end->format('d M Y H:i') }}</p>
                </div>
                @endif
            </div>

            @if ($transaction->payment_proof)
            <div class="border-t border-subtle pt-4">
                <p class="text-xs text-secondary font-mono uppercase tracking-wider mb-3">Bukti Pembayaran</p>
                <img src="{{ Storage::url($transaction->payment_proof) }}" class="max-w-xs rounded-lg border border-subtle">
            </div>
            @endif
        </div>
    </div>

    {{-- Action Cards --}}
    <div class="space-y-4 mt-6">
        @if ($transaction->status === 'waiting_payment')
        <div class="bg-card border border-amber-500/20 rounded-xl p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-400 text-lg">hourglass_empty</span>
                    <h2 class="text-sm font-semibold text-primary">Menunggu Pembayaran</h2>
                </div>
                <span class="text-[10px] font-mono text-amber-400" data-countdown="{{ $transaction->created_at->addMinutes(5)->timestamp }}"></span>
            </div>
            <div class="bg-elevated rounded-lg p-4 space-y-2 text-sm">
                <p class="text-secondary">Transfer ke rekening berikut:</p>
                <div class="flex justify-between"><span class="text-secondary font-mono">Bank</span><span class="text-primary font-medium">BCA</span></div>
                <div class="flex justify-between"><span class="text-secondary font-mono">No. Rekening</span><span class="text-primary font-mono font-bold tracking-wider">1234567890</span></div>
                <div class="flex justify-between"><span class="text-secondary font-mono">a/n</span><span class="text-primary font-medium">Admin Versnova</span></div>
                <div class="flex justify-between pt-2 border-t border-subtle"><span class="text-secondary font-semibold">Total</span><span class="text-lg font-bold text-accent">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</span></div>
            </div>
            <form method="POST" action="{{ route('transactions.bukti', $transaction) }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <label class="block">
                    <span class="text-xs text-secondary block mb-2">Upload Bukti Transfer</span>
                    <input type="file" name="payment_proof" accept="image/*" class="block w-full text-sm text-secondary file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:bg-accent file:text-white file:font-medium hover:file:brightness-110 cursor-pointer">
                </label>
                <button type="submit" class="w-full px-5 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all text-sm">Konfirmasi Pembayaran</button>
            </form>
            <form method="POST" action="{{ route('transactions.cancel', $transaction) }}">
                @csrf
                <button type="submit" class="w-full px-5 py-2.5 border border-subtle text-secondary rounded-lg text-sm font-medium hover:border-red-400/30 hover:text-red-400 transition-all" onclick="return confirm('Yakin batalkan?')">Batalkan Pesanan</button>
            </form>
            <p class="text-xs text-secondary/60 text-center">Otomatis dibatalkan jika tidak ada bukti dalam 5 menit</p>
        </div>
        @endif

        @if ($transaction->status === 'waiting_confirmation')
        <div class="bg-card border border-blue-500/20 rounded-xl p-6 space-y-4">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-blue-400 text-lg">hourglass_top</span>
                <h2 class="text-sm font-semibold text-primary">Menunggu Konfirmasi Admin</h2>
            </div>
            <p class="text-sm text-secondary">Bukti pembayaran sudah dikirim. Admin akan segera memverifikasi.</p>
            <a href="{{ route('chat') }}" class="inline-flex items-center gap-1.5 text-sm text-accent hover:underline">
                <span class="material-symbols-outlined text-sm">chat</span> Lihat Chat
            </a>
        </div>
        @endif

        @if ($transaction->status === 'confirmed' && $transaction->type === 'buy')
        <div class="bg-card border border-emerald-500/20 rounded-xl p-6 space-y-4">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-400 text-lg">check_circle</span>
                <h2 class="text-sm font-semibold text-primary">Akun Siap Digunakan</h2>
            </div>
            <p class="text-sm text-secondary">Kredensial akun sudah dikirim oleh admin melalui chat.</p>
            <a href="{{ route('chat') }}" class="inline-flex items-center gap-1.5 text-sm text-accent hover:underline">
                <span class="material-symbols-outlined text-sm">chat</span> Buka Chat
            </a>
        </div>
        @endif

        @if ($transaction->status === 'confirmed' && $transaction->type === 'rent')
        <div class="bg-card border border-accent/30 rounded-xl p-6 space-y-5">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-accent text-lg">play_circle</span>
                <h2 class="text-sm font-semibold text-primary">Sesi Aktif</h2>
            </div>
            <div class="flex items-center justify-center gap-4 py-4">
                <span class="material-symbols-outlined text-accent text-3xl">timer</span>
                @php $dur = max(0, $transaction->rent_end->timestamp - now()->timestamp); $init = sprintf('%02d:%02d:%02d', floor($dur/3600), floor(($dur%3600)/60), $dur%60); @endphp
                <span class="text-5xl font-bold text-accent font-mono" data-countdown="{{ $transaction->rent_end->timestamp }}">{{ $init }}</span>
            </div>
            @if ($transaction->rentalPackage)
            <div class="text-center text-sm text-secondary">Paket <span class="text-primary font-medium">{{ $transaction->rentalPackage->name }}</span> &middot; {{ $transaction->rentalPackage->hours }} jam</div>
            @endif
            <p class="text-xs text-secondary/60 text-center">Waktu akan berakhir otomatis.</p>
        </div>
        @endif

        @if ($transaction->status === 'completed' && $transaction->type === 'rent')
        <div class="bg-card border border-subtle rounded-xl p-6 space-y-3">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary text-lg">check_circle</span>
                <h2 class="text-sm font-semibold text-primary">Sewa Selesai</h2>
            </div>
            <p class="text-sm text-secondary">Sesi sewa sudah berakhir. Terima kasih!</p>
        </div>
        @endif
    </div>

    {{-- Review --}}
    @if ($transaction->status === 'completed')
    @php $userReview = $transaction->review; @endphp
    <div class="mt-6 bg-card border border-subtle rounded-xl p-6">
        <h3 class="text-sm font-semibold text-primary mb-4">Beri Rating & Review</h3>
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
        <form method="POST" action="{{ route('transactions.review', $transaction) }}" class="space-y-4">
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
            <button type="submit" class="px-6 py-2.5 bg-accent text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all">Kirim Review</button>
        </form>
        @endif
    </div>
    @endif

    {{-- Back to Riwayat --}}
    <div class="mt-8 text-center">
        <a href="{{ route('riwayat') }}" class="inline-flex items-center gap-1.5 text-sm text-secondary hover:text-accent transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali ke Riwayat
        </a>
    </div>
</div>
@endsection
