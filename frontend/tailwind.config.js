/** @type {import('tailwindcss').Config} */
export default {
    content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx,vue}",], theme: {
        extend: {
            colors: {
                primary: '#5150F9'
            }
        }, fontFamily: {
            sans: ['DM Sans', 'sans-serif']
        }
    }, plugins: [],
}