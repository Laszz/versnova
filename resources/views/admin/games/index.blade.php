@extends('layouts.admin')

@section('title', 'Games')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-[#b7b5b4]">Kelola daftar game</p>
    <a href="{{ route('admin.games.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-[#ff5357] text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all" style="box-shadow: 0 0 15px rgba(255,83,87,0.4);">
        <span class="material-symbols-outlined text-sm">add_circle</span>
        Tambah Game
    </a>
</div>

<div class="glass-panel rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Game</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Akun</th>
                <th class="text-right px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($games as $g)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if ($g->icon)
                            <img src="{{ Storage::url($g->icon) }}" class="w-9 h-9 rounded-lg object-cover">
                        @else
                            <div class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[#b7b5b4] text-sm">stadia_controller</span>
                            </div>
                        @endif
                        <span class="text-sm font-medium text-[#e5e2e1]">{{ $g->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4] font-mono">{{ $g->accounts_count }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.games.edit', $g) }}" class="p-2 rounded-lg text-[#b7b5b4] hover:text-[#ffb3af] hover:bg-white/5 transition-all" title="Edit">
                            <span class="material-symbols-outlined text-sm">edit_note</span>
                        </a>
                        <form method="POST" action="{{ route('admin.games.destroy', $g) }}" class="inline" onsubmit="return confirm('Hapus {{ $g->name }}?')">
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
@if ($games->isEmpty())
    <div class="text-center py-20"><p class="text-[#b7b5b4]">Belum ada game.</p></div>
@else
    <div class="mt-5">{{ $games->links() }}</div>
@endif
@endsection



