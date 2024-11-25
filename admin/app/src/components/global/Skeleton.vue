<script setup lang="ts">
import { computed } from "vue";
import { mc } from "@/utils/tailwind";

/**
 * Define props.
 *
 * @since 2.0.0
 */
const props = defineProps({
	size: { type: Number, required: false, default: 30 },
	itemClass: { type: String, required: false, default: "" },
	containerClass: { type: String, required: false, default: "" },
});

/**
 * Get computed class names.
 *
 * @since 2.0.0
 */
const containerClass = computed(() => {
	return mc(`w-full flex flex-row ${props.containerClass}`);
});

const itemClass = computed(() => {
	return mc(`w-full h-4 bg-zinc-300 rounded-lg ${props.itemClass}`);
});

/**
 * Get width class names.
 *
 * @param {number} index
 * @returns {string}
 * @since 2.0.0
 */
const width = (index: number): string => {
	if (index === 1) {
		return "width: 50%;";
	} else if (index === 2) {
		return "width: 60%;";
	} else if (index === 3) {
		return "width: 70%;";
	} else if (index === 4) {
		return "width: 80%;";
	} else if (index === 5) {
		return "width: 90%;";
	} else {
		return "width: 100%;";
	}
};
</script>

<template>
	<div :class="containerClass">
		<div class="w-full relative animate-pulse flex flex-col gap-4">
			<aside
				v-for="i in props.size"
				:key="i"
				:class="itemClass"
				:style="width(i)"
			></aside>
		</div>
	</div>
</template>
