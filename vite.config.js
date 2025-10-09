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
    build: {
        outDir: 'public',
        // place built assets directly under public/, we'll route files into subfolders via rollupOptions
        assetsDir: '',
        manifest: true,
        emptyOutDir: false, // do not delete entire public/
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'resources/js/app.js'),
                style: path.resolve(__dirname, 'resources/css/app.css'),
            },
            output: {
                entryFileNames: 'js/[name].js',
                chunkFileNames: 'js/[name].js',
                assetFileNames: (assetInfo) => {
                    const name = assetInfo.name || '';
                    if (/\.css$/.test(name)) return 'css/[name][extname]';
                    if (/\.(png|jpe?g|svg|gif|webp)$/.test(name)) return 'img/[name][extname]';
                    if (/\.(woff2?|ttf|eot|otf)$/.test(name)) return 'fonts/[name][extname]';
                    return 'assets/[name][extname]';
                }
            }
        }
    }
});
