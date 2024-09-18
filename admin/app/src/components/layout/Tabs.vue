<script setup lang="ts">
import { SlidersHorizontal } from "lucide-vue-next";
import { useSettingsStore } from "@/stores/settings";

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
		<ul class="p-0 m-0 w-full flex flex-col gap-2 list-none">
			<li
				v-for="(item, key) in store.settings"
				:key="key"
				class="w-full flex flex-row items-center gap-x-2"
			>
				<RouterLink
					:to="getLink(key)"
					activeClass="bg-white text-blue-500 fill-blue-500 shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
					class="p-4 w-full flex flex-row items-center gap-x-2 relative text-md font-normal font-sans fill-gray-600 text-gray-600 hover:text-blue-500 hover:fill-blue-500 transition-colors duration-300 ease rounded-lg rounded-e-none focus:outline-none focus:shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
				>
					<span class="size-6 inline-flex items-center relative leading-3">
						<span
							v-if="item.icon && item.icon.length > 0"
							v-html="item.icon"
						></span>

						<template v-else>
							<SlidersHorizontal
								:size="20"
								:stroke-width="2"
								class="leading-3"
							/>
						</template>
					</span>

					<span>{{ item.title }}</span>
				</RouterLink>
			</li>
		</ul>
	</div>
</template>
