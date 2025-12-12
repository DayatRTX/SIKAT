/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#B1B2FF",
                secondary: "#AAC4FF",
                tertiary: "#D2DAFF",
                background: "#EEF1FF",
            },
            fontFamily: {
                sans: ["Poppins", "Inter", "system-ui", "sans-serif"],
            },
        },
    },
    plugins: [],
};
