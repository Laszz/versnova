@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="glass-panel rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-white/[0.02] border-b border-white/5">
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">User</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Email</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Role</th>
                <th class="text-left px-6 py-4 text-xs font-mono text-[#ffb3af]/70 uppercase tracking-widest">Joined</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($users as $u)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs text-[#b7b5b4] font-mono">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
                        <span class="text-sm font-medium text-[#e5e2e1]">{{ $u->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4]">{{ $u->email }}</td>
                <td class="px-6 py-4">
                    @if ($u->is_admin)
                        <span class="text-xs px-2.5 py-0.5 rounded-full bg-[#ff5357]/10 text-[#ffb3af] font-medium">Admin</span>
                    @else
                        <span class="text-xs text-[#b7b5b4]/60">User</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm text-[#b7b5b4]/60 font-mono">{{ $u->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if ($users->isEmpty())
    <div class="text-center py-20"><p class="text-[#b7b5b4]">Belum ada user.</p></div>
@else
    <div class="mt-5">{{ $users->links() }}</div>
@endif
@endsection



