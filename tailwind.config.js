import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                        'kampus-utama': '#3b82f6',
                        /* Tailwind Blue 500 */
                        'kampus-gelap': '#1e40af',
                        /* Tailwind Blue 800 */
                        'kampus-terang': '#bfdbfe',
                        /* Tailwind Blue 200 */
                    },
        },
    },

    plugins: [forms],
};
