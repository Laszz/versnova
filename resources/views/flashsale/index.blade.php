@extends('layouts.app')

@section('title', 'Flashsale')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    {{-- Banner --}}
    <div class="relative overflow-hidden rounded-xl p-8 md:p-12 mb-8 text-center" style="background: linear-gradient(135deg, rgba(255,83,87,0.15), rgba(255,83,87,0.05)); border: 1px solid rgba(255,83,87,0.2);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#ff5357]/5 rounded-full blur-[80px]"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#ff5357]/5 rounded-full blur-[80px]"></div>

        <div class="relative">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[var(--accent-soft)] border border-accent text-xs font-mono text-accent uppercase tracking-wider mb-4">
                <span class="material-symbols-outlined text-sm">local_fire_department</span>
                Flash Sale
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-primary mb-2">Promo Terbatas</h1>
            <p class="text-sm text-secondary max-w-md mx-auto">Diskon besar-besaran untuk akun-akun pilihan. Jangan sampai kehabisan.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($flashsale as $account)
            <x-account-card :account="$account" />
        @empty
            <div class="col-span-full text-center py-20">
                <span class="material-symbols-outlined text-5xl text-secondary block mb-4">local_fire_department</span>
                <p class="text-secondary">Belum ada flashsale aktif.</p>
                <a href="{{ route('katalog') }}" class="text-sm text-accent hover:underline mt-2 inline-block">Lihat katalog</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $flashsale->links() }}</div>
</div>

<script>
    document.addEventListener('alpine:init', function() {
        Alpine.data('countdown', function(until) {
            return {
                display: '--:--:--',
                init() {
                    this.update();
                    setInterval(() => this.update(), 1000);
                },
                update() {
                    var end = new Date(until.replace(' ', 'T')).getTime();
                    var now = new Date().getTime();
                    var diff = end - now;
                    if (diff <= 0) { this.display = '00:00:00'; return; }
                    var h = Math.floor(diff / (1000 * 60 * 60));
                    var m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    var s = Math.floor((diff % (1000 * 60)) / 1000);
                    this.display =
                        String(h).padStart(2, '0') + ':' +
                        String(m).padStart(2, '0') + ':' +
                        String(s).padStart(2, '0');
                }
            };
        });
    });
</script>
@endsection
