/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        fontSize: {
            'octa': ['4em!important'],
            'octa-sm': ['3.3em!important'],
            'octa-sm-fold': ['2.7em!important'],
        },
    },
    plugins: [],
}

