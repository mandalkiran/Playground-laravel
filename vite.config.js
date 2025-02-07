import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    /*server: {
        host: '0.0.0.0', // Allow external access
        cors: {
            origin: '*', // Laravel's URL
            methods: ['*'], // Allowed methods
        },
    },*/
    server: {
        origin: process.env.VITE_ASSET_URL || 'http://localhost:5173',
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
