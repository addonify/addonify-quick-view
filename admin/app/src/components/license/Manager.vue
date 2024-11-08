<script setup lang="ts">
import { ref, computed } from "vue";
import { __ } from "@wordpress/i18n";
import { Key, ExternalLink } from "lucide-vue-next";
import { useLicenseStore } from "@/stores/license";

import Skeleton from "@/components/global/Skeleton.vue";
import Input from "@/components/controls/inputs/Text.vue";

const store = useLicenseStore();

const license = ref("");

/**
 * Get the border color of the license box.
 *
 * @returns {string} The border color.
 * @since 2.0.0
 */
const border = computed(() => {
	return license.value ? "border-green-500" : "border-red-200";
});

const badge = computed(() => {
	return license.value
		? "bg-green-200 text-green-800"
		: "bg-red-100 text-red-800";
});
</script>

<template>
	<Skeleton v-if="store.loading" />

	<section
		v-else
		:class="border"
		class="px-8 py-12 min-h-60 w-full relative border-2 rounded-xl"
	>
		<span
			:class="badge"
			class="py-1.5 px-3 absolute left-10px top-[-15px] inline-flex items-center gap-x-2 text-xs font-normal rounded-full"
		>
			<Key :size="14" />

			{{
				license
					? __("Active", "addonify-quick-view")
					: __("Inactive", "addonify-quick-view")
			}}
		</span>

		<div class="w-full grid grid-cols-2 gap-10 relative">
			<div class="flex-basis-0 relative">
				<p class="p-0 m-0 block font-sans text-base font-normal text-gray-600">
					{{
						__("Addonify quick view pro license manager", "addonify-quick-view")
					}}
				</p>
			</div>

			<div class="flex-1 flex flex-col gap-4 relative">
				<Input v-model="license" placeholder="Paste the license..." />

				<button
					:disabled="!license"
					type="button"
					class="p-2 w-full flex items-center justify-center gap-x-2 text-base font-normal rounded-lg border border-transparent bg-blue-600 text-white hover:bg-emerald-500 focus:outline-none focus:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-100 disabled:text-gray-300 disabled:bg-gray-200 disabled:cursor-not-allowed shadow-none transition-all duration-300 ease"
				>
					{{ __("Save", "addonify-quick-view") }}
				</button>
			</div>
		</div>

		<div
			class="mt-6 pt-6 sw-full block relative border-dashed border-t border-gray-200"
		>
			<p class="p-0 m-0 block font-sans text-base font-normal text-gray-600">
				{{
					__(
						"If you have any queries related to the license, please refer to the ",
						"addonify-quick-view"
					)
				}}

				<a
					href="https://docs.addonify.com/"
					target="_blank"
					class="inline-flex items-center gap-x-1 text-blue-600 hover:text-green-500 focus:text-blue-600"
				>
					{{ __("documentation", "addonify-quick-view") }}

					<ExternalLink :size="16" />
				</a>
			</p>
		</div>
	</section>
</template>
