@props(['account'])

<div class="nova-card group flex flex-col">
    <div class="relative aspect-[4/3] overflow-hidden">
        @if ($account->primaryImage)
            <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="{{ $account->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-surface-bright flex items-center justify-center text-gray-600">
                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif

        <div class="absolute top-2 left-2 flex flex-col gap-1.5">
            <span class="badge-game">{{ $account->game->name }}</span>
            @if ($account->discount_percent)
                <span class="badge-flash">-{{ $account->discount_percent }}%</span>
            @endif
        </div>

        @if ($account->status !== 'available')
            <div class="absolute inset-0 bg-surface/80 backdrop-blur-[1px] flex items-center justify-center">
                <span class="badge-sold text-lg uppercase">
                    {{ $account->status === 'sold' ? 'Terjual' : ($account->status === 'rented' ? 'Tersewa' : 'Reserved') }}
                </span>
            </div>
        @endif
    </div>

    <div class="p-4 flex flex-col flex-1 gap-3">
        <div>
            <h3 class="font-heading text-xl text-gray-100 leading-tight">{{ $account->title }}</h3>
            @if ($account->level)
                <p class="text-gray-500 text-sm font-caption mt-0.5">Level {{ $account->level }}</p>
            @endif
        </div>

        @if ($account->skin_info)
            <p class="text-gray-500 text-xs line-clamp-2">{{ $account->skin_info }}</p>
        @endif

        <div class="flex items-end justify-between mt-auto">
            <div>
                @if ($account->discount_price)
                    <span class="text-gray-500 line-through text-sm">Rp{{ number_format($account->price_sell ?? $account->price_rent, 0, ',', '.') }}</span>
                    <span class="font-heading text-heading text-amber-500 block leading-none">Rp{{ number_format($account->discount_price, 0, ',', '.') }}</span>
                @elseif ($account->price_sell)
                    <span class="font-heading text-heading text-amber-500">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</span>
                @elseif ($account->price_rent)
                    <span class="font-heading text-xl text-amber-500">Rp{{ number_format($account->price_rent, 0, ',', '.') }}</span>
                    <span class="text-gray-500 text-xs">/jam</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2">
            @if ($account->price_sell)
                <a href="{{ route('transactions.beli', $account) }}" class="btn-primary text-sm text-center py-2.5">Beli</a>
            @endif
            @if ($account->price_rent)
                <a href="{{ route('katalog.show', $account) }}" class="btn-ghost text-sm text-center py-2.5">Sewa</a>
            @endif
        </div>
    </div>
</div>
