@extends('layouts.app')

@section('title', 'Beli Akun')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-lg font-bold text-primary">Beli Akun</h1>
            <p class="text-sm text-secondary mt-1">{{ $accounts->total() }} akun dijual</p>
        </div>
        <div class="flex gap-1.5 overflow-x-auto no-scrollbar pb-1">
            <a href="{{ route('katalog') }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium bg-card border border-subtle text-secondary hover:border-accent hover:text-accent transition-all">Semua</a>
            <a href="{{ route('beli.index') }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium bg-accent text-white transition-all">Beli</a>
            <a href="{{ route('sewa.index') }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium bg-card border border-subtle text-secondary hover:border-accent hover:text-accent transition-all">Sewa</a>
        </div>
    </div>

    @if ($games->count())
    <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1 mb-6">
        <a href="{{ route('beli.index') }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium transition-all @if(!request('game')) bg-accent text-white @else bg-card border border-subtle text-secondary hover:border-accent hover:text-accent @endif">Semua Game</a>
        @foreach ($games as $g)
            <a href="{{ route('beli.index', ['game' => $g->slug]) }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium transition-all @if(request('game') === $g->slug) bg-accent text-white @else bg-card border border-subtle text-secondary hover:border-accent hover:text-accent @endif">{{ $g->name }}</a>
        @endforeach
    </div>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse ($accounts as $account)
            <x-account-card :account="$account" type="buy" />
        @empty
            <div class="col-span-full text-center py-20">
                <span class="material-symbols-outlined text-5xl text-secondary block mb-4">shopping_cart</span>
                <p class="text-secondary">Belum ada akun dijual.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-8">{{ $accounts->links() }}</div>
</div>
@endsection
