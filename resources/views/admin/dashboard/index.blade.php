@extends('layouts.admin')

@section('title', 'System Overview')

@section('content')
{{-- Welcome --}}
<div class="flex items-end justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold tracking-tight text-[#e5e2e1]" style="font-family: 'Geist', sans-serif;">System Overview</h2>
        <p class="text-sm text-[#b7b5b4] mt-1">Real-time status of the Versnova architecture.</p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @php
        $stats = [
            ['label' => 'Total Akun', 'value' => \App\Models\Account::count(), 'pct' => '+0%', 'icon' => 'inventory_2', 'bar' => 100],
            ['label' => 'Tersedia', 'value' => \App\Models\Account::where('status', 'available')->count(), 'pct' => '', 'icon' => 'check_circle', 'bar' => 65],
            ['label' => 'Transaksi Bulan Ini', 'value' => \App\Models\Transaction::whereMonth('created_at', now()->month)->where('status', 'completed')->count(), 'pct' => '', 'icon' => 'payments', 'bar' => 45],
            ['label' => 'Total User', 'value' => \App\Models\User::count(), 'pct' => '', 'icon' => 'group', 'bar' => 80],
        ];
    @endphp

    @foreach ($stats as $s)
    <div class="glass-panel rounded-xl p-6 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-[#ff5357]/5 rounded-full blur-3xl group-hover:bg-[#ff5357]/10 transition-all"></div>
        <div class="flex items-center justify-between mb-4 relative">
            <span class="material-symbols-outlined text-[#ff5357] text-[26px]" style="font-variation-settings: 'FILL' 1;">{{ $s['icon'] }}</span>
            @if ($s['pct'])
                <span class="text-[11px] text-[#ffb3af] font-mono px-2 py-0.5 rounded bg-[#ff5357]/10">{{ $s['pct'] }}</span>
            @endif
        </div>
        <p class="text-3xl font-bold tracking-tight text-[#e5e2e1]">{{ $s['value'] }}</p>
        <p class="text-[11px] text-[#b7b5b4] font-mono uppercase tracking-widest mt-1">{{ $s['label'] }}</p>
        <div class="mt-4 w-full h-1 bg-white/5 rounded-full overflow-hidden">
            <div class="h-full rounded-full bg-[#ff5357]" style="width: {{ $s['bar'] }}%; box-shadow: 0 0 8px rgba(255,83,87,0.5);"></div>
        </div>
    </div>
    @endforeach
</div>

{{-- Bottom Row --}}
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <div class="glass-panel rounded-xl p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-sm font-semibold text-[#e5e2e1]">Transaksi Terbaru</h3>
            <a href="{{ route('admin.transactions.index') }}" class="text-xs text-[#ffb3af] hover:underline font-mono uppercase tracking-wider">View All</a>
        </div>
        @php $recent = \App\Models\Transaction::with('account', 'user')->latest()->take(5)->get(); @endphp
        @if ($recent->count())
        <div class="space-y-3">
            @foreach ($recent as $t)
            <div class="flex items-center justify-between py-2.5 border-b border-white/5 last:border-0">
                <div>
                    <p class="text-sm text-[#e5e2e1] font-medium">{{ Str::limit($t->account->title, 30) }}</p>
                    <p class="text-xs text-[#b7b5b4] mt-0.5 font-mono">{{ $t->user->name }} &middot; {{ $t->created_at->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-[#e5e2e1]">Rp{{ number_format($t->total_price, 0, ',', '.') }}</p>
                    <span class="text-[10px] font-mono uppercase text-[#b7b5b4]/60">{{ $t->status }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-[#b7b5b4] text-sm py-8 text-center">Belum ada transaksi.</p>
        @endif
    </div>

    <div class="glass-panel rounded-xl p-6">
        <h3 class="text-sm font-semibold text-[#e5e2e1] mb-5">Pendapatan</h3>
        @php
            $daily = \App\Models\Transaction::whereDate('created_at', today())->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
            $monthly = \App\Models\Transaction::whereMonth('created_at', now()->month)->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
            $yearly = \App\Models\Transaction::whereYear('created_at', now()->year)->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        @endphp
        <div class="space-y-4">
            <div class="flex justify-between py-3 border-b border-white/5">
                <span class="text-sm text-[#b7b5b4]">Daily Revenue</span>
                <span class="text-sm font-semibold text-[#e5e2e1]">Rp{{ number_format($daily, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-3 border-b border-white/5">
                <span class="text-sm text-[#b7b5b4]">Monthly Revenue</span>
                <span class="text-sm font-semibold text-[#e5e2e1]">Rp{{ number_format($monthly, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-3">
                <span class="text-sm text-[#b7b5b4]">Yearly Revenue</span>
                <span class="text-sm font-semibold text-[#e5e2e1]">Rp{{ number_format($yearly, 0, ',', '.') }}</span>
            </div>
        </div>
        <a href="{{ route('admin.laporan') }}" class="mt-5 text-xs text-[#ffb3af] hover:underline font-mono uppercase tracking-wider inline-block">View Reports</a>
    </div>
</div>
@endsection


