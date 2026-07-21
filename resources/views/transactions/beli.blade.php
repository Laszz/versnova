@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    {{-- Step 1: Choose Payment Method --}}
    <div x-data="{ step: 'method', method: null, agree: false, paid: false }">
        <div class="bg-card border border-subtle rounded-xl p-6 space-y-6">
            {{-- Product Info --}}
            <div class="flex gap-4 items-center pb-4 border-b border-subtle">
                <div class="w-20 h-16 rounded-lg overflow-hidden bg-elevated shrink-0">
                    @if ($account->primaryImage)
                        <img src="{{ Storage::url($account->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <h1 class="text-base font-semibold text-primary">{{ $account->title }}</h1>
                    <p class="text-sm text-secondary font-mono">{{ $account->game->name }} | Level {{ $account->level }}</p>
                </div>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-secondary">Harga</span>
                    <span class="text-primary">Rp{{ number_format($account->price_sell, 0, ',', '.') }}</span>
                </div>
                @if ($account->discount_percent)
                <div class="flex justify-between">
                    <span class="text-secondary">Diskon</span>
                    <span class="text-accent">-{{ $account->discount_percent }}%</span>
                </div>
                @endif
                <div class="flex justify-between text-base pt-3 border-t border-subtle">
                    <span class="text-primary font-semibold">Total</span>
                    <span class="text-lg font-bold text-accent">Rp{{ number_format($account->discount_price ?? $account->price_sell, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Step: Choose Method --}}
            <div x-show="step === 'method'" class="space-y-4">
                <p class="text-sm font-semibold text-primary">Pilih Metode Pembayaran</p>
                <div class="space-y-2">
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-subtle hover:border-accent/30 cursor-pointer transition-colors has-[:checked]:border-accent has-[:checked]:bg-accent/5" @click="method = 'qris'">
                        <input type="radio" name="payment_method" value="qris" class="text-accent focus:ring-accent/50">
                        <div class="flex items-center gap-3 flex-1">
                            <div class="w-10 h-10 rounded-lg bg-elevated flex items-center justify-center text-accent">
                                <span class="material-symbols-outlined text-lg">qr_code_scanner</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-primary">QRIS</p>
                                <p class="text-xs text-secondary">Scan QR via GoPay, OVO, DANA, dll</p>
                            </div>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-subtle hover:border-accent/30 cursor-pointer transition-colors has-[:checked]:border-accent has-[:checked]:bg-accent/5" @click="method = 'va'">
                        <input type="radio" name="payment_method" value="va" class="text-accent focus:ring-accent/50">
                        <div class="flex items-center gap-3 flex-1">
                            <div class="w-10 h-10 rounded-lg bg-elevated flex items-center justify-center text-accent">
                                <span class="material-symbols-outlined text-lg">account_balance</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-primary">Virtual Account</p>
                                <p class="text-xs text-secondary">Transfer via BCA, Mandiri, BRI, BNI</p>
                            </div>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-subtle hover:border-accent/30 cursor-pointer transition-colors has-[:checked]:border-accent has-[:checked]:bg-accent/5" @click="method = 'ewallet'">
                        <input type="radio" name="payment_method" value="ewallet" class="text-accent focus:ring-accent/50">
                        <div class="flex items-center gap-3 flex-1">
                            <div class="w-10 h-10 rounded-lg bg-elevated flex items-center justify-center text-accent">
                                <span class="material-symbols-outlined text-lg">wallet</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-primary">E-Wallet</p>
                                <p class="text-xs text-secondary">GoPay, OVO, DANA, LinkAja</p>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="bg-card border border-subtle rounded-lg p-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" x-model="agree" class="mt-0.5 text-accent focus:ring-accent/50 rounded">
                        <div>
                            <p class="text-sm text-secondary">Saya menyetujui <a href="{{ route('kebijakan.privasi') }}" class="text-accent hover:underline" target="_blank">Syarat & Ketentuan</a> dan <a href="{{ route('kebijakan.privasi') }}" class="text-accent hover:underline" target="_blank">Kebijakan Privasi</a></p>
                        </div>
                    </label>
                </div>

                <button @click="if(method && agree) step = 'confirm'" :disabled="!method || !agree" class="w-full px-5 py-3 rounded-lg text-sm font-medium transition-all bg-elevated text-secondary" :class="method && agree ? 'bg-accent text-white hover:brightness-110' : ''">
                    Lanjut ke Pembayaran
                </button>
            </div>

            {{-- Step 2: Payment Confirmation --}}
            <div x-show="step === 'confirm'" class="space-y-5">
                <div class="flex items-center gap-2 text-sm font-semibold text-primary">
                    <span class="material-symbols-outlined text-accent text-lg">check_circle</span>
                    Konfirmasi Pembayaran
                </div>

                <div class="bg-card border border-subtle rounded-xl p-5 space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-secondary">Metode</span>
                        <span class="text-primary font-medium" x-text="method === 'qris' ? 'QRIS' : method === 'va' ? 'Virtual Account' : 'E-Wallet'"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-secondary">Total</span>
                        <span class="text-accent font-bold text-lg">Rp{{ number_format($account->discount_price ?? $account->price_sell, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-secondary">Pembeli</span>
                        <span class="text-primary font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-secondary">Invoice</span>
                        <span class="text-primary font-mono text-xs">GV-{{ now()->format('Ymd') }}-{{ str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                {{-- QRIS --}}
                <div x-show="method === 'qris'" class="bg-card border border-subtle rounded-xl p-6 text-center space-y-4">
                    <p class="text-sm font-semibold text-primary">Scan QRIS untuk Membayar</p>
                    <div class="w-48 h-48 mx-auto bg-elevated rounded-xl flex items-center justify-center border border-subtle">
                        <span class="material-symbols-outlined text-6xl text-secondary/40">qr_code_scanner</span>
                    </div>
                    <p class="text-xs text-secondary">Scan menggunakan GoPay, OVO, DANA, atau aplikasi perbankan yang mendukung QRIS.</p>
                </div>

                {{-- Virtual Account --}}
                <div x-show="method === 'va'" class="bg-card border border-subtle rounded-xl p-5 space-y-3">
                    <p class="text-sm font-semibold text-primary">Transfer ke Virtual Account</p>
                    <div class="bg-elevated rounded-lg p-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-secondary">Bank</span>
                            <span class="text-primary font-medium">BCA</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-secondary">VA Number</span>
                            <span class="text-primary font-mono font-bold tracking-wider" id="vaNumber">8810 {{ sprintf('%04d', rand(1000,9999)) }} {{ sprintf('%04d', rand(1000,9999)) }} {{ sprintf('%04d', rand(1000,9999)) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-secondary">Total</span>
                            <span class="text-accent font-bold">Rp{{ number_format($account->discount_price ?? $account->price_sell, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- E-Wallet --}}
                <div x-show="method === 'ewallet'" class="bg-card border border-subtle rounded-xl p-5 space-y-3">
                    <p class="text-sm font-semibold text-primary">Transfer ke E-Wallet</p>
                    <div class="bg-elevated rounded-lg p-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-secondary">GoPay</span>
                            <span class="text-primary font-mono font-bold tracking-wider">0812-3456-7890</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-secondary">a/n</span>
                            <span class="text-primary font-medium">Admin Versnova</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-secondary">Total</span>
                            <span class="text-accent font-bold">Rp{{ number_format($account->discount_price ?? $account->price_sell, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('transactions.beli', $account) }}">
                    @csrf
                    <button type="submit" class="w-full px-5 py-3 bg-accent text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 15px rgba(255,83,87,0.25);">
                        Saya Sudah Bayar
                    </button>
                </form>

                <p class="text-xs text-secondary text-center">Setelah membayar, klik "Saya Sudah Bayar" untuk upload bukti transfer.</p>
            </div>
        </div>

        <a href="{{ route('akun.show', $account) }}" class="inline-flex items-center gap-1 text-sm text-secondary hover:text-accent mt-6 transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali
        </a>
    </div>
</div>
@endsection
