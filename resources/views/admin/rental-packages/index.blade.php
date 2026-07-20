@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="font-heading text-heading text-gray-100">Rental Packages</h1>
    <a href="{{ route('admin.rental-packages.create') }}" class="btn-primary text-sm">+ Tambah</a>
</div>

<div class="bg-surface border border-outline rounded-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface-bright border-b border-outline">
            <tr>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Nama</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Jam</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Harga</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Aktif</th>
                <th class="text-right px-4 py-3 text-gray-400 font-caption">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline/30">
            @foreach ($packages as $p)
            <tr class="hover:bg-surface-bright/50">
                <td class="px-4 py-3 text-gray-200">{{ $p->name }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $p->hours }} jam</td>
                <td class="px-4 py-3 text-gray-200">Rp{{ number_format($p->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3">{!! $p->is_active ? '<span class="text-success">Aktif</span>' : '<span class="text-gray-600">Tidak</span>' !!}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.rental-packages.edit', $p) }}" class="text-amber-500 text-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.rental-packages.destroy', $p) }}" class="inline" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $packages->links() }}</div>
@endsection
