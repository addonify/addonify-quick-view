<script setup>
	import { computed } from "vue";
	import { ElInput, ElInputNumber } from "element-plus";

	const props = defineProps({
		modelValue: {
			type: [Number, String],
			required: true,
		},
		min: {
			type: [String, Number],
			required: false,
		},
		max: {
			type: [String, Number],
			required: false,
		},
		step: {
			type: [String, Number],
			required: false,
		},
		precision: {
			type: [String, Number],
			required: false,
		},
		placeholder: {
			type: String,
			required: false,
			default: "",
		},
		style: {
			type: String,
			required: false,
			default: "default",
		},
	});

	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const emit = defineEmits(["update:modelValue"]);
	const value = computed({
		get() {
			return parseInt(props.modelValue);
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});

	const { style, min, max, precision, step, placeholder } = props;
</script>
<template>
	<template v-if="style === 'default'">
		<el-input
			type="number"
			v-model="value"
			:min="min ? min : 0"
			:max="max"
			:step="step"
			:precision="precision"
			:placeholder="placeholder"
		/>
	</template>
	<template v-if="style === 'buttons-plus-minus'">
		<el-input-number
			v-model="value"
			size="large"
			:min="min ? min : 0"
			:max="max ? max : 365"
			:step="step"
			:precision="precision"
			:placeholder="placeholder"
		/>
	</template>
	<template v-if="style === 'buttons-arrows'">
		<el-input-number
			v-model="value"
			size="large"
			:min="min ? min : 0"
			:max="max ? max : 365"
			controls-position="right"
			:step="step"
			:precision="precision"
			:placeholder="placeholder"
		/>
	</template>
</template>
<style lang="scss">
	.adfy-options {
		.el-input-number--large {
			width: 140px;
		}
	}
</style>
