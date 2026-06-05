const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            "@css": path.resolve(__dirname, "resources/css")
        },
    },
    stats: {
        children: false,
    },
    plugins: [],
})

mix.js('resources/js/app.js', 'js/app.js')
    .js('resources/js/pages.js', 'js/pages.js')
    .vue({ version: 3 })
    .postCss('resources/css/app.css', 'css/app.css', [
        require('@tailwindcss/postcss'),
    ]).version();