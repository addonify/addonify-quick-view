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
	get: () => modelValue || "",
	set: (val) => emit("update:modelValue", val),
});

/**
 * Convert rgba to hex.
 *
 * @param {string} color
 * @returns {string} hex
 * @since 2.0.0
 */
const getHex = (color: string): string => {
	if (typeof color === null || typeof color === "object") {
		return "N/A";
	}

	if (color.substring(0, 1) !== "#" && color.substring(0, 4) !== "rgba") {
		return "N/A";
	}

	if (color.substring(0, 1) === "#") {
		return color;
	}

	let rgba = color
			.substring(color.indexOf("(") + 1, color.lastIndexOf(")"))
			.split(","),
		r = parseInt(rgba[0], 10),
		g = parseInt(rgba[1], 10),
		b = parseInt(rgba[2], 10),
		a = parseFloat(rgba[3]) || 1;

	let hex = ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);

	if (a === 1) {
		return "#" + hex;
	}

	let alphaHex = Math.round(a * 255).toString(16);

	if (alphaHex.length === 1) {
		alphaHex = "0" + alphaHex;
	}

	return "#" + hex + alphaHex;
};

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
<template>
	<div
		class="py-1 ps-6 pe-1 min-w-[80px] flex-shrink-0 flex flex-row items-center border border-gray-200 rounded-full"
	>
		<span class="me-2 inline-flex text-xs font-normal font-sans text-gray-500">
			{{ getHex(value).toUpperCase() }}
		</span>
		<el-color-picker v-model="value" show-alpha @active-change="handleChange" />
	</div>
</template>
