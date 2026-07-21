@extends('layouts.admin')

@section('title', 'Reviews')

@section('content')
<div class="glass-panel rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">User</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Akun</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Rating</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Komentar</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase">Status</th>
                <th class="text-right px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($reviews as $r)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4 text-sm text-[#e5e2e1]">{{ $r->user->name }}</td>
                <td class="px-6 py-4 text-sm text-secondary">{{ $r->transaction->account->title }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-0.5">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-sm {{ $i <= $r->rating ? 'text-[#ffb3af]' : 'text-secondary/30' }}" style="font-variation-settings: 'FILL' 1">star</span>
                        @endfor
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-secondary max-w-xs truncate">{{ $r->comment ?? '-' }}</td>
                <td class="px-6 py-4">
                    @if ($r->is_approved)
                        <span class="text-xs px-2 py-0.5 rounded bg-[#ff5357]/10 text-[#ffb3af] font-medium">Ditampilkan</span>
                    @else
                        <span class="text-xs px-2 py-0.5 rounded bg-white/10 text-secondary font-medium">Menunggu</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        @if (!$r->is_approved)
                        <form method="POST" action="{{ route('admin.reviews.approve', $r) }}" class="inline">
                            @csrf
                            <button class="p-1.5 rounded-lg text-[#b7b5b4] hover:text-accent hover:bg-white/5 transition-all" title="Setujui">
                                <span class="material-symbols-outlined text-sm">check_circle</span>
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.reviews.reject', $r) }}" class="inline">
                            @csrf
                            <button class="p-1.5 rounded-lg text-[#b7b5b4] hover:text-red-400 hover:bg-white/5 transition-all" title="Sembunyikan">
                                <span class="material-symbols-outlined text-sm">visibility_off</span>
                            </button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('admin.reviews.destroy', $r) }}" class="inline" onsubmit="return confirm('Hapus review?')">
                            @csrf @method('DELETE')
                            <button class="p-1.5 rounded-lg text-[#b7b5b4] hover:text-red-400 hover:bg-white/5 transition-all" title="Hapus">
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
@if ($reviews->isEmpty())
    <div class="text-center py-20"><p class="text-secondary">Belum ada review.</p></div>
@else
    <div class="mt-5">{{ $reviews->links() }}</div>
@endif
@endsection

