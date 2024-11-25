<script setup lang="ts">
import { computed } from "vue";

import type { Option } from "@/app";

interface Props {
	control: Option;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { control } = defineProps<Props>();

/**
 * Process the input type.
 *
 * @returns {string}
 * @since 2.0.0
 */
const input = computed((): string => {
	return control.type.toString().trim();
});

/**
 * Justify class.
 *
 * @return {string} class name
 * @since 2.0.0
 */
const justifyClass = computed((): string => {
	return control?.width === "full" ? "w-full justify-start" : "justify-end";
});
</script>

<template>
	<div
		:data-input="input"
		class="relative flex-1 flex flex-row flex-wrap"
		:class="justifyClass"
	>
		<slot />
	</div>
</template>
