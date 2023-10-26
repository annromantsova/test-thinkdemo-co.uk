/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
                fontFamily:{
                    'primary': ['Montserrat']
                },
                colors: {
                    nav: '#201E50',
                    primary: '#BA2C73',
                    default: '#1D1E42'
                }
        },
    },
    plugins: [
    ]
}

