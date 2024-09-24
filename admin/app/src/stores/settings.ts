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
		 * Function to get the settings.
		 *
		 * @returns {Promise<ISettings>}
		 * @since 2.0.0
		 */
		async get(): Promise<ISettings> {
			/**
			 * Set the loading state.
			 */
			this.loading = true;

			const url = "addonify_wishlist_options_api/v2/get_options";

			/**
			 * Use apiFetch to get the settings.
			 */
			const [e, res]: [Error | null, ISettings] = await useFetch(url, "GET");

			if (res && Object.keys(res).length > 0) {
				/**
				 * Set the settings.
				 */
				this.settings = res.tabs;

				/**
				 * Set settings defaults and user defined values.
				 */
				this.data = res.settings_values;

				/**
				 * Clone the data to compare with the settings.
				 */
				this.dataStatic = clone(this.data);
			}

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

			console.log(data);

			/**
			 * Update the settings.
			 */
			const endpoint = "addonify_wishlist_options_api/v2/update_options";

			const [e, res]: [Error | null, any] = await useFetch(endpoint, "POST", {
				data: data,
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
		 * @returns {Promise<any>}
		 */
		async export(): Promise<void> {},

		/**
		 * Import settings.
		 *
		 * @returns {Promise<any>}
		 */
		async import(): Promise<void> {},

		/**
		 * Reset settings.
		 *
		 * @returns {Promise<any>}
		 */
		async reset(): Promise<void> {},
	},
});
