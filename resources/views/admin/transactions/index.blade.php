@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="glass-panel rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-[#e5e2e1]">Transaction History</h3>
        <span class="text-[10px] font-mono text-[#b7b5b4]/60">Real-time log</span>
    </div>
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Order ID</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Item</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">User</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Amount</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Status</th>
                <th class="text-right px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($transactions as $t)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4 font-mono text-xs text-[#b7b5b4]">{{ $t->invoice_number }}</td>
                <td class="px-6 py-4 text-sm text-[#e5e2e1]">{{ Str::limit($t->account->title, 25) }}</td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4]">{{ $t->user->name }}</td>
                <td class="px-6 py-4 text-sm font-mono text-[#e5e2e1]">Rp{{ number_format($t->total_price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
                    @php
                        $sc = match($t->status) {
                            'waiting_payment' => 'bg-amber-500/10 text-amber-400',
                            'waiting_confirmation' => 'bg-blue-500/10 text-blue-400',
                            'confirmed' => 'bg-[#ff5357]/10 text-[#ffb3af]',
                            'completed' => 'bg-emerald-500/10 text-emerald-400',
                            'cancelled', 'expired' => 'bg-red-500/10 text-red-400',
                            default => 'bg-white/10 text-[#b7b5b4]/60',
                        };
                    @endphp
                    <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-0.5 rounded-full font-medium {{ $sc }}">
                        <span class="w-1.5 h-1.5 rounded-full @if(in_array($t->status, ['confirmed','completed'])) bg-[#ffb3af] @elseif($t->status === 'waiting_confirmation') bg-blue-400 @elseif(in_array($t->status, ['cancelled','expired'])) bg-red-400 @else bg-amber-400 @endif"></span>
                        {{ str_replace('_', ' ', $t->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.transactions.show', $t) }}" class="p-2 rounded-lg text-[#b7b5b4] hover:text-[#ffb3af] hover:bg-white/5 transition-all inline-block" title="Detail">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if ($transactions->isEmpty())
    <div class="text-center py-20"><p class="text-[#b7b5b4]">Belum ada transaksi.</p></div>
@else
    <div class="mt-5">{{ $transactions->links() }}</div>
@endif
@endsection



