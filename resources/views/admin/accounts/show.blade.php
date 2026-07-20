@extends('layouts.admin')

@section('content')
<a href="{{ route('admin.accounts.index') }}" class="text-gray-500 hover:text-amber-500 text-sm mb-6 inline-block">&larr; Kembali</a>

<div class="bg-surface border border-outline rounded-card p-6">
    <h1 class="font-heading text-heading text-gray-100">{{ $account->title }}</h1>
    <p class="text-gray-400 mt-1">{{ $account->game->name }} | {{ $account->status }}</p>

    <div class="mt-6">
        <p class="text-gray-300">{{ $account->description }}</p>
    </div>

    @if ($account->images->count())
    <div class="grid grid-cols-4 gap-2 mt-4">
        @foreach ($account->images as $img)
            <img src="{{ Storage::url($img->image_path) }}" class="rounded object-cover h-24 w-full">
        @endforeach
    </div>
    @endif
</div>
@endsection
