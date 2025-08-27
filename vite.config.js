import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/app.scss',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/laravel-echo.js',
                'resources/js/notification.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: './postcss.config.js',
    },
    resolve: {
        alias: {
            '~': '/node_modules/',
            '@': path.resolve(__dirname, 'resources'),
        },
    },
});
