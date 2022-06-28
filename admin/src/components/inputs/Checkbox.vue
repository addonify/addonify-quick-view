<script setup>
	import { computed } from "vue";
	const props = defineProps({
		modelValue: [Boolean],
		label: [String],
	});
	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
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
