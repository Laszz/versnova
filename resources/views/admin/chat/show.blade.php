@extends('layouts.admin')

@section('title', "Chat - $user->name")

@section('content')
<div class="mb-4 space-y-2">
    <h1 class="text-base font-semibold text-primary">Chat dengan {{ $user->name }}</h1>
    @if ($lastTransaction)
        <div class="flex items-center gap-3 text-xs">
            <span class="font-mono text-secondary">Transaksi terbaru:</span>
            <span class="text-accent font-medium">{{ $lastTransaction->account->title }}</span>
            <span class="text-secondary">({{ $lastTransaction->type === 'buy' ? 'Beli' : 'Sewa' }})</span>
            <span class="px-2 py-0.5 rounded text-[10px] font-mono
                @if($lastTransaction->status === 'waiting_confirmation') bg-blue-500/10 text-blue-400
                @elseif($lastTransaction->status === 'confirmed') bg-emerald-500/10 text-emerald-400
                @elseif($lastTransaction->status === 'completed') bg-emerald-500/10 text-emerald-400
                @endif">
                {{ str_replace('_', ' ', $lastTransaction->status) }}
            </span>
        </div>
    @endif
</div>

<div class="glass-panel rounded-xl overflow-hidden">
    <div class="h-[500px] overflow-y-auto p-6 space-y-4" id="chatBox">
        @forelse ($messages->reverse() as $msg)
            @php $mine = $msg->sender_id === Auth::id(); @endphp
            <div class="flex @if($mine) justify-end @endif">
                <div class="max-w-[75%] @if($mine) bg-[#ff5357] text-white @else bg-[#1c1b1b] border border-white/5 text-[#e5e2e1] @endif rounded-xl px-4 py-3 text-sm leading-relaxed">
                    @if (!$mine)
                        <p class="text-[10px] font-mono text-secondary mb-1">{{ $msg->sender->name }}</p>
                    @endif
                    <p style="white-space: pre-wrap">{{ $msg->message }}</p>
                    <p class="text-[10px] font-mono @if($mine) text-white/60 @else text-secondary @endif mt-1">{{ $msg->created_at->format('H:i') }}</p>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-4xl text-secondary block mb-3">chat</span>
                <p class="text-secondary text-sm">Belum ada pesan. Kirim pesan pertama ke {{ $user->name }}.</p>
            </div>
        @endforelse
    </div>

    <div class="border-t border-white/5 p-4">
        <form method="POST" action="{{ route('chat.send', $user) }}" class="flex gap-3">
            @csrf
            <textarea name="message" required rows="1" placeholder="Ketik pesan... (Enter kirim, Shift+Enter new line)" class="flex-1 bg-[#1c1b1b] border border-white/5 rounded-lg px-4 py-2.5 text-sm text-[#e5e2e1] placeholder-secondary focus:outline-none focus:border-[#ff5357] transition-colors resize-none" style="min-height: 42px; max-height: 120px;" oninput="this.style.height='';this.style.height=Math.min(this.scrollHeight,120)+'px'"></textarea>
            <button type="submit" class="px-5 py-2.5 bg-[#ff5357] text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">send</span>
                Kirim
            </button>
        </form>
    </div>
</div>

<script>
    var box = document.getElementById('chatBox');
    if (box) box.scrollTop = box.scrollHeight;

    document.querySelectorAll('textarea[name="message"]').forEach(function(el) {
        el.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    });
</script>

<a href="{{ route('admin.chat') }}" class="text-sm text-secondary hover:text-accent transition-colors inline-flex items-center gap-1 mt-4">
    <span class="material-symbols-outlined text-sm">arrow_back</span>
    Kembali
</a>
@endsection

