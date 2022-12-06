const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/main.js', 'public/js') // no vue dependency
    .js('resources/js/functions/*.js', 'public/js/functions') // single use scripts
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    // .sass('resources/sass/fixedwh.scss', 'public/css')
    .version(); // cache busting @see https://laravel-mix.com/docs/6.0/versioning
