<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { ChevronRight } from "lucide-vue-next";

/**
 * Define props.
 *
 * @since 2.0.0
 */
const props = defineProps({
	sections: {
		type: Object,
		required: true,
		default: () => ({}),
	},
});

/**
 * Default document link.
 *
 * @since 2.0.0
 */
const docLink = "https://docs.addonify.com/kb/woocommerce-quick-view/";
</script>

<template>
	<div
		class="pb-4 mb-8 w-full flex flex-row items-center justify-between border-b border-gray-200"
	>
		<div
			v-if="props.sections?.title && props.sections?.title?.length"
			class="flex-basis-0"
		>
			<h3
				class="p-0 m-0 flex font-sans text-lg font-medium text-gray-600 bg-gradient-to-r from-[#12c2e9] via-[#c471ed] to-[#f64f59] bg-clip-text text-transparent"
			>
				{{ props.sections.title }}
			</h3>
		</div>

		<div class="flex-basis-0">
			<a
				:href="props.sections?.docLink || docLink"
				target="_blank"
				class="inline-flex items-center gap-x-2 text-base text-blue-500 hover:text-emerald-500 transition-colors duration-300 ease focus:outline-none focus:shadow-none leading-3"
			>
				{{ __("Check docs", "addonify-quick-view") }}
				<ChevronRight :size="16" />
			</a>
		</div>
	</div>
</template>
