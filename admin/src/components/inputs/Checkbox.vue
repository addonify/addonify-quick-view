<script setup>
	import { computed } from "vue";
	import { ElCheckbox } from "element-plus";

	/**
	 * Define props.
	 *
	 * @since 1.0.0
	 */
	const props = defineProps({
		modelValue: [Boolean],
		label: [String],
	});

	/**
	 * Define emit.
	 *
	 * @since 1.0.0
	 */
	const emit = defineEmits(["update:modelValue"]);
	const value = computed({
		get() {
			return props.modelValue;
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
</script>
<template>
	<el-checkbox v-model="value" label="{{props.label}}" size="large" />
</template>
