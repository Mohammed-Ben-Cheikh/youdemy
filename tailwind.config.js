/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./*.{php,html,js}","./public/**/*.{html,js,php}","./Dashboard/**/*.{html,js,php}","./app/auth/**/*.{html,js,php}","./app/action/**/*.{html,js,php}"],
    theme: {
        extend: {
            colors: {
                dark: '#0f172a',
                'dark-light': '#1e293b'
            }
        },
    },
    plugins: [],
}
