@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <div class="flex flex-col md:flex-row gap-8">
        {{-- Sidebar Filter --}}
        <aside class="w-full md:w-60 shrink-0">
            <div class="bg-surface border border-outline rounded-card p-5 space-y-5 sticky top-24">
                <h3 class="font-heading text-lg text-gray-200">Filter</h3>

                <div>
                    <label class="font-caption text-label text-gray-500 uppercase mb-2 block">Game</label>
                    <div class="space-y-1.5">
                        <a href="{{ route('katalog') }}" class="block text-sm @if(!request()->route('game')) text-amber-500 @else text-gray-400 hover:text-amber-500 @endif transition-colors">Semua</a>
                        @foreach ($games as $g)
                            <a href="{{ route('katalog.game', $g) }}" class="block text-sm @if(isset($game) && $game->id === $g->id) text-amber-500 @else text-gray-400 hover:text-amber-500 @endif transition-colors">{{ $g->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        {{-- Grid --}}
        <div class="flex-1">
            <div class="flex items-center justify-between mb-6">
                <h1 class="font-heading text-heading text-gray-100">
                    @if(isset($game))
                        {{ $game->name }}
                    @else
                        Katalog
                    @endif
                </h1>
                <span class="text-gray-500 text-sm">{{ $accounts->total() }} akun</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse ($accounts as $account)
                    <x-account-card :account="$account" />
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-gray-500">Belum ada akun untuk game ini.</p>
                        <a href="{{ route('katalog') }}" class="text-amber-500 text-sm hover:underline mt-2 inline-block">Lihat semua akun</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
