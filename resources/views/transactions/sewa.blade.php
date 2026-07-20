@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
    <a href="{{ route('katalog.show', $account) }}" class="text-gray-500 hover:text-amber-500 text-sm mb-6 inline-block">&larr; Kembali</a>

    <div class="bg-surface border border-outline rounded-card p-6 space-y-6">
        <h1 class="font-heading text-heading text-gray-100">Sewa Akun</h1>

        <div class="flex gap-4 items-center pb-4 border-b border-outline/30">
            <div class="w-20 h-16 rounded overflow-hidden bg-surface-bright shrink-0">
                @if ($account->primaryImage)
                    <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <h2 class="font-heading text-xl text-gray-100">{{ $account->title }}</h2>
                <p class="text-gray-500 text-sm">{{ $account->game->name }} | Rp{{ number_format($account->price_rent, 0, ',', '.') }}/jam</p>
            </div>
        </div>

        <form method="POST" action="{{ route('transactions.sewa', $account) }}">
            @csrf

            <div class="space-y-3">
                <p class="font-caption text-label text-gray-500 uppercase">Pilih Paket Sewa</p>

                @foreach ($packages as $p)
                <label class="flex items-center justify-between p-4 rounded-card border border-outline hover:border-amber-500/30 cursor-pointer transition-colors has-[:checked]:border-amber-500 has-[:checked]:bg-amber-500/5">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="rental_package_id" value="{{ $p->id }}" class="text-amber-500 focus:ring-amber-500/50" @if($loop->first) checked @endif required>
                        <div>
                            <p class="text-gray-200 font-semibold">{{ $p->name }}</p>
                            @if ($p->open_time)
                                <p class="text-gray-500 text-xs">{{ date('H:i', strtotime($p->open_time)) }} - {{ date('H:i', strtotime($p->close_time)) }} WIB</p>
                            @endif
                        </div>
                    </div>
                    <span class="font-heading text-lg text-amber-500">Rp{{ number_format($p->price, 0, ',', '.') }}</span>
                </label>
                @endforeach
            </div>

            <button type="submit" class="btn-primary w-full text-center mt-6">Sewa Sekarang</button>
        </form>
    </div>
</div>
@endsection
