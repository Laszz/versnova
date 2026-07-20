(function () {
    var key = 'versnova-theme';

    function getTheme() {
        var stored = localStorage.getItem(key);
        if (stored) return stored === 'dark';
        return window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    function apply(theme) {
        if (theme) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem(key, theme ? 'dark' : 'light');
    }

    apply(getTheme());
})();
