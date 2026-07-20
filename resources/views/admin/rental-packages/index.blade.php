@extends('layouts.admin')

@section('title', 'Rental Packages')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-[#b7b5b4]">Kelola paket sewa</p>
    <a href="{{ route('admin.rental-packages.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-[#ff5357] text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 15px rgba(255,83,87,0.4);">
        <span class="material-symbols-outlined text-sm">add_circle</span>
        Tambah
    </a>
</div>

<div class="glass-panel rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Nama</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Jam</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Harga</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Jam Ops</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Status</th>
                <th class="text-right px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($packages as $p)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4 text-sm font-medium text-[#e5e2e1]">{{ $p->name }}</td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4] font-mono">{{ $p->hours }} jam</td>
                <td class="px-6 py-4 text-sm text-[#e5e2e1] font-mono">Rp{{ number_format($p->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4] font-mono">
                    @if ($p->open_time)
                        {{ substr($p->open_time, 0, 5) }} - {{ substr($p->close_time, 0, 5) }}
                    @else
                        <span class="text-[#b7b5b4]/40">24 jam</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if ($p->is_active)
                        <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-0.5 rounded-full bg-[#ff5357]/10 text-[#ffb3af] font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ffb3af]"></span> Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-0.5 rounded-full bg-white/10 text-[#b7b5b4]/60 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#b7b5b4]/60"></span> Inactive
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.rental-packages.edit', $p) }}" class="p-2 rounded-lg text-[#b7b5b4] hover:text-[#ffb3af] hover:bg-white/5 transition-all" title="Edit">
                            <span class="material-symbols-outlined text-sm">edit_note</span>
                        </a>
                        <form method="POST" action="{{ route('admin.rental-packages.destroy', $p) }}" class="inline" onsubmit="return confirm('Hapus {{ $p->name }}?')">
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
@if ($packages->isEmpty())
    <div class="text-center py-20"><p class="text-[#b7b5b4]">Belum ada package.</p></div>
@else
    <div class="mt-5">{{ $packages->links() }}</div>
@endif
@endsection


