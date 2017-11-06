const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.copy('resources/assets/css', 'public/css')
//     .copy('resources/assets/js', 'public/js')
//     .copy('resources/assets/img/icon', 'public/img/icon')
//     .copy('resources/assets/img/image', 'public/img/image');

mix.js('resources/assets/components/cart.js', 'public/js')
    .version();
