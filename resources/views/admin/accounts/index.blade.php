@extends('layouts.admin')

@section('title', 'Inventory')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex gap-2">
        <a href="{{ route('admin.accounts.index', ['type' => 'jual']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all @if($type === 'jual') bg-[#ff5357] text-white @else bg-[#1c1b1b] border border-white/10 text-[#b7b5b4] hover:border-[#ff5357]/40 @endif">
            <span class="material-symbols-outlined text-sm align-middle">sell</span> Akun Jual
        </a>
        <a href="{{ route('admin.accounts.index', ['type' => 'sewa']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all @if($type === 'sewa') bg-[#ff5357] text-white @else bg-[#1c1b1b] border border-white/10 text-[#b7b5b4] hover:border-[#ff5357]/40 @endif">
            <span class="material-symbols-outlined text-sm align-middle">schedule</span> Akun Sewa
        </a>
        <a href="{{ route('admin.accounts.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all @if(!$type) bg-[#ff5357] text-white @else bg-[#1c1b1b] border border-white/10 text-[#b7b5b4] hover:border-[#ff5357]/40 @endif">
            <span class="material-symbols-outlined text-sm align-middle">inventory_2</span> Semua
        </a>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.accounts.create', ['type' => 'buy']) }}" class="flex items-center gap-1.5 px-4 py-2 bg-[#ff5357] text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 12px rgba(255,83,87,0.3);">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            Akun Jual
        </a>
        <a href="{{ route('admin.accounts.create', ['type' => 'rent']) }}" class="flex items-center gap-1.5 px-4 py-2 border border-white/10 text-[#e5e2e1] rounded-lg text-sm font-medium hover:border-[#ff5357]/40 transition-all">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            Akun Sewa
        </a>
    </div>
</div>

<div class="glass-panel rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Item</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Game</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Tipe</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Harga</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Status</th>
                <th class="text-right px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($accounts as $a)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if ($a->primaryImage)
                            <img src="{{ Storage::url($a->primaryImage->image_path) }}" class="w-10 h-8 rounded object-cover">
                        @else
                            <div class="w-10 h-8 rounded bg-white/5 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[#b7b5b4] text-xs">inventory_2</span>
                            </div>
                        @endif
                        <span class="text-sm font-medium text-[#e5e2e1]">{{ Str::limit($a->title, 30) }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4]">{{ $a->game->name }}</td>
                <td class="px-6 py-4">
                    @if ($a->price_sell)
                        <span class="text-xs px-2 py-0.5 rounded bg-[#ff5357]/10 text-[#ffb3af] font-medium">Jual</span>
                    @else
                        <span class="text-xs px-2 py-0.5 rounded border border-white/10 text-secondary font-medium">Sewa</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm text-[#e5e2e1] font-mono">Rp{{ number_format($a->price_sell ?? $a->price_rent, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
                    @php
                        $sc = match($a->status) {
                            'available' => 'bg-[#ff5357]/10 text-[#ffb3af]',
                            'reserved' => 'bg-blue-500/10 text-blue-400',
                            'sold', 'rented' => 'bg-white/10 text-[#b7b5b4]/60',
                            default => 'bg-white/10 text-[#b7b5b4]/60',
                        };
                    @endphp
                    <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-0.5 rounded-full font-medium {{ $sc }}">
                        <span class="w-1.5 h-1.5 rounded-full @if($a->status === 'available') bg-[#ffb3af] @elseif($a->status === 'reserved') bg-blue-400 @else bg-[#b7b5b4]/60 @endif"></span>
                        {{ $a->status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.accounts.show', $a) }}" class="p-2 rounded-lg text-[#b7b5b4] hover:text-[#ffb3af] hover:bg-white/5 transition-all" title="Detail">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                        </a>
                        <a href="{{ route('admin.accounts.edit', $a) }}" class="p-2 rounded-lg text-[#b7b5b4] hover:text-[#ffb3af] hover:bg-white/5 transition-all" title="Edit">
                            <span class="material-symbols-outlined text-sm">edit_note</span>
                        </a>
                        <form method="POST" action="{{ route('admin.accounts.destroy', $a) }}" class="inline" onsubmit="return confirm('Hapus {{ $a->title }}?')">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-lg text-[#b7b5b4] hover:text-red-400 hover:bg-white/5 transition-all" title="Hapus">
                                <span class="material-symbols-outlined text-sm">delete_sweep</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if ($accounts->isEmpty())
    <div class="text-center py-20"><p class="text-[#b7b5b4]">Belum ada akun.</p></div>
@else
    <div class="mt-5">{{ $accounts->links() }}</div>
@endif
@endsection
