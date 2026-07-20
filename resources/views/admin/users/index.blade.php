@extends('layouts.admin')

@section('content')
<h1 class="font-heading text-heading text-gray-100 mb-6">Users</h1>

<div class="bg-surface border border-outline rounded-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface-bright border-b border-outline">
            <tr>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Nama</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Email</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Admin</th>
                <th class="text-left px-4 py-3 text-gray-400 font-caption">Bergabung</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline/30">
            @foreach ($users as $u)
            <tr class="hover:bg-surface-bright/50">
                <td class="px-4 py-3 text-gray-200">{{ $u->name }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $u->email }}</td>
                <td class="px-4 py-3">{!! $u->is_admin ? '<span class="text-amber-500">Ya</span>' : '<span class="text-gray-600">-</span>' !!}</td>
                <td class="px-4 py-3 text-gray-500 text-xs">{{ $u->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
