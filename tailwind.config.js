import defaultTheme from 'tailwindcss/defaultTheme'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                pantoneBlack6: '#000000',     // Pantone BLACK 6 C
                pantone504: '#56212f',        // Pantone 504 C vino
                pantone7504: '#977e5b',       // Pantone 7504 C dorado
                pantone4635: '#965f36',       // Pantone 158
                pantone467: '#c3b08f',        // Pantone 467 C dorado claro
                pantoneWarmGrey1: '#d6d1ca',  // Pantone Warm Grey 1C gris
            },
        },
    },
    plugins: [],
}
