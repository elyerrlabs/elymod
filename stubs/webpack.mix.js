const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
    resolve: {
        alias: {
            "@{{ module }}": path.resolve(__dirname, "resources/js"),
            "@{{ module }}Css": path.resolve(__dirname, "resources/css")
        },
    },
    stats: {
        children: false,
    },
    plugins: [],
})

mix.js('resources/js/app.js', 'js/app.js')
    .vue({ version: 3 })
    .postCss('resources/css/app.css', 'css/app.css', [
        require('@tailwindcss/postcss'),
        require("autoprefixer"),
    ]).version();