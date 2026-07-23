<nav x-data="{ mobileMenu: false }" class="sticky top-0 z-50 h-16 bg-card/80 backdrop-blur-xl border-b border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
        <a href="/" class="font-bold tracking-tight shrink-0" style="font-family: 'Space Mono', monospace; font-size: 18px; color: #ffb3af;">Versnova</a>

        <div class="hidden md:flex items-center gap-6 absolute left-1/2 -translate-x-1/2">
            <a href="{{ route('produk.index') }}" class="text-sm text-secondary hover:text-accent transition-colors">Produk</a>
            <a href="{{ route('sewa.index') }}" class="text-sm text-secondary hover:text-accent transition-colors">Sewa</a>
            <a href="{{ route('flashsale') }}" class="text-sm text-secondary hover:text-accent transition-colors">Flashsale</a>
        </div>

        <div class="flex items-center gap-2">
            <button id="themeToggle" class="p-2 text-secondary hover:text-accent transition-colors rounded-lg hover:bg-hover" title="Toggle theme">
                <svg id="moonIcon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                </svg>
                <svg id="sunIcon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                </svg>
                <script>(function(){var s=localStorage.getItem('versnova-theme');var d=s==='dark'||(!s&&document.documentElement.classList.contains('dark'));if(!d){document.getElementById('moonIcon').classList.add('hidden');document.getElementById('sunIcon').classList.remove('hidden')}})();</script>
            </button>

            @auth
                @php
                    $activeRent = Auth::user()->transactions()
                        ->where('type', 'rent')
                        ->where('status', 'confirmed')
                        ->whereNotNull('rent_end')
                        ->where('rent_end', '>', now())
                        ->with('rentalPackage')
                        ->first();
                @endphp
                @if ($activeRent)
                <a href="{{ route('transactions.show', $activeRent) }}" class="p-2 text-accent hover:text-accent transition-colors rounded-lg hover:bg-hover relative flex items-center gap-1.5" title="Sisa waktu sewa">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @php $dur = max(0, $activeRent->rent_end->timestamp - now()->timestamp); $init = sprintf('%02d:%02d:%02d', floor($dur/3600), floor(($dur%3600)/60), $dur%60); @endphp
                    <span class="text-xs font-mono font-bold" data-countdown="{{ $activeRent->rent_end->timestamp }}">{{ $init }}</span>
                </a>
                @endif
                <a href="{{ route('chat') }}" class="p-2 text-secondary hover:text-accent transition-colors rounded-lg hover:bg-hover relative" title="Chat">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                    </svg>
                    @php $unreadChat = Auth::user()->receivedMessages()->where('is_read', false)->count(); @endphp
                    @if ($unreadChat > 0)
                        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-accent text-white text-[9px] font-bold rounded-full flex items-center justify-center">{{ $unreadChat > 9 ? '9+' : $unreadChat }}</span>
                    @endif
                </a>
                <a href="{{ route('wishlist') }}" class="p-2 text-secondary hover:text-accent transition-colors rounded-lg hover:bg-hover" title="Wishlist">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                    </svg>
                </a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open; $event.stopPropagation()" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-hover transition-colors text-sm text-secondary">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-card border border-default rounded-xl shadow-2xl py-1 z-50" style="backdrop-filter: blur(20px);">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-secondary hover:text-primary hover:bg-hover transition-colors" onclick="this.closest('[x-data]').__x.$data.open = false">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            Profile
                        </a>
                        <a href="{{ route('riwayat') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-secondary hover:text-primary hover:bg-hover transition-colors" onclick="this.closest('[x-data]').__x.$data.open = false">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Riwayat
                        </a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-accent hover:bg-hover transition-colors" onclick="this.closest('[x-data]').__x.$data.open = false">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                Admin Panel
                            </a>
                        @endif
                        <div class="border-t border-subtle mt-1 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-secondary hover:text-red-400 hover:bg-hover transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-primary text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 12px rgba(255,83,87,0.3);">Login</a>
            @endauth

            <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 text-secondary hover:text-accent transition-colors">
                <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                <svg x-show="mobileMenu" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak class="md:hidden bg-card border-b border-subtle">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('produk.index') }}" class="block text-sm text-secondary hover:text-accent py-2 transition-colors">Produk</a>
            <a href="{{ route('sewa.index') }}" class="block text-sm text-secondary hover:text-accent py-2 transition-colors">Sewa</a>
            <a href="{{ route('flashsale') }}" class="block text-sm text-secondary hover:text-accent py-2 transition-colors">Flashsale</a>
        </div>
    </div>
</nav>





