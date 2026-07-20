@extends('layouts.admin')

@section('title', 'Support')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h3 class="text-base font-semibold text-[#e5e2e1]">Percakapan</h3>
    <span class="text-xs font-mono text-secondary">{{ $users->count() }} user</span>
</div>

<div class="glass-panel rounded-xl p-6">
    @if ($users->count())
    <div class="space-y-1">
        @foreach ($users as $u)
        <a href="{{ route('admin.chat.show', $u) }}" class="flex items-center justify-between p-4 rounded-lg hover:bg-white/[0.02] transition-colors group">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-sm text-[#b7b5b4] font-mono shrink-0">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-[#e5e2e1] group-hover:text-[#ffb3af] transition-colors truncate">{{ $u->name }}</p>
                        @if (($u->unread ?? 0) > 0)
                            <span class="w-2 h-2 rounded-full bg-[#ff5357] shrink-0"></span>
                        @endif
                    </div>
                    <p class="text-xs text-[#b7b5b4] truncate">{{ $u->email }}</p>
                    @if ($u->lastTransaction)
                        <p class="text-[10px] font-mono text-accent mt-0.5">
                            {{ $u->lastTransaction->type === 'buy' ? 'Pembelian' : 'Sewa' }} -
                            {{ str_replace('_', ' ', $u->lastTransaction->status) }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0 ml-3">
                @if (($u->unread ?? 0) > 0)
                    <span class="text-[10px] bg-[#ff5357] text-white px-2 py-0.5 rounded-full font-mono">{{ $u->unread }}</span>
                @endif
                <span class="material-symbols-outlined text-[#474746] group-hover:text-[#ffb3af] transition-colors text-[20px]">chevron_right</span>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <span class="material-symbols-outlined text-4xl text-secondary block mb-3">chat</span>
        <p class="text-[#b7b5b4]">Belum ada percakapan atau transaksi.</p>
    </div>
    @endif
</div>
@endsection
