<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { Coffee, PackageOpen } from "lucide-vue-next";

interface Props {
	content: string | undefined | null;
}

/**
 * Define props.
 *
 * @since 2.0.0
 */
const { content = __("No data available.", "addonify-quick-view") } =
	defineProps<Props>();
</script>

<template>
	<div
		class="p-16 w-full flex flex-col gap-6 items-center justify-center bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl"
	>
		<PackageOpen
			:size="82"
			:stroke-width="0.5"
			class="inline-flex items-center relative leading-3 text-gray-700"
		/>

		<span class="p-0 m-0 block text-base font-normal text-gray-700">
			{{ content }}
		</span>
	</div>
</template>
