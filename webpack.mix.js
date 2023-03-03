const mix = require("laravel-mix");
const ESLintPlugin = require("eslint-webpack-plugin");

// Dependency for ImageminPlugin
// https://webpack.js.org/plugins/copy-webpack-plugin/
const CopyPlugin = require("copy-webpack-plugin");
// Images optimization  via ImageminPlugin
// https://github.com/Klathmon/imagemin-webpack-plugin
const ImageminPlugin = require("imagemin-webpack-plugin").default;

mix.disableSuccessNotifications();

mix.webpackConfig({
	plugins: [
		new ESLintPlugin({
			fix: true,
			extensions: ["js", "vue"],
		}),
		new CopyPlugin({
			patterns: [{ from: "resources/images", to: "images" }],
		}),
		// Note: This will only run via npm run prod. All the copied images
		// will be optimized. This takes a lot of time and resources.
		new ImageminPlugin({
			disable: process.env.NODE_ENV !== "production", // Disable during development
			// Using optipng lossless compression for PNG assets.
			// https://github.com/imagemin/imagemin-optipng
			optipng: {
				optimizationLevel: 2,
			},
			// Optimizing all these types of images which have been copied:
			test: /\.(jpe?g|png|gif|svg)$/i,
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

// Handle favicon.ico
mix.copy("resources/images/favicons/favicon.ico", "public");
// Deploy audio
mix.copyDirectory("resources/audio", "public/audio");
// Copy Bootstrap Icon Fonts (woff & woff2)
mix.copy("node_modules/bootstrap-icons/font/fonts", "public/css/fonts");

// Start mixing JS & SCSS
mix.js("resources/js/app.js", "public/js")
	.js("resources/js/vue.js", "public/js") // vue dependencies
	.js("resources/js/settings/*.js", "public/js/functions/settings.js") // settings functions
	.js("resources/js/switcher/*.js", "public/js/functions/switcher.js") // switcher functions
	.vue()
	.sass("resources/sass/app.scss", "public/css", {
		// Folder structure is already optimal thanks to copyDirectory so there's no need to rewriteUrls:
		processUrls: false,
	})
	.version(); // cache busting @see https://laravel-mix.com/docs/6.0/versioning
