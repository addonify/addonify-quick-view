import { defineStore } from "pinia";
import { useFetch, useExtFetch } from "@/utils/http";

import type { Products, InstalledAddon, RecommendationData } from "@/app";

interface State {
	recommended: null | Products[];
	installed: InstalledAddon[];
}

/**
 * Products store.
 *
 * Handle the recommended products, addons installed in the site and manage the addons.
 *
 * @since 1.0.0
 */
export const useProductStore = defineStore("products", {
	state: () =>
		<State>{
			recommended: null,
			installed: [],
		},
	actions: {
		/**
		 * Get the list of recommended plugins from GitHub.
		 *
		 * @returns {Promise<RecommendationData>}
		 * @since 2.0.0
		 */
		async getList(): Promise<RecommendationData> {
			/**
			 * The source of the recommended plugins list.
			 */
			const src =
				"https://raw.githubusercontent.com/addonify/recommended-products/main/products.json";

			const [e, result]: [Error | null, RecommendationData] = await useExtFetch(
				src,
				"GET"
			);

			if (e) {
				throw new Error(e.message || "Failed to get recommended plugins list.");
			}

			if (!result || !Object.keys(result).length) {
				throw new Error("Failed to get recommended plugins list.");
			}

			/**
			 * Set the installed addons.
			 */
			if (result.data && result.data.hot) {
				this.recommended = result.data.hot;
			}

			return result;
		},

		/**
		 * Get the list of installed addons in the site.
		 *
		 * @returns {Promise<InstalledAddon[]>}
		 * @since 2.0.0
		 */
		async getAddons(): Promise<InstalledAddon[]> {
			const [e, data]: [Error | null, any] = await useFetch(
				"/wp/v2/plugins",
				"GET"
			);

			if (e) {
				throw new Error(e.message || "Failed to get recommended plugins list.");
			}

			if (!data || !data.length) {
				throw new Error("Failed to get recommended plugins list.");
			}

			/**
			 * Set the installed addons.
			 */
			this.installed = data;

			return data;
		},

		/**
		 * Install the addon in the site.
		 *
		 * @param {string} slug
		 * @returns {Promise<any>}
		 * @since 2.0.0
		 */
		async install(slug: string): Promise<any> {
			const path = "/wp/v2/plugins";

			const [e, data]: [Error | null, any] = await useFetch(path, "POST", {
				data: { slug, status: "active" },
			});

			if (e) {
				throw new Error(e.message || "Failed to install the plugin.");
			}

			if (!data || !Object.keys(data).length) {
				throw new Error("Failed to install the plugin.");
			}

			/**
			 * Update the state of installed addons.
			 */
			await this.getAddons().catch(() => null);

			return data;
		},

		/**
		 * Activate the addon status.
		 * Set "active".
		 *
		 * @param {string} slug
		 * @returns {Promise<any>}
		 * @since 2.0.0
		 */
		async activate(slug: string): Promise<any> {
			const path = "/wp/v2/plugins/" + slug;

			slug = slug + "/" + slug;

			const [e, data]: [Error | null, any] = await useFetch(path, "POST", {
				data: { plugin: slug, status: "active" },
			});

			if (e) {
				throw new Error(e.message || "Failed to activate the plugin.");
			}

			if (!data || !Object.keys(data).length) {
				throw new Error("Failed to activate the plugin.");
			}

			/**
			 * Update the state of installed addons.
			 */
			await this.getAddons().catch(() => null);

			return data;
		},
	},
});
