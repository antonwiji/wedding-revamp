import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans:   ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                serif:  ['Playfair Display', ...defaultTheme.fontFamily.serif],
                script: ['Great Vibes', 'cursive'],
            },

            maxWidth: {
                'mobile': '576px',
            },

            fontSize: {
                'xs':   ['11px', { lineHeight: '16px' }],
                'sm':   ['13px', { lineHeight: '20px' }],
                'base': ['15px', { lineHeight: '24px' }],
                'md':   ['16px', { lineHeight: '24px' }],
                'lg':   ['17px', { lineHeight: '26px' }],
                'xl':   ['20px', { lineHeight: '28px' }],
                '2xl':  ['24px', { lineHeight: '32px' }],
                '3xl':  ['28px', { lineHeight: '36px' }],
                '4xl':  ['34px', { lineHeight: '42px' }],
            },

            colors: {
                brand: {
                    primary:   '#b5977a',
                    secondary: '#7c6b5e',
                    surface:   '#fdfaf7',
                    bg:        '#f5f0eb',
                    text:      '#2c2420',
                    muted:     '#9b8d84',
                    border:    '#e8ddd4',
                    success:   '#4caf82',
                    warning:   '#e4a83a',
                    danger:    '#e05252',
                },
            },

            borderRadius: {
                'card':  '16px',
                'btn':   '12px',
                'input': '10px',
            },

            boxShadow: {
                'card': '0 2px 16px rgba(0,0,0,0.07)',
                'btn':  '0 2px 8px rgba(181,151,122,0.3)',
                'sheet':'0 -4px 24px rgba(0,0,0,0.10)',
            },

            height: {
                'screen': '100dvh',
            },

            minHeight: {
                'screen': '100dvh',
            },
        },
    },

    plugins: [forms],
};
