@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <div class="bg-gradient-to-br from-amber-500/10 via-surface to-indigo-500/10 border border-amber-500/10 rounded-card p-8 mb-8 text-center">
        <span class="badge-flash text-sm inline-block mb-3">Flash Sale</span>
        <h1 class="font-heading text-display-mobile md:text-display text-gray-100">Promo Terbatas</h1>
        <p class="text-gray-400 mt-2 max-w-lg mx-auto">Diskon besar-besaran untuk akun-akun pilihan. Jangan sampai kehabisan.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($flashsale as $account)
            <x-account-card :account="$account" />
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500">Belum ada flashsale aktif.</p>
                <a href="{{ route('katalog') }}" class="text-amber-500 hover:underline text-sm mt-2 inline-block">Lihat katalog</a>
            </div>
        @endforelse
    </div>

    <div class="mt-6">{{ $flashsale->links() }}</div>
</div>
@endsection
