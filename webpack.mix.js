const mix = require('laravel-mix');

const ESLintPlugin = require('eslint-webpack-plugin');

mix.disableSuccessNotifications();

mix.webpackConfig({
    plugins: [new ESLintPlugin({
        fix: true,
        extensions: ['js', 'vue'],
    })],
});

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

mix.copyDirectory('resources/images', 'public/images')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/vue.js', 'public/js') // vue dependencies
    .js('resources/js/settings/*.js', 'public/js/functions/settings.js') // single use scripts
    .vue()
    .sass('resources/sass/app.scss', 'public/css', {
        // Folder structure is already optimal thanks to copyDirectory so there's no need to rewriteUrls:
        processUrls: false,
    })
    // .sass('resources/sass/fixedwh.scss', 'public/css')
    .version(); // cache busting @see https://laravel-mix.com/docs/6.0/versioning
