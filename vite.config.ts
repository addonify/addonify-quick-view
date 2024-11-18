import { resolve } from "path";
import vue from "@vitejs/plugin-vue";
import { v4wp } from "@kucrut/vite-for-wp";
import terser from "@rollup/plugin-terser";
import AutoImport from "unplugin-auto-import/vite";
import Components from "unplugin-vue-components/vite";
import { ElementPlusResolver } from "unplugin-vue-components/resolvers";

export default {
	plugins: [
		vue(),

		v4wp({
			input: "admin/app/src/main.ts",
			outDir: "admin/app/dist",
		}),
		AutoImport({
			resolvers: [ElementPlusResolver()],
		}),
		Components({
			resolvers: [ElementPlusResolver()],
		}),
	],
	resolve: {
		alias: {
			"@": resolve(__dirname, "./admin/app/src"),
		},
	},
	publicDir: false,
	esbuild: {
		//keepNames: true, // Prevent mangling function names
		minifyIdentifiers: false, // Keep function names like `__` intact
	},
	build: {
		sourcemap: false,
		rollupOptions: {
			plugins: [
				terser({
					keep_fnames: /^__$/, // Preserve the function name `__`
					mangle: {
						reserved: ["__"], // Don't mangle the `__` function
					},
				}),
			],
		},
	},
};
