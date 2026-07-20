<footer class="bg-surface/50 border-t border-outline/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-section-mobile md:py-section">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-1">
                <a href="/" class="font-heading text-heading text-amber-500">Versnova</a>
                <p class="text-gray-500 mt-2 text-sm max-w-xs">
                    Platform jual beli dan sewa akun game terpercaya. Aman, cepat, dan mudah.
                </p>
            </div>

            <div>
                <h4 class="font-caption text-label text-gray-400 uppercase mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('katalog') }}" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Katalog</a></li>
                    <li><a href="{{ route('flashsale') }}" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Flashsale</a></li>
                    @auth
                        <li><a href="{{ route('wishlist') }}" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Wishlist</a></li>
                    @endauth
                </ul>
            </div>

            <div>
                <h4 class="font-caption text-label text-gray-400 uppercase mb-4">Bantuan</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Cara Beli</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Cara Sewa</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-caption text-label text-gray-400 uppercase mb-4">Kontak</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('chat') }}" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">Live Chat</a></li>
                    <li><a href="mailto:support@versnova.id" class="text-gray-500 hover:text-amber-500 transition-colors text-sm">support@versnova.id</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-outline/30 mt-8 pt-6 text-center">
            <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} Versnova. All rights reserved.</p>
        </div>
    </div>
</footer>
