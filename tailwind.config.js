import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        // Jika Anda punya komponen Vue/React, tambahkan juga di sini:
        // './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'kostgo-blue': '#2E6DA4',
                'kostgo-orange': '#FF7F00',
                'kostgo-light-blue': '#E0F2F7',
                'kostgo-dark-gray': '#333333',
                'kostgo-gray': '#6B7280',
            },
        },
    },

    plugins: [forms],
};