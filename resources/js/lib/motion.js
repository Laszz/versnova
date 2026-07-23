import { animate, scroll, inView, stagger } from 'motion';

document.addEventListener('DOMContentLoaded', function () {
    // Scroll reveal for sections
    document.querySelectorAll('[data-reveal]').forEach(function (el) {
        inView(el, function () {
            animate(el, { opacity: [0, 1], y: [30, 0] }, { duration: 0.5, easing: 'ease-out' });
            return function () { };
        }, { amount: 0.15 });
    });

    // Stagger fade in for card grids
    document.querySelectorAll('[data-stagger]').forEach(function (grid) {
        var cards = grid.querySelectorAll('[data-stagger-item]');
        inView(grid, function () {
            animate(cards, { opacity: [0, 1], y: [20, 0] }, { duration: 0.4, delay: stagger(0.06), easing: 'ease-out' });
            return function () { };
        }, { amount: 0.1 });
    });

    // Floating animation for decorative elements
    document.querySelectorAll('[data-float]').forEach(function (el) {
        animate(el, { y: [-6, 6] }, { duration: 3, direction: 'alternate', repeat: Infinity, easing: 'ease-in-out' });
    });
});
