import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';


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

            typography: {
                DEFAULT: {
                    css: {
                        a: {
                            color: '#FB8931',
                            '&:hover': {
                                color: '#7855AF',
                            },
                        },
                        h1: {
                            fontSize: '2.25em', // 36px
                            fontWeight: '800',
                        },
                        h2: {
                            fontSize: '1.875em', // 30px
                            fontWeight: '800',
                        },
                        h3: {
                            fontSize: '1.5em', // 24px
                            fontWeight: '800',
                        },
                        h4: {
                            fontSize: '1.25em', // 20px
                            fontWeight: '600',
                        },
                        h5: {
                            fontSize: '1em', // 16px
                            fontWeight: '600',
                        },
                        h6: {
                            fontSize: '0.875em', // 14px
                            fontWeight: '600',
                        },
                    },
                },
            },

        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
