import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                main: '#512E88',
                main25: '#DFD6ED',
                main50: '#7855AF',
                main100: '#3E157D',
                primary : '#FB8931',
                primary100 : '#FF6F00',
            },
            fontFamily: {
                sans: ['Ravi FaNum'],
            },
        },
    },

    plugins: [forms],
};
