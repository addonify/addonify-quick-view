<script setup lang="ts">
import dayjs from "dayjs";
import { ref, computed } from "vue";
import { __ } from "@wordpress/i18n";
import { useAnalyticsStore } from "@/stores/analytics";

const store = useAnalyticsStore();

const range = ref("");

const date = dayjs();

/**
 * Date shortcuts.
 *
 * @returns {Record<string, any>[]}
 * @since 2.0.0
 */
const shortcuts = computed(() => {
	const options = [
		{
			text: __("Today", "addonify-quick-view"),
			value: () => {
				const start = date.startOf("day").format("YYYY-MM-DD");
				const end = date.endOf("day").format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("Yesterday", "addonify-quick-view"),
			value: () => {
				const start = date
					.subtract(1, "day")
					.startOf("day")
					.format("YYYY-MM-DD");
				const end = date.subtract(1, "day").endOf("day").format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("This Week", "addonify-quick-view"),
			value: () => {
				const start = date.startOf("week").format("YYYY-MM-DD");
				const end = date.endOf("week").format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("Last Week", "addonify-quick-view"),
			value: () => {
				const start = date
					.subtract(1, "week")
					.startOf("week")
					.format("YYYY-MM-DD");
				const end = date.subtract(1, "week").endOf("week").format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("This Month", "addonify-quick-view"),
			value: () => {
				const start = date.startOf("month").format("YYYY-MM-DD");
				const end = date.endOf("month").format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("Last Month", "addonify-quick-view"),
			value: () => {
				const start = date
					.subtract(1, "month")
					.startOf("month")
					.format("YYYY-MM-DD");
				const end = date
					.subtract(1, "month")
					.endOf("month")
					.format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("This Year", "addonify-quick-view"),
			value: () => {
				const start = date.startOf("year").format("YYYY-MM-DD");
				const end = date.endOf("year").format("YYYY-MM-DD");
				return [start, end];
			},
		},
		{
			text: __("Last Year", "addonify-quick-view"),
			value: () => {
				const start = date
					.subtract(1, "year")
					.startOf("year")
					.format("YYYY-MM-DD");
				const end = date.subtract(1, "year").endOf("year").format("YYYY-MM-DD");
				return [start, end];
			},
		},
	];

	return options;
});

/**
 * Handle the filter item click event.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleFilter = async (val: string[]): Promise<void> => {
	const date = (str: string): string | null => {
		return dayjs(str).format("YYYY-MM-DD") || null;
	};

	const start = (val && date(val[0])) || null;

	const end = (val && date(val[1])) || null;

	/**
	 * Fetch the data.
	 */
	await store.getProductViewCount(20, 0, start, end);
};
</script>
<template>
	<div class="mb-6 w-full flex flex-row gap-6 justify-end relative">
		<div class="flex relative" data-input="datepicker">
			<el-date-picker
				v-model="range"
				@change="handleFilter"
				:shortcuts="shortcuts"
				type="daterange"
				unlink-panels
				editable
				clearable
				format="YYYY-MM-DD"
				value-format="YYYY-MM-DD"
				range-separator="To"
				start-placeholder="Start date"
				end-placeholder="End date"
				size="large"
			/>
		</div>

		<div class="flex relative">
			<input
				v-model="store.search"
				type="text"
				placeholder="Search..."
				class="!py-2 !px-4 flex justify-center items-center !max-w-[300px] w-full !rounded-lg text-sm !font-normal !shadow-sm !disabled:pointer-events-none !bg-white !border focus:ring-1 disabled:opacity-50 !text-gray-700 !placeholder-gray-500 !border-gray-200 focus:ring-blue-500 focus:border-blue-500 focus:ring-offset-2"
			/>
		</div>
	</div>
</template>
