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
                    "linear-gradient(60deg, rgba(222,195,0,1) 0%, rgba(166,214,27,1) 48%, rgba(9,96,150,1) 100%)",
                "complementary-pattern":
                    "linear-gradient(60deg, rgba(9,96,150,1) 0%, rgba(166,214,27,1) 52%, rgba(222,195,0,1) 100%)",
            },
            colors: {
                color1: "#dec300",
                color2: "#a6d61b",
                color3: "#096096",
                glass: "rgba(255, 255, 255, 0.15)",
                glass2: "rgba(0, 0, 0, 0.3)",
            },
        },
    },
    plugins: [],
};
