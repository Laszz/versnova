<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="font-caption text-label text-gray-400 uppercase mb-1 block">Nama</label>
            <input id="name" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="email" class="font-caption text-label text-gray-400 uppercase mb-1 block">Email</label>
            <input id="email" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="font-caption text-label text-gray-400 uppercase mb-1 block">Password</label>
            <input id="password" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-colors" type="password" name="password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="font-caption text-label text-gray-400 uppercase mb-1 block">Konfirmasi Password</label>
            <input id="password_confirmation" class="w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-colors" type="password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full btn-primary mt-6">Daftar</button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-amber-500 hover:text-amber-400 transition-colors">Login</a>
    </p>
</x-guest-layout>
