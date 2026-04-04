import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [],  // No longer using Vite assets - using Dashtrans template assets
            refresh: true,
        }),
        tailwindcss(),
    ],
});
