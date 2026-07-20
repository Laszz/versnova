@extends('layouts.admin')

@section('content')
<h1 class="font-heading text-heading text-gray-100 mb-6">Chat Support</h1>

<div class="bg-surface border border-outline rounded-card p-6">
    @if ($users->count())
    <div class="space-y-3">
        @foreach ($users as $u)
        <div class="flex items-center justify-between p-3 bg-surface-bright rounded-card">
            <div>
                <p class="text-gray-200 font-semibold">{{ $u->name }}</p>
                <p class="text-gray-500 text-sm">{{ $u->email }}</p>
            </div>
            <a href="{{ route('chat', $u) }}" class="text-amber-500 text-sm hover:underline">Chat</a>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-gray-500">Belum ada chat.</p>
    @endif
</div>
@endsection
