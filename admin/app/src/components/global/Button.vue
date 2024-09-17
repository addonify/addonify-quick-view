<script setup lang="ts">
import { computed } from "vue";
import { mc } from "@/utils/tailwind";

/**
 * Define props.
 *
 * @since 2.0.0
 */
const props = defineProps({
	class: { type: String, required: false, default: "" },
	loading: { type: Boolean, required: false, default: false },
	disabled: { type: Boolean, required: false, default: false },
});

/**
 * Get computed class names.
 *
 * @since 2.0.0
 */
const mergeClass = computed(() => {
	return mc(
		`py-3 px-4 inline-flex items-center gap-x-2 text-base font-normal rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-100 disabled:text-gray-300 disabled:bg-gray-200 disabled:cursor-not-allowed shadow-none transition-all duration-300 ease ${props.class}`
	);
});
</script>

<template>
	<button
		type="button"
		:disabled="props.disabled || false"
		:loading="props.loading || false"
		:class="mergeClass"
	>
		<slot></slot>
	</button>
</template>
