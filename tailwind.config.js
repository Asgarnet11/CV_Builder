import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#269dd8',
                    dark: '#1270a0',
                    mid: '#1a8cc8',
                    alt: '#1e8ec4',
                    light: '#e8f4fb',
                },
                accent: '#de1d5e',
                warning: '#fbb92e',
                success: '#77ce94',
                dark: '#1a1a1a',
            },
            borderRadius: {
                'sm': '8px',
                'md': '12px',
                'lg': '16px',
                'xl': '20px',
                '2xl': '24px',
                '3xl': '28px',
            },
            boxShadow: {
                'sscasn-sm': '0 1px 3px rgba(18, 112, 160, .12)',
                'sscasn-md': '0 6px 20px rgba(18, 112, 160, .15)',
            },
        },
    },

    plugins: [forms],
};
