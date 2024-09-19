<script lang="ts" setup>
import { computed } from "vue";

interface Props {
	modelValue: string | null | undefined;
	size?: string;
	title?: string;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { modelValue, size = "normal", title } = defineProps<Props>();

/**
 * Define emits for v-model usage.
 * @ref https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since: 2.0.0
 */
const emit = defineEmits(["update:modelValue"]);

const value = computed({
	get: () => modelValue || "NaN",
	set: (val) => emit("update:modelValue", val),
});

/**
 * Convert rgba to hex.
 *
 * @param {string} rgba
 * @returns {string} hex
 * @since 2.0.0
 */
const getHex = (rgba: string): string => {
	if (!rgba) {
		return "NaN";
	}

	const [r, g, b, a] = rgba
		.replace("rgba(", "")
		.replace(")", "")
		.split(",")
		.map((val) => val.trim());

	return `#${(
		(1 << 24) +
		(parseInt(r) << 16) +
		(parseInt(g) << 8) +
		parseInt(b)
	)
		.toString(16)
		.slice(1)}`;
};
</script>
<template>
	<div class="block" data_type="color-picker" data_size="default">
		<span v-if="title && title.length > 0" class="control-title">
			{{ title }}
		</span>

		<div class="block">
			<el-color-picker v-model="value" show-alpha @active-change="getHex" />
			<span class="inline-flex">
				{{ getHex(value).toUpperCase() }}
			</span>
		</div>
	</div>
</template>
