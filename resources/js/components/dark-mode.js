document.addEventListener('alpine:init', () => {
    Alpine.data('theme', () => ({
        dark: true,

        init() {
            const stored = localStorage.getItem('versnova-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            this.dark = stored ? stored === 'dark' : prefersDark;
            this.apply();

            document.documentElement.classList.add('dark');
        },

        toggle() {
            this.dark = !this.dark;
            this.apply();
        },

        apply() {
            if (this.dark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            localStorage.setItem('versnova-theme', this.dark ? 'dark' : 'light');
        },
    }));
});
