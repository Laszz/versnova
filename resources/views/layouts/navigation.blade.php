<nav x-data="{ open: false }" class="sticky top-0 z-50 h-20 bg-surface/60 backdrop-blur-xl border-b border-outline/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
        <div class="flex items-center gap-8">
            <a href="/" class="font-heading text-heading text-amber-500 leading-none">Versnova</a>

            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('katalog') }}" class="font-caption text-gray-400 hover:text-amber-500 transition-colors">Katalog</a>
                <a href="{{ route('flashsale') }}" class="font-caption text-gray-400 hover:text-amber-500 transition-colors">Flashsale</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button @click="toggle()" class="p-2 text-gray-400 hover:text-amber-500 transition-colors" title="Toggle theme">
                <template x-if="dark">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </template>
                <template x-if="!dark">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </template>
            </button>

            @auth
                <a href="{{ route('wishlist') }}" class="p-2 text-gray-400 hover:text-amber-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </a>

                <div class="relative" x-data="{ profileOpen: false }">
                    <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-surface-bright transition-colors">
                        <span class="font-caption text-gray-300">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="profileOpen" @click.outside="profileOpen = false" class="absolute right-0 mt-2 w-48 bg-surface border border-outline rounded-card shadow-xl py-1 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-surface-bright">Profile</a>
                        <a href="{{ route('riwayat') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-surface-bright">Riwayat</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-amber-500 hover:bg-surface-bright">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-surface-bright">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-primary text-sm py-2 px-4">Login</a>
            @endauth

            <button @click="open = !open" class="md:hidden p-2 text-gray-400">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <div x-show="open" class="md:hidden bg-surface border-b border-outline/30">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('katalog') }}" class="block font-caption text-gray-400 py-2">Katalog</a>
            <a href="{{ route('flashsale') }}" class="block font-caption text-gray-400 py-2">Flashsale</a>
        </div>
    </div>
</nav>
