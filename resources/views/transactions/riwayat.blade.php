@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <h1 class="font-heading text-heading text-gray-100 mb-8">Riwayat Transaksi</h1>

    @if ($transactions->count())
    <div class="space-y-3">
        @foreach ($transactions as $t)
        <a href="{{ route('transactions.show', $t) }}" class="block bg-surface border border-outline rounded-card p-4 hover:border-amber-500/30 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-10 rounded overflow-hidden bg-surface-bright shrink-0">
                        @if ($t->account->primaryImage)
                            <img src="{{ Storage::url($t->account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-200 font-semibold">{{ $t->account->title }}</p>
                        <p class="text-gray-500 text-xs">{{ $t->type === 'buy' ? 'Beli' : 'Sewa' }} | {{ $t->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-300">Rp{{ number_format($t->total_price, 0, ',', '.') }}</span>
                    <p class="text-xs capitalize text-gray-500">{{ str_replace('_', ' ', $t->status) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $transactions->links() }}</div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500">Belum ada transaksi.</p>
        <a href="{{ route('katalog') }}" class="text-amber-500 hover:underline text-sm mt-2 inline-block">Cari akun</a>
    </div>
    @endif
</div>
@endsection
