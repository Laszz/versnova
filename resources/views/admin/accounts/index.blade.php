@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="font-heading text-heading text-gray-100">Akun</h1>
    <a href="{{ route('admin.accounts.create') }}" class="btn-primary text-sm">+ Tambah Akun</a>
</div>

<div class="bg-surface border border-outline rounded-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface-bright border-b border-outline">
            <tr>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Akun</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Game</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Harga</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Status</th>
                <th class="text-right px-4 py-3 text-gray-400 font-caption">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline/30">
            @foreach ($accounts as $a)
            <tr class="hover:bg-surface-bright/50">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        @if ($a->primaryImage)
                            <img src="{{ Storage::url($a->primaryImage->image_path) }}" class="w-10 h-8 rounded object-cover">
                        @endif
                        <span class="text-gray-200">{{ $a->title }}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $a->game->name }}</td>
                <td class="px-4 py-3 text-gray-200">Rp{{ number_format($a->price_sell ?? $a->price_rent, 0, ',', '.') }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs capitalize px-2 py-0.5 rounded-full @if($a->status === 'available') bg-success/10 text-success @elseif($a->status === 'sold' || $a->status === 'rented') bg-gray-800 text-gray-400 @else bg-amber-500/10 text-amber-500 @endif">{{ $a->status }}</span>
                </td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.accounts.edit', $a) }}" class="text-amber-500 hover:text-amber-400 text-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.accounts.destroy', $a) }}" class="inline" onsubmit="return confirm('Hapus akun?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-300 text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $accounts->links() }}</div>
@endsection
