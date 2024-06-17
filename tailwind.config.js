/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backgroundImage: {
                "dafault-pattern":
                    "linear-gradient(60deg, rgba(244,194,55,1) 0%, rgba(255,130,62,1) 43%, rgba(127,60,181,1) 100%)",
            },
            colors: {
                color1: "#f4c237",
                color2: "#ff823e",
                color3: "#7025ad",
                glass: "rgba(255, 255, 255, 0.15)",
            },
        },
    },
    plugins: [],
};
