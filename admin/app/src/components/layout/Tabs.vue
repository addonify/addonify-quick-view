<script setup lang="ts">
import { SlidersHorizontal } from "lucide-vue-next";
import { useSettingsStore } from "@/stores/settings";

const store = useSettingsStore();
</script>

<template>
	<div id="app-tabs" class="w-full max-w-[250px] flex flex-col">
		<ul class="p-0 m-0 w-full flex flex-col list-none">
			<li
				v-for="(item, key) in store.settings"
				class="w-full flex flex-row items-center gap-x-2"
			>
				<RouterLink
					to="/"
					class="px-4 py-3 w-full flex flex-row items-center gap-x-2 relative fill-gray-600 text-gray-600 hover:text-blue-500 hover:fill-blue-500 transition-colors duration-300 ease"
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
