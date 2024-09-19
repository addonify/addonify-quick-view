import { defineStore } from "pinia";
import { useFetch } from "@/utils/http";
import { isEqual } from "@/utils/helpers";

import type { ISettings, SettingValue } from "@/app";

/**
 * Interface for the settings store state.
 *
 * @since 2.0.0
 */
interface State {
	data: SettingValue | null;
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
			 */
			data: null,

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
			return isEqual(state.data, state.settings) ? false : true;
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
		 * @param {any} data
		 * @returns {Promise<any>}
		 */
		async update(): Promise<void> {},

		/**
		 * Export settings.
		 *
		 * @param {any} data
		 * @returns {Promise<any>}
		 */
		async export(): Promise<void> {},

		/**
		 * Import settings.
		 *
		 * @param {any} data
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
