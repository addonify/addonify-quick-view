import { defineStore } from "pinia";
import { useFetch } from "@/utils/http";

import type {
	ProductsViewsCount,
	ProductsViewsCountResponse,
	ViewCountChartDataResponse,
} from "@/app";

/**
 * Interface for the analytics store state.
 *
 * @since 2.0.0
 */
interface State {
	chart: ViewCountChartDataResponse | null;
	product: ProductsViewsCountResponse | null;
	loading: {
		chart: boolean;
		product: boolean;
	};
}

/**
 * Analytics store.
 *
 *
 * @since 1.0.0
 */
export const useAnalyticsStore = defineStore("analytics", {
	state: () =>
		<State>{
			/**
			 * State that stores the product views count data.
			 */
			chart: null,

			/**
			 * State that stores the product views count data.
			 */
			product: null,

			/**
			 * Loading state.
			 */
			loading: {
				chart: false,
				product: false,
			},
		},

	actions: {
		/**
		 * Get view counts data for chart.
		 *
		 * @param {string | null} start - The start date.
		 * @param {string | null} end - The end date.
		 * @returns {Promise<Response>}
		 * @since 2.0.0
		 */
		async getChart(
			start: string | null = null,
			end: string | null = null
		): Promise<Response> {
			/**
			 * Set the loading state to true.
			 */
			this.loading.chart = true;

			/**
			 * Endpoint to get the views.
			 * Requires the pro version.
			 */
			const endpoint = "addonify-quick-view-pro/stats/chart";

			/**
			 * Use apiFetch to get the views count.
			 */
			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			if (e || !res || !res.success || !res.data) {
				throw new Error(e.message || "Failed to get chart data.");
			}

			/**
			 * Set the chart data.
			 */
			this.chart = res.data;

			/**
			 * Set the loading state to false.
			 */
			this.loading.chart = false;

			return res.data;
		},

		/**
		 * Get product view counts.
		 *
		 * @param {string} start - The start date.
		 * @param {string} end - The end date.
		 * @returns {Promise<Response>}
		 * @since 2.0.0
		 */
		async getProductViewCount(): Promise<Response> {
			/**
			 * Set the loading state to true.
			 */
			this.loading.product = true;

			/**
			 * Endpoint to get the views.
			 * Requires the pro version.
			 */
			const endpoint = "addonify-quick-view-pro/stats/products";

			/**
			 * Use apiFetch to get the views count.
			 */
			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			if (e || !res || !res.success || !res.data) {
				throw new Error(e.message || "Failed to get products view count.");
			}

			/**
			 * Set the chart data.
			 */
			this.product = res.data;

			/**
			 * Set the loading state to false.
			 */
			this.loading.product = false;

			return res.data;
		},
	},
});
