import { defineStore } from "pinia";
import { useFetch } from "@/utils/http";

type Status = "active" | "invalid" | "expired";

interface State {
	status: Status | null;
	key: null | string;
	loading: boolean;
}

/**
 * License store.
 *
 * Handle the license activation, deactivation and validation.
 *
 * @since 1.0.0
 */
export const useLicenseStore = defineStore("license", {
	state: () =>
		<State>{
			/**
			 * The license status.
			 */
			status: null,

			/**
			 * The license key.
			 */
			key: null,

			/**
			 * The loading state.
			 */
			loading: true,
		},

	actions: {
		/**
		 * Get the license key.
		 *
		 * @returns {Promise<any>}
		 * @since 2.0.0
		 */
		async get(): Promise<any> {
			/**
			 * Set the loading state.
			 */
			this.loading = true;

			/**
			 * Endpoint to get the license status.
			 * Requires the pro version.
			 */
			const endpoint = "addonify-quick-view-pro/license";

			/**
			 * Fetch the license.
			 */
			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			/**
			 * Set the states.
			 */
			this.loading = false;

			this.status = res?.status || null;
		},

		/**
		 * Activate the license key.
		 *
		 * @param {string} k The license key.
		 * @returns {Promise<any>}
		 * @since 2.0.0
		 */
		async activate(k: string): Promise<any> {},

		/**
		 * Activate the license key.
		 *
		 * @param {string} k The license key.
		 * @returns {Promise<any>}
		 * @since 2.0.0
		 */
		async deactivate(k: string): Promise<any> {},
	},
});
