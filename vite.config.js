import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import process from "node:process";
import { defineConfig, loadEnv } from "vite";

export default defineConfig(({ command, mode }) => {
	// Vite exposes .env to this file only through loadEnv.
	const env = loadEnv(mode, process.cwd());

	// DDEV injects these into its web container; a local PHP has neither, and
	// then Vite's defaults (localhost:5173) apply.
	// @link https://docs.ddev.com/en/stable/users/usage/vite/
	const ddev = process.env.IS_DDEV_PROJECT === "true";
	const ddevUrl = process.env.DDEV_PRIMARY_URL_WITHOUT_PORT;
	const port = Number(env.VITE_DEV_PORT);
	if (ddev && !port) {
		throw new Error(
			"Set VITE_DEV_PORT in .env to the https port exposed by web_extra_exposed_ports in .ddev/config.yaml."
		);
	}

	return {
		plugins: [
			laravel({
				input: [
					"resources/sass/app.scss",
					"resources/js/app.js",
					"resources/js/board.js",
					"resources/js/settings/index.js",
					"resources/js/switcher/switcher.js",
				],
				refresh: true,
			}),
			vue({
				template: {
					transformAssetUrls: {
						// Absolute URLs in templates (/images/...) are served from
						// public/ as they are; Vite must not turn them into imports:
						base: null,
						includeAbsolute: false,
					},
				},
			}),
		],
		resolve: {
			alias: {
				// The board and the audio settings mount their components from
				// Blade markup, so Vue compiles those templates in the browser:
				vue: "vue/dist/vue.esm-bundler.js",
			},
		},
		// public/ is the web root: the images and the audio are served from /images
		// and /audio as they are. In development Laravel links the stylesheet from
		// the dev server, so the dev server serves public/ itself; in production the
		// web server does, and the build must leave those URLs untouched.
		publicDir: command === "serve" ? "public" : false,
		build: {
			rolldownOptions: {
				external: [/^\/images\//, /^\/audio\//],
			},
		},
		css: {
			preprocessorOptions: {
				scss: {
					// Silences Sass deprecations Bootstrap still triggers;
					// re-audit with a build whenever Bootstrap is updated:
					silenceDeprecations: ["color-functions", "global-builtin", "if-function", "import"],
					loadPaths: ["node_modules"],
				},
			},
		},
		server: ddev
			? {
					// The dev server listens inside the container; the browser
					// reaches it through the DDEV router on the exposed port:
					host: "0.0.0.0",
					port,
					strictPort: true,
					origin: `${ddevUrl}:${port}`,
					cors: { origin: [ddevUrl] },
				}
			: {},
	};
});
