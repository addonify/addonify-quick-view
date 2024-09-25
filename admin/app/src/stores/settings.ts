import { defineStore } from "pinia";
import { __ } from "@wordpress/i18n";
import { useFetch } from "@/utils/http";
import { isEqual, clone } from "@/utils/helpers";

import type { ISettings, SettingValue } from "@/app";

/**
 * Interface for the settings store state.
 *
 * @since 2.0.0
 */
interface State {
	data: SettingValue | null;
	dataStatic: SettingValue | null;
	settings: ISettings | null;
	loading: boolean;
	saving: boolean;
}

const nonce = window.addonifyQuickViewLocals.nonce;

/**
 * Settings store.
 *
 * Stores the states of default values/user defined values and,
 * all settings data.
 *
 * @since 1.0.0
 */
export const useSettingsStore = defineStore("settings", {
	state: () =>
		<State>{
			/**
			 * Option defaults/values data.
			 * This is a reactive state and will be updated when the user changes the settings.
			 */
			data: null,

			/**
			 * Non reactive data.
			 * This state is the initial clone of "data" state.
			 */
			dataStatic: null,

			/**
			 * All settings.
			 */
			settings: null,

			/**
			 * Loading flag when fetching settings.
			 */
			loading: true,

			/**
			 * Saving flag when saving settings.
			 */
			saving: false,
		},

	getters: {
		/**
		 * Check if there are any changes in the settings.
		 * Use lodash function "isEqual()" to compare the objects.
		 *
		 * @param {State} state
		 * @returns {boolean}
		 * @since 2.0.0
		 */
		haveChanges: (state: State): boolean => {
			return isEqual(state.data, state.dataStatic) ? false : true;
		},
	},

	actions: {
		/**
		 * Get the settings reactive data and settings fields.
		 *
		 * Updates the states.
		 *
		 * @returns {Promise<ISettings>}
		 * @since 2.0.0
		 */
		async get(): Promise<ISettings> {
			/**
			 * Set the loading state.
			 */
			this.loading = true;

			const url = "addonify-quick-view/v2/options";

			/**
			 * Use apiFetch to get the settings.
			 */
			const [e, res]: [Error | null, ISettings] = await useFetch(url, "GET");

			console.log(res);

			if (e || !res || !Object.keys(res).length) {
				throw new Error(
					__("Failed, fetching settings.", "addonify-quick-view")
				);
			}

			/**
			 * Set the settings.
			 */
			this.settings = res.data.tabs;

			/**
			 * Set settings defaults and user defined values.
			 */
			this.data = res.data.settings_values;

			/**
			 * Clone the data to compare with the settings.
			 */
			this.dataStatic = clone(this.data);

			/**
			 * Set the loading state.
			 */
			this.loading = false;

			return res;
		},

		/**
		 * Update settings.
		 *
		 * Check for the changes and update the settings.
		 *
		 * If the update is successful, update the "data" and "dataStatic" states.
		 *
		 * @returns {Promise<boolean>}
		 * @since 2.0.0
		 */
		async update(): Promise<boolean> {
			/**
			 * Set the saving state.
			 */
			this.saving = true;

			/**
			 * Find the options to be updated comparing with the dataStatic.
			 */
			const data: SettingValue = new Object();

			for (const k in this.data) {
				if (!isEqual(this.data[k], this.dataStatic[k])) {
					data[k] = this.data[k];
				}
			}

			/**
			 * Update the settings.
			 */
			const endpoint = "addonify_wishlist_options_api/v2/update_options";

			const [e, res]: [Error | null, any] = await useFetch(endpoint, "POST", {
				data: {
					settings_values: data,
				},
			});

			/**
			 * Set the saving state.
			 */
			this.saving = false;

			if (e || !res || !res.success) {
				throw new Error(__("Failed updating settings.", "addonify-quick-view"));
			}

			/**
			 * Update the "dataStatic" states.
			 */
			this.dataStatic = new Object();

			this.dataStatic = clone(this.data);

			return true;
		},

		/**
		 * Export settings.
		 *
		 * Get the JSON file link to download.
		 *
		 * Init the download process programmatically.
		 *
		 * @returns {Promise<boolean>}
		 * @since 2.0.0
		 */
		async export(): Promise<boolean> {
			/**
			 * Export the settings.
			 */
			const endpoint = "addonify_wishlist_options_api/v2/export";

			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			if (e || !res || !res.success) {
				throw new Error(
					__("Failed, exporting settings.", "addonify-quick-view")
				);
			}

			const url: string = res.url;

			/**
			 * Create the JSON file link.
			 */
			let link = document.createElement("a");

			link.href = url;

			const name = `addonify-quick-view-settings-${new Date().getDate()}.json`;

			link.setAttribute("download", name);

			document.body.appendChild(link);

			link.click();

			return true;
		},

		/**
		 * Import settings.
		 *
		 * Upload the JSON file to the rest api endpoint.
		 *
		 * @param {FormData} data
		 * @returns {Promise<boolean>}
		 * @since 2.0.0
		 */
		async import(data: FormData): Promise<boolean> {
			/**
			 * Import the settings.
			 */
			const endpoint = "addonify_wishlist_options_api/v2/import";

			const [e, res]: [Error | null, any] = await useFetch(endpoint, "POST", {
				data: data,
			});

			if (e || !res || !res.success) {
				throw new Error(
					__("Failed, importing settings.", "addonify-quick-view")
				);
			}

			return true;
		},

		/**
		 * Reset settings.
		 *
		 * Sets the settings to default values.
		 *
		 * @returns {Promise<boolean>}
		 * @since 2.0.0
		 */
		async reset(): Promise<boolean> {
			return true;
		},
	},
});
