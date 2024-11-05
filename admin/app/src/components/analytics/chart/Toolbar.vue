<script setup lang="ts">
import dayjs from "dayjs";
import { ref, computed } from "vue";
import { __ } from "@wordpress/i18n";
import { Filter, CalendarFold } from "lucide-vue-next";
import { useAnalyticsStore } from "@/stores/analytics";

const store = useAnalyticsStore();

const range: string | null = ref(null);

/**
 * Handle the filter item click event.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleFilter = async (val: string): Promise<void> => {
	/**
	 * Return the start and end date in the format of YYYY-MM-DD.
	 *
	 * @returns {string[]} The start and end date.
	 * @since 2.0.0
	 */
	const date = (): string[] => {
		const date = dayjs();

		switch (val) {
			case "today":
				return [date.format("YYYY-MM-DD"), date.format("YYYY-MM-DD")];
			case "yesterday":
				return [
					date.subtract(1, "day").format("YYYY-MM-DD"),
					date.subtract(1, "day").format("YYYY-MM-DD"),
				];
			case "this-week":
				return [
					date.startOf("week").format("YYYY-MM-DD"),
					date.endOf("week").format("YYYY-MM-DD"),
				];
			case "last-week":
				return [
					date.startOf("week").subtract(1, "week").format("YYYY-MM-DD"),
					date.endOf("week").subtract(1, "week").format("YYYY-MM-DD"),
				];
			case "last-month":
				return [
					date.startOf("month").subtract(1, "month").format("YYYY-MM-DD"),
					date.endOf("month").subtract(1, "month").format("YYYY-MM-DD"),
				];
			case "this-month":
				return [
					date.startOf("month").format("YYYY-MM-DD"),
					date.endOf("month").format("YYYY-MM-DD"),
				];
			default:
				return [];
		}
	};

	const start = date()[0] ? date()[0] : null;

	const end = date()[1] ? date()[1] : null;

	/**
	 * Set the range.
	 */
	range.value = `${start || ""} - ${end || ""}`;

	/**
	 * Fetch the chart data.
	 */
	await store.getChart(start, end);
};
</script>
<template>
	<div class="mb-6 w-full flex flex-row gap-6 justify-end relative">
		<div class="relative flex items-center gap-x-3">
			<p
				v-if="range && range.length > 0"
				class="m-0 p-0 inline-flex items-center gap-x-2 font-normal text-sm text-gray-400"
			>
				<CalendarFold size="18" />
				{{ range }}
			</p>

			<el-dropdown>
				<span
					class="el-dropdown-link py-3 px-4 inline-flex items-center gap-x-2 text-sm font-normal rounded-lg border border-gray-200 bg-white text-gray-600 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
				>
					<Filter size="18" />
					{{ __("Filter", "addonify-quick-view") }}
				</span>

				<template #dropdown>
					<el-dropdown-menu>
						<el-dropdown-item
							@click="handleFilter('today')"
							class="font-sans font-normal text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300 ease"
						>
							Today
						</el-dropdown-item>

						<el-dropdown-item
							@click="handleFilter('yesterday')"
							class="font-sans font-normal text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300 ease"
						>
							Yesterday
						</el-dropdown-item>

						<el-dropdown-item
							@click="handleFilter('this-week')"
							class="font-sans font-normal text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300 ease"
						>
							This week
						</el-dropdown-item>

						<el-dropdown-item
							@click="handleFilter('last-week')"
							class="font-sans font-normal text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300 ease"
						>
							Last week
						</el-dropdown-item>

						<el-dropdown-item
							@click="handleFilter('last-month')"
							class="font-sans font-normal text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300 ease"
						>
							Last month
						</el-dropdown-item>

						<el-dropdown-item
							@click="handleFilter('this-month')"
							divided
							class="font-sans font-normal text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300 ease"
						>
							This month
						</el-dropdown-item>
					</el-dropdown-menu>
				</template>
			</el-dropdown>
		</div>
	</div>
</template>
