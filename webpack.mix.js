const mix = require("laravel-mix");
const ESLintPlugin = require("eslint-webpack-plugin");

mix.disableSuccessNotifications();

mix.webpackConfig({
	plugins: [
		new ESLintPlugin({
			fix: true,
			extensions: ["js", "vue"],
		}),
	],
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

// Copy Bootstrap Icon Fonts (woff & woff2)
mix.copy("node_modules/bootstrap-icons/font/fonts", "public/css/fonts");

// Start mixing JS & SCSS
mix.js("resources/js/app.js", "public/js")
	.js("resources/js/vue.js", "public/js") // vue dependencies
	.js("resources/js/settings/*.js", "public/js/functions/settings.js") // settings functions
	.js("resources/js/switcher/*.js", "public/js/functions/switcher.js") // switcher functions
	.vue()
	.sass("resources/sass/app.scss", "public/css", {
		// Image URLs are absolute paths served from public/, so there is no need to rewrite them:
		processUrls: false,
	})
	.version(); // cache busting @see https://laravel-mix.com/docs/6.0/versioning
