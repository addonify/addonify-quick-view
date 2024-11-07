import dayjs from "dayjs";
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
	search: string;
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
			 * Search for the tabular data.
			 */
			search: "",

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
			 * Prepare the query params.
			 */
			const query = new URLSearchParams();

			/**
			 * Get the start date.
			 * If the start date is not provided, then get the date 15 days ago.
			 *
			 * @returns {string} The start date.
			 */
			const startDate = (): string => {
				const date = start || dayjs().subtract(15, "day").format("YYYY-MM-DD");
				return dayjs(date).format("YYYY-MM-DD");
			};

			/**
			 * Get the end date.
			 * If the end date is not provided, then get the current date.
			 *
			 * @returns {string} The end date.
			 */
			const endDate = (): string => {
				const date = end || dayjs().format("YYYY-MM-DD");
				return dayjs(date).format("YYYY-MM-DD");
			};

			query.set("start", startDate());

			query.set("end", endDate());

			/**
			 * Endpoint to get the views.
			 * Requires the pro version.
			 */
			const endpoint = `addonify-quick-view-pro/stats/chart?${query.toString()}`;

			/**
			 * Use apiFetch to get the views count.
			 */
			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			/**
			 * Set the chart data.
			 */
			this.chart = res?.data || null;

			/**
			 * Set the loading state to false.
			 */
			this.loading.chart = false;

			if (e || !res || !res.success || !res.data) {
				return null;
			}

			return res.data;
		},

		/**
		 * Get product view counts.
		 *
		 * @param {string | number} limit
		 * @param {string | number} offset
		 * @param {string | null} start - The start date.
		 * @param {string | null} end - The end date.
		 * @returns {Promise<Response>}
		 * @since 2.0.0
		 */
		async getViewCount(
			limit: string | number = 20,
			offset: string | number = 0,
			start: string | null = null,
			end: string | null = null
		): Promise<Response> {
			/**
			 * Set the loading state to true.
			 */
			this.loading.product = true;

			/**
			 * Prepare the query params.
			 */
			const query = new URLSearchParams({
				limit: limit.toString(),
				offset: offset.toString(),
			});

			if (start && start.length > 0) {
				query.set("start", dayjs(start).format("YYYY-MM-DD"));
			}

			if (end && end.length > 0) {
				query.set("end", dayjs(end).format("YYYY-MM-DD"));
			}

			/**
			 * Endpoint to get the views.
			 * Requires the pro version.
			 */
			const endpoint = `addonify-quick-view-pro/stats/products?${query.toString()}`;

			/**
			 * Use apiFetch to get the views count.
			 */
			const [e, res]: [Error | null, any] = await useFetch(endpoint, "GET");

			/**
			 * Set the loading state to false.
			 */
			this.loading.product = false;

			/**
			 * Set the chart data.
			 */
			this.product = res?.data || null;

			if (e || !res || !res.success || !res.data) {
				return null;
			}

			return res.data;
		},
	},
});
