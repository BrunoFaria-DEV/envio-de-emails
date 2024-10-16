import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/sass/dashboard/styles.scss',
                'resources/js/dashboard/scripts.js',
                'resources/js/dashboard/pages/users.js',
                'resources/js/dashboard/pages/customers.js',
                'resources/js/dashboard/pages/customer_accounts.js',
                'resources/js/dashboard/pages/shippings.js',
                'resources/js/pages/register.js',
                'resources/js/pages/home.js',
            ],
            refresh: true,
        }),
    ],
});
