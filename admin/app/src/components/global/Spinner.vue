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
});

/**
 * Get computed class names.
 *
 * @since 2.0.0
 */
const mergeClass = computed(() => {
	return mc(
		`animate-spin inline-block size-4 border-[2px] border-current border-t-transparent text-blue-600 rounded-full ${props.class}`
	);
});
</script>

<template>
	<div role="status" aria-label="loading" :class="mergeClass">
		<span class="sr-only">Loading...</span>
	</div>
</template>
