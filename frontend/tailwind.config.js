/** @type {import('tailwindcss').Config} */
export default {
    content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx,vue}",], theme: {
        extend: {
            colors: {
                primary: '#5150F9',
                dark: {
                    primary: '#1e1f25',
                    secondary: '#050505',
                    accent: '#212229'
                },
                soft: "#E9E9E9",
                green: '#258C60',
                gray: '#A9ABAD'
            },
        }, fontFamily: {
            sans: ['DM Sans', 'sans-serif']
        }
    }, plugins: [],
}