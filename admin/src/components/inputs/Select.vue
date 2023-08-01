<script setup>
	import { computed } from "vue";
	import { ElSelect, ElOption } from "element-plus";

	/**
	 * Define props.
	 *
	 * @since 1.2.8
	 */
	const props = defineProps({
		modelValue: {
			type: [Number, String],
			required: true,
		},
		choices: {
			type: [Object, Array],
			required: true,
		},
		placeholder: {
			type: String,
			required: false,
			default: "",
		},
	});

	/**
	 * Define emit.
	 *
	 * @param {String/Number} value
	 * @returns {String/Number} updated value
	 * @since 1.2.8
	 */
	const emit = defineEmits(["update:modelValue"]);
	const value = computed({
		get() {
			return props.modelValue.toString();
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});

	const { __ } = wp.i18n;
</script>
<template>
	<el-select
		v-model="value"
		:placeholder="
			props.placeholder
				? props.placeholder
				: __('Select', 'addonify-quick-view')
		"
		size="large"
	>
		<el-option
			v-for="(label, key) in props.choices"
			:label="label"
			:value="key"
		/>
	</el-select>
</template>
<style lang="css">
	.wp-admin .el-select-dropdown__item.selected {
		font-weight: normal;
	}
</style>
