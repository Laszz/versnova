@extends('layouts.admin')

@section('content')
<h1 class="font-heading text-heading text-gray-100 mb-6">Laporan</h1>

<div class="grid grid-cols-3 gap-4">
    <div class="bg-surface border border-outline rounded-card p-6">
        <p class="text-gray-500 text-sm font-caption uppercase">Hari Ini</p>
        <p class="font-heading text-display-mobile text-amber-500 mt-2">Rp{{ number_format($daily, 0, ',', '.') }}</p>
    </div>
    <div class="bg-surface border border-outline rounded-card p-6">
        <p class="text-gray-500 text-sm font-caption uppercase">Bulan Ini</p>
        <p class="font-heading text-display-mobile text-amber-500 mt-2">Rp{{ number_format($monthly, 0, ',', '.') }}</p>
    </div>
    <div class="bg-surface border border-outline rounded-card p-6">
        <p class="text-gray-500 text-sm font-caption uppercase">Total</p>
        <p class="font-heading text-display-mobile text-amber-500 mt-2">Rp{{ number_format($total, 0, ',', '.') }}</p>
    </div>
</div>
<div class="mt-6 bg-surface border border-outline rounded-card p-6">
    <p class="text-gray-500 text-sm">Laporan detail akan dikembangkan lebih lanjut.</p>
</div>
@endsection
