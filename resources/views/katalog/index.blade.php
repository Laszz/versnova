@extends('layouts.app')

@section('title', 'Katalog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    {{-- Header + Filter --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-lg font-bold text-primary">@if(isset($game)) {{ $game->name }} @else Katalog @endif</h1>
            <p class="text-sm text-secondary mt-1">{{ $accounts->total() }} akun tersedia</p>
        </div>

        <div class="flex gap-1.5 overflow-x-auto no-scrollbar pb-1">
            <a href="{{ route('katalog') }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium transition-all @if(!request()->route('game')) bg-accent text-white @else bg-card border border-subtle text-secondary hover:border-accent hover:text-accent @endif">Semua</a>
            @foreach ($games as $g)
                <a href="{{ route('katalog.game', $g) }}" class="whitespace-nowrap px-3.5 py-1.5 rounded-lg text-xs font-medium transition-all @if(isset($game) && $game->id === $g->id) bg-accent text-white @else bg-card border border-subtle text-secondary hover:border-accent hover:text-accent @endif">{{ $g->name }}</a>
            @endforeach
        </div>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse ($accounts as $account)
            <x-account-card :account="$account" />
        @empty
            <div class="col-span-full text-center py-20">
                <span class="material-symbols-outlined text-5xl text-secondary block mb-4">search_off</span>
                <p class="text-secondary">Belum ada akun untuk game ini.</p>
                <a href="{{ route('katalog') }}" class="text-sm text-accent hover:underline mt-2 inline-block">Lihat semua akun</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $accounts->links() }}</div>
</div>
@endsection





