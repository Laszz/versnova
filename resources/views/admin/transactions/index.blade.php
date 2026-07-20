@extends('layouts.admin')

@section('content')
<h1 class="font-heading text-heading text-gray-100 mb-6">Transaksi</h1>

<div class="bg-surface border border-outline rounded-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface-bright border-b border-outline">
            <tr>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Invoice</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Akun</thth>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">User</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Total</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Status</th>
                <th class="text-right px-4 py-3 text-gray-400 font-caption">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline/30">
            @foreach ($transactions as $t)
            <tr class="hover:bg-surface-bright/50">
                <td class="px-4 py-3 text-gray-400 text-xs font-mono">{{ $t->invoice_number }}</td>
                <td class="px-4 py-3 text-gray-200">{{ $t->account->title }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $t->user->name }}</td>
                <td class="px-4 py-3 text-gray-200">Rp{{ number_format($t->total_price, 0, ',', '.') }}</td>
                <td class="px-4 py-3"><span class="text-xs capitalize">{{ str_replace('_', ' ', $t->status) }}</span></td>
                <td class="px-4 py-3 text-right"><a href="{{ route('admin.transactions.show', $t) }}" class="text-amber-500 text-sm">Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $transactions->links() }}</div>
@endsection
