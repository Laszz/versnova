@extends('layouts.admin')

@section('title', 'Edit Akun')

@section('content')

<div class="mx-auto max-w-2xl glass-panel rounded-xl p-6">
    <form method="POST" action="{{ route('admin.accounts.update', $account) }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Game</label>
                <select name="game_id" class="select-admin">
                    @foreach ($games as $g) <option value="{{ $g->id }}" @selected($account->game_id === $g->id)>{{ $g->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Title</label>
                <input type="text" name="title" value="{{ $account->title }}" class="input-admin" required>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="input-admin">{{ $account->description }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Platform</label>
                <input type="text" name="platform" value="{{ $account->platform }}" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Server</label>
                <input type="text" name="server" value="{{ $account->server }}" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Level</label>
                <input type="text" name="level" value="{{ $account->level }}" class="input-admin">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Jual</label>
                <input type="number" name="price_sell" value="{{ $account->price_sell }}" step="0.01" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Harga Sewa/jam</label>
                <input type="number" name="price_rent" value="{{ $account->price_rent }}" step="0.01" class="input-admin">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Status</label>
            <select name="status" class="select-admin">
                @foreach (['available','reserved','sold','rented'] as $s) <option value="{{ $s }}" @selected($account->status === $s)>{{ ucfirst($s) }}</option> @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#e5e2e1] mb-1.5">Skin / Items</label>
            <textarea name="skin_info" rows="2" class="input-admin">{{ $account->skin_info }}</textarea>
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">Update</button>
            <a href="{{ route('admin.accounts.index') }}" class="btn-admin-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
