import { defineStore } from "pinia";

/**
 * Settings store.
 *
 * Stores the states of default values/user defined values and,
 * all settings data.
 *
 * @since 1.0.0
 */
export const useSettingsStore = defineStore("settings", {
	state: () => ({
		/**
		 * Option defaults/values data.
		 */
		data: null,

		/**
		 * All settings.
		 */
		settings: null,
	}),

	getters: {},

	actions: {
		/**
		 * Get the settings.
		 *
		 * @returns {Promise<void>}
		 */
		get: async (): Promise<void> => {},

		/**
		 * Update settings.
		 *
		 * @param {any} data
		 * @returns {Promise<any>}
		 */
		update: async (): Promise<void> => {},

		/**
		 * Export settings.
		 *
		 * @param {any} data
		 * @returns {Promise<any>}
		 */
		export: async (): Promise<void> => {},

		/**
		 * Import settings.
		 *
		 * @param {any} data
		 * @returns {Promise<any>}
		 */
		import: async (): Promise<void> => {},

		/**
		 * Reset settings.
		 *
		 * @returns {Promise<any>}
		 */
		reset: async (): Promise<void> => {},
	},
});
