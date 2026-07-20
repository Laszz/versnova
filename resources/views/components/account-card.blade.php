@props(['account'])

<div class="bg-card border border-subtle rounded-xl overflow-hidden group hover:border-accent transition-all duration-300 flex flex-col" style="backdrop-filter: blur(12px);">
    <div class="relative aspect-[4/3] overflow-hidden">
        @if ($account->primaryImage)
            <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="{{ $account->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-elevated flex items-center justify-center">
                <span class="material-symbols-outlined text-secondary text-3xl">inventory_2</span>
            </div>
        @endif

        <div class="absolute top-2 left-2 flex flex-col gap-1.5">
            <span class="px-2.5 py-0.5 rounded text-[10px] font-mono uppercase tracking-wider bg-elevated/80 text-secondary border border-subtle">{{ $account->game->name }}</span>
            @if ($account->discount_percent)
                <span class="px-2.5 py-0.5 rounded text-[10px] font-mono uppercase tracking-wider bg-accent text-white" style="box-shadow: 0 0 8px rgba(255,83,87,0.3);">-{{ $account->discount_percent }}%</span>
            @endif
        </div>

        @if ($account->status !== 'available')
            <div class="absolute inset-0 /80 flex items-center justify-center">
                <span class="text-sm font-mono uppercase tracking-wider text-secondary">
                    {{ $account->status === 'sold' ? 'Terjual' : ($account->status === 'rented' ? 'Tersewa' : 'Reserved') }}
                </span>
            </div>
        @endif
    </div>

    <div class="p-4 flex flex-col flex-1 gap-3">
        <div>
            <h3 class="text-base font-semibold text-primary leading-tight">{{ $account->title }}</h3>
            @if ($account->level)
                <p class="text-xs text-secondary mt-0.5 font-mono">Level {{ $account->level }}</p>
            @endif
        </div>

        @if ($account->skin_info)
            <p class="text-xs text-secondary line-clamp-2">{{ $account->skin_info }}</p>
        @endif

        <div class="flex items-end justify-between mt-auto">
            <div>
                @if ($account->discount_price)
                    <span class="text-xs text-secondary line-through">Rp{{ number_format($account->price_sell ?? $account->price_rent, 0, ',', '.') }}</span>
                    <p class="text-lg font-bold text-accent leading-none">Rp{{ number_format($account->discount_price, 0, ',', '.') }}</p>
                @elseif ($account->price_sell)
                    <p class="text-lg font-bold text-accent">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</p>
                @elseif ($account->price_rent)
                    <p class="text-lg font-bold text-accent">Rp{{ number_format($account->price_rent, 0, ',', '.') }}</p>
                    <span class="text-xs text-secondary">/jam</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2">
            @if ($account->price_sell)
                <a href="{{ route('transactions.beli', $account) }}" class="px-3 py-2 bg-accent text-white rounded-lg text-xs font-medium text-center hover:brightness-110 transition-all" style="box-shadow: 0 0 10px rgba(255,83,87,0.2);">Beli</a>
            @endif
            @if ($account->price_rent)
                <a href="{{ route('katalog.show', $account) }}" class="px-3 py-2 border border-default text-secondary rounded-lg text-xs font-medium text-center hover:border-accent hover:text-accent transition-all">Sewa</a>
            @endif
        </div>
    </div>
</div>



