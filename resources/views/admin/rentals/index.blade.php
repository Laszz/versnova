@extends('layouts.admin')

@section('title', 'Active Rentals')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h3 class="text-base font-semibold text-[#e5e2e1]">Sewa Aktif</h3>
    <span class="text-xs font-mono text-secondary">{{ $rentals->total() }} sesi aktif</span>
</div>

<div class="glass-panel rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">User</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Akun</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Paket</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Mulai</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Sisa Waktu</th>
                <th class="text-right px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($rentals as $t)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4 text-sm text-[#e5e2e1]">{{ $t->user->name }}</td>
                <td class="px-6 py-4 text-sm text-secondary">{{ $t->account->title }}</td>
                <td class="px-6 py-4 text-sm text-secondary">{{ $t->rentalPackage?->name ?? '-' }}</td>
                <td class="px-6 py-4 text-sm text-secondary font-mono">{{ $t->created_at->format('H:i, d M') }}</td>
                <td class="px-6 py-4">
                    <span class="text-sm font-mono text-accent font-bold" data-countdown="{{ $t->rent_end->timestamp }}"></span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.chat.show', $t->user) }}" class="text-xs text-secondary hover:text-accent">Chat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if ($rentals->isEmpty())
    <div class="text-center py-20"><p class="text-secondary">Tidak ada sesi sewa aktif.</p></div>
@else
    <div class="mt-5">{{ $rentals->links() }}</div>
@endif
@endsection
