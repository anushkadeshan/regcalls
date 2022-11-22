const defaultTheme = require('tailwindcss/defaultTheme');


/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
    ],

    theme: {
      extend: {
        fontFamily: {
          sans: ["Poppins", ...defaultTheme.fontFamily.sans],
          inter: ["Inter", ...defaultTheme.fontFamily.sans],
        },
        keyframes: {
          "fade-out": {
            "0%": {
              opacity: 1,
              visibility: "visible",
            },
            "100%": {
              opacity: 0,
              visibility: "hidden",
            },
          },
        },
      },
    },

    corePlugins: {
        textOpacity: false,
        backgroundOpacity: false,
        borderOpacity: false,
        divideOpacity: false,
        placeholderOpacity: false,
        ringOpacity: false,
      },

    plugins: [
        require('flowbite/plugin'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        function ({ addVariant }) {
        addVariant(
            "supports-backdrop",
            "@supports ((-webkit-backdrop-filter: initial) or (backdrop-filter: initial))"
        );
        },
    ],
};
