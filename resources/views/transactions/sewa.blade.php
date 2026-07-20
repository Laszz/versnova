@extends('layouts.app')

@section('title', 'Sewa Akun')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <a href="{{ route('katalog.show', $account) }}" class="inline-flex items-center gap-1 text-sm text-secondary hover:text-accent mb-6 transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali
    </a>

    <div class="bg-card border border-subtle rounded-xl p-6 space-y-6">
        <h1 class="text-lg font-bold text-primary">Sewa Akun</h1>

        <div class="flex gap-4 items-center pb-4 border-b border-subtle">
            <div class="w-20 h-16 rounded-lg overflow-hidden bg-elevated shrink-0">
                @if ($account->primaryImage)
                    <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <h2 class="text-base font-semibold text-primary">{{ $account->title }}</h2>
                <p class="text-sm text-secondary font-mono">{{ $account->game->name }} | Rp{{ number_format($account->price_rent, 0, ',', '.') }}/jam</p>
            </div>
        </div>

        <form method="POST" action="{{ route('transactions.sewa', $account) }}">
            @csrf
            <div class="space-y-3">
                <p class="text-xs font-mono text-secondary uppercase tracking-wider mb-3">Pilih Paket Sewa</p>

                @foreach ($packages as $p)
                <label class="flex items-center justify-between p-4 rounded-xl border border-subtle hover:border-accent cursor-pointer transition-colors has-[:checked]:border-accent has-[:checked]:bg-[#ff5357]/5">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="rental_package_id" value="{{ $p->id }}" class="text-accent focus:ring-[#ff5357]/50" @if($loop->first) checked @endif required>
                        <div>
                            <p class="text-sm font-medium text-primary">{{ $p->name }}</p>
                            @if ($p->open_time)
                                <p class="text-xs text-secondary font-mono">{{ date('H:i', strtotime($p->open_time)) }} - {{ date('H:i', strtotime($p->close_time)) }} WIB</p>
                            @endif
                        </div>
                    </div>
                    <span class="text-base font-bold text-accent">Rp{{ number_format($p->price, 0, ',', '.') }}</span>
                </label>
                @endforeach
            </div>

            <button type="submit" class="w-full text-center mt-6 px-5 py-3 bg-accent text-white rounded-lg font-medium hover:brightness-110 transition-all">Sewa Sekarang</button>
        </form>
    </div>
</div>
@endsection






