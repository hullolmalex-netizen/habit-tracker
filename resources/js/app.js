import './bootstrap';

/**
 * ─── Dark Mode Toggle ─────────────────────────────────────────────────────
 * Reads user preference from localStorage and applies the 'dark' class
 * to <html>. This runs before the page renders to avoid flash.
 */
const theme = localStorage.getItem('theme');
if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

/**
 * ─── Theme toggle button handler ──────────────────────────────────────────
 * Add id="theme-toggle" to any button in your Blade views to wire this up.
 */
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('theme-toggle');
    if (btn) {
        btn.addEventListener('click', () => {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    }
});
