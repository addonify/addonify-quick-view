<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { mc } from "@/utils/tailwind";
import { PackageOpen } from "lucide-vue-next";

interface Props {
	content?: string | undefined | null;
	class?: string | undefined | null;
}

/**
 * Define props.
 *
 * @since 2.0.0
 */
const { content, class: clasX } = defineProps<Props>();

/**
 * Define props.
 *
 * @since 2.0.0
 */
const label = __("No data!", "addonify-quick-view");
</script>

<template>
	<div
		:class="
			mc(
				`p-16 w-full flex flex-col gap-6 items-center justify-center bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl ${
					clasX || ''
				}`
			)
		"
	>
		<PackageOpen
			:size="82"
			:stroke-width="0.5"
			class="inline-flex items-center relative leading-3 text-gray-700"
		/>

		<span class="p-0 m-0 block text-base font-normal text-gray-700">
			{{ content && content.length > 0 ? content : label }}
		</span>
	</div>
</template>
