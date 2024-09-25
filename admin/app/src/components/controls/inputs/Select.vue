<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";

interface Props {
	modelValue: string | null | undefined;
	choices: Record<any, any> | undefined;
	placeholder: string | null | undefined;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { modelValue, placeholder, choices } = defineProps<Props>();

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
 * Get placeholder.
 *
 * @returns {string}
 * @since: 2.0.0
 */
const placeholderX = computed((): string => {
	const def = __("Choose option...", "addonify-quick-view");
	return placeholder && placeholder.length > 0 ? placeholder : def;
});
</script>

<template>
	<el-select
		v-model="value"
		size="large"
		filterable
		clearable
		:placeholder="placeholderX"
	>
		<el-option
			v-for="(label, k) in choices"
			:key="k"
			:value="k"
			:label="label"
		/>
	</el-select>
</template>
