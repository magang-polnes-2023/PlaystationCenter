import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import colors from "tailwindcss/colors";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                console: "url('/assets/images/console.png')",
                playstation: "url('/assets/images/Playstation.png')",
                bgHome: "url('/assets/images/bg.png')",
            },
            colors: {
                danger: colors.rose,
                primary: colors.green,
                success: colors.blue,
                warning: colors.yellow,
            },
        },
    },

    plugins: [forms],
};
