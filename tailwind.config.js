import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                surface: {
                    DEFAULT: '#121629',
                    low: '#0E1123',
                    'lowest': '#080B17',
                    bright: '#1A1E33',
                    'container': '#171F2E',
                    'container-high': '#1E2639',
                    'container-highest': '#262E44',
                },
                outline: {
                    DEFAULT: '#262B44',
                    variant: '#1E233A',
                },
                accent: {
                    DEFAULT: '#F59E0B',
                    hover: '#D97706',
                    soft: 'rgba(245, 158, 11, 0.1)',
                },
                danger: {
                    DEFAULT: '#EF4444',
                    soft: 'rgba(239, 68, 68, 0.1)',
                },
                success: {
                    DEFAULT: '#10B981',
                    soft: 'rgba(16, 185, 129, 0.1)',
                },
            },

            fontFamily: {
                heading: ['Teko', ...defaultTheme.fontFamily.sans],
                body: ['Sora', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },

            fontSize: {
                'display': ['48px', { lineHeight: '1.1', letterSpacing: '-0.04em', fontWeight: '700' }],
                'display-mobile': ['32px', { lineHeight: '1.2', letterSpacing: '-0.02em', fontWeight: '700' }],
                'heading': ['24px', { lineHeight: '1.3', letterSpacing: '-0.02em', fontWeight: '600' }],
                'body': ['16px', { lineHeight: '1.6', fontWeight: '400' }],
                'body-lg': ['18px', { lineHeight: '1.6', fontWeight: '400' }],
                'caption': ['14px', { lineHeight: '1.4', fontWeight: '500' }],
                'label': ['12px', { lineHeight: '1.2', letterSpacing: '0.05em', fontWeight: '700' }],
            },

            borderRadius: {
                'card': '0.75rem',
                'btn': '0.5rem',
                'pill': '9999px',
            },

            spacing: {
                'gutter': '20px',
                'section': '80px',
                'section-mobile': '48px',
            },
        },
    },

    plugins: [forms],
};
