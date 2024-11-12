import { defineStore } from "pinia";
import { useFetch } from "@/utils/http";

type Status = "inactive" | "active" | "expired" | "disabled";

interface LicenseData {
	status: Status;
	license?: string;
	expires: string;
	limit: number;
	activationLeft: string;
}

interface State {
	license: null | string;
	data: LicenseData | null;
	loading: boolean;
}

interface GetLicenseResponse {
	success: boolean;
	data: {
		license: string;
	} | null;
}

interface CheckLicenseResponse {
	success: boolean;
	data: null;
	message?: string;
}

interface ActivateLicenseResponse {
	success: boolean;
	message?: string;
	data: LicenseData | null;
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
			 * The license key.
			 */
			license: null,

			/**
			 * The license related data.
			 */
			data: null,

			/**
			 * The loading state.
			 */
			loading: true,
		},

	getters: {
		/**
		 * Get the license data.
		 *
		 * @param {State} state The state.
		 * @returns {LicenseData} The license data.
		 * @since 2.0.0
		 */
		getData(state: State): Record<string, any> {
			return {
				license: state.license || null,
				status: state.data?.status || "inactive",
			};
		},

		/**
		 * Get the license renewal link.
		 *
		 * @param {State} state The state.
		 * @returns {string | null} The renewal link.
		 * @since 2.0.0
		 */
		renewalLink(state: State): string | null {
			if (!state.data || state?.data?.status !== "expired") {
				return null;
			}
			return `https://creamcode.org/checkout/?edd_license_key=${state.license}&download_id=51441`;
		},
	},

	actions: {
		/**
		 * Get the license key.
		 *
		 * @returns {Promise<GetLicenseResponse | null>}
		 * @since 2.0.0
		 */
		async get(): Promise<GetLicenseResponse | null> {
			/**
			 * Set the loading state.
			 */
			this.loading = true;

			/**
			 * Endpoint to get the license status.
			 */
			const endpoint = "addonify-quick-view-pro/license";

			/**
			 * Fetch the license.
			 */
			const [e, res]: [Error | null, GetLicenseResponse] = await useFetch(
				endpoint,
				"GET"
			);

			/**
			 * Set the states.
			 */
			this.loading = false;

			this.license = res?.data?.license || null;

			return res || null;
		},

		/**
		 * Check the license status.
		 *
		 * @returns {Promise<CheckLicenseResponse | null>}
		 * @since 2.0.0
		 */
		async check(): Promise<CheckLicenseResponse | null> {
			/**
			 * Endpoint to get the license status.
			 * Requires the pro version.
			 */
			const endpoint = "addonify-quick-view-pro/license/check";

			/**
			 * Fetch the license.
			 */
			const [e, res]: [Error | null, CheckLicenseResponse] = await useFetch(
				endpoint,
				"GET"
			);

			if (e || !res) {
				return;
			}

			if (res?.success) {
				this.data = res.data || null;
			}

			return res || null;
		},

		/**
		 * Activate the license key.
		 *
		 * @param {string} license The license key.
		 * @returns {Promise<ActivateLicenseResponse | null>}
		 * @since 2.0.0
		 */
		async activate(license: string): Promise<ActivateLicenseResponse | null> {
			/**
			 * Set the loading state.
			 */
			this.loading = true;

			/**
			 * Endpoint to get the license status.
			 * Requires the pro version.
			 */
			const endpoint = "addonify-quick-view-pro/license/activate";

			/**
			 * Fetch the license.
			 */
			const [e, res]: [Error | null, ActivateLicenseResponse] = await useFetch(
				endpoint,
				"POST",
				{
					data: { license },
				}
			);

			this.loading = false;

			if (e || !res || !res.success) {
				return res;
			}

			/**
			 * Set the states.
			 */
			this.status = res?.data?.status || "inactive";
			this.license = res.data?.license || null;

			return res || null;
		},

		/**
		 * Activate the license key.
		 *
		 * @param {string} license The license key.
		 * @returns {Promise<any>}
		 * @since 2.0.0
		 */
		async deactivate(license: string): Promise<any> {
			/**
			 * Set the loading state.
			 */
			this.loading = true;

			/**
			 * Endpoint to get the license status.
			 * Requires the pro version.
			 */
			const endpoint = "addonify-quick-view-pro/license/deactivate";

			/**
			 * Fetch the license.
			 */
			const [e, res]: [Error | null, ActivateLicenseResponse] = await useFetch(
				endpoint,
				"POST",
				{
					data: { license },
				}
			);

			this.loading = false;

			if (e || !res || !res.success) {
				return res;
			}

			/**
			 * Set the states.
			 */
			this.license = null;

			this.data = null;

			return res || null;
		},
	},
});
