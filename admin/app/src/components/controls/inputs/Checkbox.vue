<script lang="ts" setup>
import { computed } from "vue";

interface Props {
	modelValue: string | null | undefined;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { modelValue } = defineProps<Props>();

/**
 * Define emits for v-model usage.
 * @ref https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since: 2.0.0
 */
const emit = defineEmits(["update:modelValue"]);

const value = computed({
	get: () => modelValue || "",
	set: (val) => emit("update:modelValue", val),
});

/**
 * Listen to the change event.
 *
 * @param {string} color
 * @returns {void}
 * @since 2.0.0
 */
const handleChange = (color: string | null): void => {
	emit("update:modelValue", color);
};
</script>
<template></template>
