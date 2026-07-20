@extends('layouts.app')

@section('title', 'Chat')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <div class="mb-6">
        <h1 class="text-lg font-bold text-primary">Chat</h1>
        <p class="text-sm text-secondary mt-1">
            @if (isset($user))
                Percakapan dengan <span class="text-accent font-medium">{{ $user->name }}</span>
            @else
                Hubungi admin
            @endif
        </p>
    </div>

    @php $receiver = $user ?? App\Models\User::where('is_admin', true)->first(); @endphp

    <div class="bg-card border border-subtle rounded-xl overflow-hidden">
        @if ($receiver)
        <div class="h-96 overflow-y-auto p-6 space-y-4" id="chatBox">
            @forelse (($messages ?? collect())->reverse() as $msg)
                @php $mine = $msg->sender_id === Auth::id(); @endphp
                <div class="flex @if($mine) justify-end @endif">
                    <div class="max-w-[75%] @if($mine) bg-accent text-white @else bg-card border border-subtle text-primary @endif rounded-xl px-4 py-3 text-sm leading-relaxed">
                        @if (!$mine)
                            <p class="text-[10px] font-mono text-secondary mb-1">Admin</p>
                        @endif
                        <p style="white-space: pre-wrap">{{ $msg->message }}</p>
                        <p class="text-[10px] font-mono @if($mine) text-white/60 @else text-secondary @endif mt-1">{{ $msg->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-4xl text-secondary block mb-3">chat</span>
                    <p class="text-secondary text-sm">Belum ada pesan. Kirim pesan ke admin.</p>
                </div>
            @endforelse
        </div>

        <div class="border-t border-subtle p-4">
            <form method="POST" action="{{ route('chat.send', $receiver) }}" class="flex gap-3">
                @csrf
                <textarea name="message" required rows="1" placeholder="Ketik pesan... (Enter kirim, Shift+Enter new line)" class="flex-1 bg-card border border-subtle rounded-lg px-4 py-2.5 text-sm text-primary placeholder-secondary focus:outline-none focus:border-accent transition-colors resize-none" style="min-height: 42px; max-height: 120px;" oninput="this.style.height='';this.style.height=Math.min(this.scrollHeight,120)+'px'"></textarea>
                <button type="submit" class="px-5 py-2.5 bg-accent text-white rounded-lg text-sm font-medium hover:brightness-110 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">send</span>
                    Kirim
                </button>
            </form>
        </div>
        @else
        <div class="text-center py-12 text-secondary text-sm">Tidak ada penerima pesan.</div>
        @endif
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
@endsection
