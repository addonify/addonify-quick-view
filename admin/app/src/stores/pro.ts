import { defineStore } from "pinia";
import { useFetch } from "@/utils/http";

interface State {
	active: boolean;
	version: string | null;
	license: boolean;
}

/**
 * Store that checks if the premium version is installed.
 *
 * Handle the recommended products, addons installed in the site and manage the addons.
 *
 * @since 1.0.0
 */
export const useProStore = defineStore("proAddon", {
	state: () =>
		<State>{
			/**
			 * @state status - The status of the pro version. Installed or not.
			 */
			active: false,

			/**
			 * @state version - The version of the pro version if installed.
			 */
			version: null,

			/**
			 * @state license - If the license is stored in db.
			 */
			license: false,
		},

	actions: {
		/**
		 * Call the pro endpoint to check if the pro version is installed.
		 *
		 * @returns {Promise<void>}
		 * @since 2.0.0
		 */
		async ping(): Promise<void> {
			const endpoint = "addonify-quick-view-pro/ping";

			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			if (e || !res || !Object.keys(res).length) {
				return;
			}

			/**
			 * Set the states.
			 */
			this.active = res?.active || false;
			this.version = res?.version || null;
			this.license = res?.license || false;
		},
	},
});
