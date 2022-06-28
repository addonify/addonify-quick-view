<script setup>
	import { computed } from "vue";
	const props = defineProps({
		modelValue: String,
		choices: [Object, Array],
	});

	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const emit = defineEmits(["update:modelValue"]);
	const vModelVal = computed({
		get() {
			return props.modelValue;
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
</script>
<template>
	<el-radio-group v-model="vModelVal" v-for="(value, key) in props.choices">
		<el-radio :label="key">{{ value }}</el-radio>
	</el-radio-group>
</template>
