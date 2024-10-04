<script setup lang="ts">
import { ref, computed, useTemplateRef, watchEffect } from "vue";
import { __ } from "@wordpress/i18n";
import { Filter } from "lucide-vue-next";

const dropdown = ref(false);

const dropdownRef = useTemplateRef("dropdownRef");

const vClass = computed(() => {
	return dropdown.value
		? "flex visible opacity-100 pointer-events-auto"
		: "hidden opacity-0 pointer-events-none invisible";
});

watchEffect(() => {
	/**
	 * Hide the dropdown when clicked outside.
	 */
});
</script>
<template>
	<div class="mb-6 w-full flex flex-row gap-6 justify-end relative">
		<div class="flex relative">
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
				class="p-3 w-[180px] flex-col gap-1 absolute top-16 right-0 z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
				:class="vClass"
			>
				<button
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("Today", "addonify-quick-view") }}
				</button>

				<button
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("This week", "addonify-quick-view") }}
				</button>

				<button
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("This month", "addonify-quick-view") }}
				</button>

				<button
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("This year", "addonify-quick-view") }}
				</button>

				<button
					class="px-3 py-3 w-full inline-flex text-sm bg-transparent text-gray-600 hover:bg-gray-100 rounded-lg leading-3 transition-colors duration-300 ease"
				>
					{{ __("Custom date", "addonify-quick-view") }}
				</button>
			</aside>
		</div>
		<div class="flex relative">
			<input
				type="text"
				placeholder="Search..."
				class="!py-2 !px-4 flex justify-center items-center !max-w-[300px] w-full !rounded-lg text-sm !font-normal !shadow-sm !disabled:pointer-events-none !bg-white !border focus:ring-1 disabled:opacity-50 !text-gray-700 !placeholder-gray-500 !border-gray-200 focus:border-blue-500 focus:ring-blue-500"
			/>
		</div>
	</div>
</template>
