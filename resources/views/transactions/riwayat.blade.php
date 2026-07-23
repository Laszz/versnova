@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <h1 class="text-lg font-bold text-primary mb-8">Riwayat Transaksi</h1>

    @if ($transactions->count())
    <div class="space-y-3">
        @foreach ($transactions as $t)
        <a href="{{ route('transactions.show', $t) }}" class="block bg-card border border-subtle rounded-xl p-4 hover:border-accent transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-10 rounded-lg overflow-hidden bg-elevated shrink-0">
                        @if ($t->account->primaryImage)
                            <img src="{{ Storage::url($t->account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-primary">{{ $t->account->title }}</p>
                        <p class="text-xs text-secondary font-mono">{{ $t->type === 'buy' ? 'Beli' : 'Sewa' }} | {{ $t->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-accent">Rp{{ number_format($t->total_price, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-secondary font-mono uppercase">{{ str_replace('_', ' ', $t->status) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $transactions->links() }}</div>
    @else
    <div class="text-center py-20">
        <span class="material-symbols-outlined text-5xl text-secondary block mb-4">receipt_long</span>
        <p class="text-secondary">Belum ada transaksi.</p>
        <a href="{{ route('produk.index') }}" class="text-sm text-accent hover:underline mt-2 inline-block">Cari akun</a>
    </div>
    @endif
</div>
@endsection










