@extends('layouts.admin')

@section('title', 'Support')

@section('content')
<div class="glass-panel rounded-xl p-6">
    @if ($users->count())
    <div class="space-y-1">
        @foreach ($users as $u)
        <a href="{{ route('chat', $u) }}" class="flex items-center justify-between p-4 rounded-lg hover:bg-white/[0.02] transition-colors group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-sm text-[#b7b5b4] font-mono">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
                <div>
                    <p class="text-sm font-medium text-[#e5e2e1] group-hover:text-[#ffb3af] transition-colors">{{ $u->name }}</p>
                    <p class="text-xs text-[#b7b5b4]">{{ $u->email }}</p>
                </div>
            </div>
            <span class="material-symbols-outlined text-[#474746] group-hover:text-[#ffb3af] transition-colors text-[20px]">chevron_right</span>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-12"><p class="text-[#b7b5b4]">Belum ada chat.</p></div>
    @endif
</div>
@endsection
