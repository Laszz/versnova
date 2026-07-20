(function() {
    function updateAll() {
        document.querySelectorAll('[data-countdown]').forEach(function(el) {
            var end = parseInt(el.getAttribute('data-countdown'), 10) * 1000;
            var diff = end - new Date().getTime();
            if (diff <= 0) { el.textContent = '00:00:00'; return; }
            var h = Math.floor(diff / 3600000);
            var m = Math.floor((diff % 3600000) / 60000);
            var s = Math.floor((diff % 60000) / 1000);
            el.textContent = String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            requestAnimationFrame(updateAll);
        });
    } else {
        requestAnimationFrame(updateAll);
    }

    setInterval(updateAll, 1000);
})();
