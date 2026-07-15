import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/cinematic.css',
                'resources/js/app.js',
                'resources/js/cinematic-canvas.js',
                'resources/js/cinematic-pages.js',
            ],
            refresh: true,
        }),
    ],

    // ── Performance: tree-shake Three.js in production ──
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    three: ['three'],
                    gsap: ['gsap'],
                },
            },
        },
    },
});
