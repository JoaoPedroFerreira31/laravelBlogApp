const mix = require('laravel-mix');
require('laravel-mix-serve');
// const WebpackShellPlugin = require('webpack-shell-plugin');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// // Add shell command plugin configured to create JavaScript language file
// mix.webpackConfig({
//     plugins: [
//         new WebpackShellPlugin({onBuildStart:['php artisan lang:js --quiet'], onBuildEnd:[]})
//     ]
// });



mix.serve('php artisan lang:js');
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/utils.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ]
);
