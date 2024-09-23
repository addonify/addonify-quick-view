import { resolve } from "path";
import vue from "@vitejs/plugin-vue";
import { v4wp } from "@kucrut/vite-for-wp";
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
	build: { sourcemap: false },
};
