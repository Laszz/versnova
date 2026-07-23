import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import './components/countdown';
import Lenis from 'lenis';

const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    smoothWheel: true,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

window.lenis = lenis;

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('aside');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.createElement('div');

    if (sidebar && toggle) {
        overlay.className = 'fixed inset-0 bg-black/50 z-30 hidden lg:hidden';
        overlay.id = 'sidebarOverlay';
        document.body.appendChild(overlay);

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('translate-x-0');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            overlay.classList.add('hidden');
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full', 'translate-x-0');
                overlay.classList.add('hidden');
            }
        });
    }

    // Rupiah input formatting
    document.querySelectorAll('.input-rupiah').forEach(function(el) {
        function format(v) {
            var num = v.replace(/[^0-9]/g, '');
            if (!num) return '';
            return parseInt(num, 10).toLocaleString('id-ID');
        }

        function unformat(v) {
            return v.replace(/\./g, '').replace(',', '.');
        }

        el.addEventListener('input', function() {
            var pos = this.selectionStart;
            var raw = this.value.replace(/[^0-9]/g, '');
            var before = this.value.length;
            this.value = format(this.value);
            var after = this.value.length;
            if (pos && after > before) this.setSelectionRange(pos + (after - before), pos + (after - before));
        });

        el.addEventListener('blur', function() {
            if (this.value) {
                this.value = format(this.value);
            }
        });

        el.closest('form')?.addEventListener('submit', function() {
            el.value = unformat(el.value);
        });
    });

    // Close sidebar on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            if (overlay) overlay.classList.add('hidden');
        }
    });
});
