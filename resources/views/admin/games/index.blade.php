@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="font-heading text-heading text-gray-100">Games</h1>
    <a href="{{ route('admin.games.create') }}" class="btn-primary text-sm">+ Tambah Game</a>
</div>

<div class="bg-surface border border-outline rounded-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface-bright border-b border-outline">
            <tr>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Nama</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Accounts</th>
                <th class="text-right px-4 py-3 text-gray-400 font-caption">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline/30">
            @foreach ($games as $game)
            <tr class="hover:bg-surface-bright/50">
                <td class="px-4 py-3 text-gray-200">{{ $game->name }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $game->accounts_count }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.games.edit', $game) }}" class="text-amber-500 hover:text-amber-400 text-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.games.destroy', $game) }}" class="inline" onsubmit="return confirm('Hapus game ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-300 text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $games->links() }}</div>
@endsection
