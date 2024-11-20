import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        port: 5173,
        host: true,
        hmr: {
            protocol: 'ws',
            host: 'localhost'
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ]
});
