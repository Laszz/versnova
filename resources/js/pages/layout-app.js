function updateIcons() {
    var moon = document.getElementById('moonIcon');
    var sun = document.getElementById('sunIcon');
    if (!moon || !sun) return;
    var isDark = document.documentElement.classList.contains('dark');
    moon.classList.toggle('hidden', !isDark);
    sun.classList.toggle('hidden', isDark);
}

var btn = document.getElementById('themeToggle');
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

updateIcons();
document.addEventListener('DOMContentLoaded', updateIcons);
