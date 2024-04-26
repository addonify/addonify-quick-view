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
		type: [String, Array],
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
	multiselect: {
		type: Boolean,
		required: false,
		default: false,
	},
});

/**
 * Define emit.
 *
 * @param {String} value
 * @returns {String} updated value
 * @since 1.2.8
 */
const emit = defineEmits(["update:modelValue"]);
const value = computed({
	get() {
		return props.multiselect ? props.modelValue : props.modelValue.toString();
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});

/**
 * Import __ from wp.i18n.
 */
const { __ } = wp.i18n;
</script>
<template>
	<el-select
		v-model="value"
		size="large"
		:placeholder="
			props.placeholder
				? props.placeholder
				: __('Select', 'addonify-quick-view')
		"
		:multiple="props.multiselect"
		:collapse-tags="props.multiselect"
		:collapse-tags-tooltip="props.multiselect"
	>
		<el-option
			v-for="(label, key) in props.choices"
			:label="label"
			:value="key"
		/>
	</el-select>
</template>
