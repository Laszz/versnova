@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="glass-panel rounded-xl p-6">
        <p class="text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest mb-2">Daily Revenue</p>
        <p class="text-3xl font-bold text-[#e5e2e1]">Rp{{ number_format($daily, 0, ',', '.') }}</p>
    </div>
    <div class="glass-panel rounded-xl p-6">
        <p class="text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest mb-2">Monthly Revenue</p>
        <p class="text-3xl font-bold text-[#e5e2e1]">Rp{{ number_format($monthly, 0, ',', '.') }}</p>
    </div>
    <div class="glass-panel rounded-xl p-6">
        <p class="text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest mb-2">Total Revenue</p>
        <p class="text-3xl font-bold text-[#e5e2e1]">Rp{{ number_format($total, 0, ',', '.') }}</p>
    </div>
</div>
<div class="glass-panel rounded-xl p-6">
    <h3 class="text-sm font-semibold text-[#e5e2e1] mb-2">Ringkasan</h3>
    <p class="text-sm text-[#b7b5b4]">Laporan detail dengan filter tanggal akan dikembangkan.</p>
</div>
@endsection


