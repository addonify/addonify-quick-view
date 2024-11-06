<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { useSettingsStore } from "@/stores/settings";
import {
	FileLock2,
	Coffee,
	SlidersHorizontal,
	ChartSpline,
} from "lucide-vue-next";

const store = useSettingsStore();

/**
 * Get the router link.
 *
 * @param {number} path
 * @returns {string}
 * @since 2.0.0
 */
const getLink = (path: number): string => "/s/" + path;
</script>

<template>
	<div id="app-tabs" class="w-full max-w-[250px] flex flex-col">
		<ul class="p-0 m-0 w-full flex flex-col gap-1 list-none">
			<li
				v-for="(item, k) in store.settings"
				:key="k"
				class="p-0 m-0 w-full flex flex-row items-center gap-x-2"
			>
				<RouterLink
					:to="getLink(k)"
					class="p-4 w-full flex flex-row items-center gap-x-2 relative text-md font-normal font-sans fill-gray-600 text-gray-700 hover:text-blue-500 hover:fill-blue-500 transition-colors duration-300 ease rounded-lg rounded-e-none focus:outline-none focus:shadow-none"
				>
					<span
						v-if="item.icon && item.icon.length > 0"
						v-html="item.icon"
						class="size-6 inline-flex items-center relative leading-3"
					>
					</span>
					<template v-else>
						<SlidersHorizontal
							:size="20"
							:stroke-width="2"
							class="size-6 inline-flex items-center relative leading-3"
						/>
					</template>

					<span>{{ item.title }}</span>
				</RouterLink>
			</li>

			<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
				<RouterLink
					to="/analytics"
					class="p-4 w-full flex flex-row items-center gap-x-2 relative text-md font-normal font-sans fill-gray-600 text-gray-700 hover:text-blue-500 hover:fill-blue-500 transition-colors duration-300 ease rounded-lg rounded-e-none focus:outline-none focus:shadow-none"
				>
					<span class="size-6 inline-flex items-center relative leading-3">
						<ChartSpline :size="24" :stroke-width="2" class="leading-3" />
					</span>

					<span>{{ __("Analytics", "addonify-quick-view") }}</span>
				</RouterLink>
			</li>

			<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
				<RouterLink
					to="/products"
					class="p-4 w-full flex flex-row items-center gap-x-2 relative text-md font-normal font-sans fill-gray-600 text-gray-700 hover:text-blue-500 hover:fill-blue-500 transition-colors duration-300 ease rounded-lg rounded-e-none focus:outline-none focus:shadow-none"
				>
					<span class="size-6 inline-flex items-center relative leading-3">
						<Coffee :size="24" :stroke-width="2" class="leading-3" />
					</span>

					<span>{{ __("Products", "addonify-quick-view") }}</span>
				</RouterLink>
			</li>

			<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
				<RouterLink
					to="/license"
					class="p-4 w-full flex flex-row items-center gap-x-2 relative text-md font-normal font-sans fill-gray-600 text-gray-700 hover:text-blue-500 hover:fill-blue-500 transition-colors duration-300 ease rounded-lg rounded-e-none focus:outline-none focus:shadow-none"
				>
					<span class="size-6 inline-flex items-center relative leading-3">
						<FileLock2 :size="24" :stroke-width="2" class="leading-3" />
					</span>

					<span>{{ __("License", "addonify-quick-view") }}</span>
				</RouterLink>
			</li>
		</ul>
	</div>
</template>
