/** @type {import('tailwindcss').Config} */
export default {
    content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx,vue}",], theme: {
        extend: {
            colors: {
                error : '#ff2143',
                primary: '#5150F9',
                dark: {
                    primary: '#1e1f25',
                    secondary: '#050505',
                    accent: '#212229',
                    surface: '#131517',
                    type: '#282932'
                },
                soft: "#E9E9E9",
                green: '#41D37E',
                gray: {
                    primary: '#A9ABAD',
                    secondary: '#768396'
                }
            },
        }, fontFamily: {
            sans: ['DM Sans', 'sans-serif']
        }
    }, plugins: [],
}