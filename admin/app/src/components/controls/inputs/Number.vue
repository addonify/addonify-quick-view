<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";

interface Props {
	modelValue: string | null | undefined;
	design: string | null | undefined;
	min: number | null | undefined;
	max: number | null | undefined;
	step: number | null | undefined;
	precision: number | null | undefined;
	sliderTipText: string | null | undefined;
	sliderInput: boolean | null | undefined;
	placeholder: string | null | undefined;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { modelValue, min, max, step, precision, sliderTipText, sliderInput } =
	defineProps<Props>();

/**
 * Define emits for v-model usage.
 * @ref https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since: 2.0.0
 */
const emit = defineEmits(["update:modelValue"]);

const value = computed({
	get: () => Number(modelValue),
	set: (val) => emit("update:modelValue", val),
});

/**
 * Slider tooltip text.
 *
 * @returns {string}
 * @since: 2.0.0
 */
const tooltip = (val: number): string => {
	return `${val} ${sliderTipText}`;
};
</script>

<template>
	<el-input-number
		v-if="design === 'plus-minus'"
		size="large"
		v-model="value"
		:min="Number(min) || 0"
		:max="Number(max) || 10000000000000"
		:step="Number(step) || 1"
		:precision="Number(precision) || 2"
	/>

	<el-slider
		v-else-if="design === 'slider'"
		v-model="value"
		:min="Number(min) || 0"
		:max="Number(max) || 10000000000000"
		:step="Number(step) || 1"
		:show-input="sliderInput ? true : false"
		:format-tooltip="tooltip"
		size="large"
	/>

	<el-input-number
		v-else
		size="large"
		controls-position="right"
		v-model="value"
		:min="Number(min) || 0"
		:max="Number(max) || 10000000000000"
		:step="Number(step) || 1"
		:precision="Number(precision) || 0"
	/>
</template>
