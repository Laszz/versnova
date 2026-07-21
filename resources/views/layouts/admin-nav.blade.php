@php
    $routes = [
        ['name' => 'admin.dashboard', 'label' => 'Overview', 'icon' => 'dashboard'],
        ['name' => 'admin.accounts.index', 'label' => 'Inventory', 'icon' => 'inventory_2'],
        ['name' => 'admin.transactions.index', 'label' => 'Transactions', 'icon' => 'payments'],
        ['name' => 'admin.games.index', 'label' => 'Games', 'icon' => 'stadia_controller'],
        ['name' => 'admin.users', 'label' => 'Users', 'icon' => 'group'],
        ['name' => 'admin.rental-packages.index', 'label' => 'Rental', 'icon' => 'schedule'],
        ['name' => 'admin.reviews', 'label' => 'Reviews', 'icon' => 'star'],
        ['name' => 'admin.chat', 'label' => 'Support', 'icon' => 'contact_support'],
        ['name' => 'admin.laporan', 'label' => 'Reports', 'icon' => 'assessment'],
    ];
@endphp

<aside class="fixed left-0 top-0 h-full w-64 z-40 glass-sidebar flex flex-col py-8 -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="px-6 mb-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#ff5357] rounded-lg flex items-center justify-center" style="box-shadow: 0 0 15px rgba(255,83,87,0.4);">
                <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">stadia_controller</span>
            </div>
            <div>
                <h2 class="font-heading" style="font-family: 'Space Mono', monospace; font-size: 16px; font-weight: 700; color: #ffb3af;">Versnova</h2>
                <p class="text-[10px] text-[#ffb3af]/60 uppercase tracking-widest" style="font-family: 'Space Mono', monospace;">Global Controller</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-1 px-3">
        @foreach ($routes as $r)
            @if (Route::has($r['name']))
                @php $active = request()->routeIs($r['name'] . '*') @endphp
                <a href="{{ route($r['name']) }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200
                   @if ($active) bg-[#ff5357]/10 text-[#ffb3af] font-semibold border-r-2 border-[#ff5357] @else text-[#b7b5b4] hover:text-[#e5e2e1] hover:bg-white/5 @endif">
                    <span class="material-symbols-outlined text-[20px] @if($active) text-[#ffb3af] @else text-[#474746] @endif">{{ $r['icon'] }}</span>
                    {{ $r['label'] }}
                </a>
            @endif
        @endforeach
    </nav>

    <div class="px-6 mt-auto pt-6 border-t border-white/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 text-sm text-[#b7b5b4] hover:text-[#ffb3af] px-2 py-2 transition-colors w-full rounded-lg hover:bg-white/5">
                <span class="material-symbols-outlined text-[20px] text-[#474746]">logout</span>
                Logout
            </button>
        </form>
    </div>
</aside>

