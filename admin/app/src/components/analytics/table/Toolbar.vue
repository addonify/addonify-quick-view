<script setup lang="ts">
import {
	ref,
	reactive,
	computed,
	useTemplateRef,
	onMounted,
	onUnmounted,
} from "vue";
import dayjs from "dayjs";
import { __ } from "@wordpress/i18n";
import { Filter } from "lucide-vue-next";
import { useAnalyticsStore } from "@/stores/analytics";

const store = useAnalyticsStore();

/**
 * Define dropdown state.
 */
const dropdown = ref(false);

/**
 * Define dropdown reference.
 */
const dropdownRef = useTemplateRef("dropdownRef");

const boundaryFilter = useTemplateRef("boundaryFilter");

/**
 * Define dropdown visibility class.
 *
 * @returns {string}
 * @since 2.0.0
 */
const visibClass = computed(() => {
	return dropdown.value
		? "flex visible opacity-100 pointer-events-auto"
		: "hidden opacity-0 pointer-events-none invisible";
});

/**
 * Date range state for filtering.
 *
 * @since 2.0.0
 */
const range = reactive({
	start: "",
	end: "",
});

/**
 * Handle the filter item click event.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleFilter = async (id: number): Promise<void> => {
	/**
	 * Calculate the date range.
	 */
	const date = dayjs();

	switch (id) {
		case 1:
			range.start = date.startOf("day").format("YYYY-MM-DD");
			range.end = date.endOf("day").format("YYYY-MM-DD");
			break;

		case 2:
			range.start = date.startOf("week").format("YYYY-MM-DD");
			range.end = date.endOf("week").format("YYYY-MM-DD");
			break;

		case 3:
			range.start = date.startOf("month").format("YYYY-MM-DD");
			range.end = date.endOf("month").format("YYYY-MM-DD");
			break;

		case 4:
			range.start = date.startOf("year").format("YYYY-MM-DD");
			range.end = date.endOf("year").format("YYYY-MM-DD");
			break;

		default:
			/**
			 * Open the date picker.
			 */
			break;
	}

	/**
	 * Fetch the data.
	 */
	await store.getProductViewCount(20, 0, range.start, range.end);
};

/**
 * Handle the outside click event.
 *
 * @param {MouseEvent} event
 * @returns {void}
 * @since 2.0.0
 */
const hideDropdown = (event: MouseEvent): void => {
	if (
		dropdown.value &&
		!(
			dropdownRef.value &&
			dropdownRef.value.contains(event.target as HTMLElement)
		) &&
		!(
			boundaryFilter.value &&
			boundaryFilter.value.contains(event.target as HTMLElement)
		)
	) {
		dropdown.value = false;
	}
};

/**
 * Hook: Mounted.
 *
 * @since 2.0.0
 */
onMounted(() => {
	/**
	 * Add the event listener.
	 */
	document.addEventListener("click", hideDropdown);
});

/**
 * Hook: onUnmounted.
 *
 * @since 2.0.0
 */
onUnmounted(() => {
	/**
	 * Remove the event listener.
	 */
	document.removeEventListener("click", hideDropdown);
});
</script>
<template>
	<div class="mb-6 w-full flex flex-row gap-6 justify-end relative">
		<div class="flex relative" ref="boundaryFilter">
			<button
				@click="dropdown = !dropdown"
				type="button"
				class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-normal rounded-lg border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none transition-colors duration-300 ease"
			>
				<Filter :size="16" />
				Filters
			</button>

			<aside
				ref="dropdownRef"
				class="px-2 py-3 w-[180px] flex-col gap-1 absolute top-16 right-0 z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
				:class="visibClass"
			>
				<button
					@click="handleFilter(1)"
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("Today", "addonify-quick-view") }}
				</button>

				<button
					@click="handleFilter(2)"
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("This week", "addonify-quick-view") }}
				</button>

				<button
					@click="handleFilter(3)"
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("This month", "addonify-quick-view") }}
				</button>

				<button
					@click="handleFilter(4)"
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("This year", "addonify-quick-view") }}
				</button>

				<button
					@click="handleFilter(6)"
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("Custom date", "addonify-quick-view") }}
				</button>
			</aside>
		</div>

		<div class="flex relative">
			<input
				v-model="store.search"
				type="text"
				placeholder="Search..."
				class="!py-2 !px-4 flex justify-center items-center !max-w-[300px] w-full !rounded-lg text-sm !font-normal !shadow-sm !disabled:pointer-events-none !bg-white !border focus:ring-1 disabled:opacity-50 !text-gray-700 !placeholder-gray-500 !border-gray-200 focus:border-blue-500 focus:ring-blue-500"
			/>
		</div>
	</div>
</template>
