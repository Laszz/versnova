document.addEventListener('DOMContentLoaded', function () {
    var moon = document.getElementById('moonIcon');
    var sun = document.getElementById('sunIcon');
    var btn = document.getElementById('themeToggle');

    function updateIcons() {
        var isDark = document.documentElement.classList.contains('dark');
        if (moon && sun) {
            moon.classList.toggle('hidden', !isDark);
            sun.classList.toggle('hidden', isDark);
        }
    }

    updateIcons();

    if (btn) {
        btn.addEventListener('click', function () {
            var isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('versnova-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('versnova-theme', 'dark');
            }
            updateIcons();
        });
    }
});
