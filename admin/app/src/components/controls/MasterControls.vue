<script setup lang="ts">
import { computed } from "vue";
import { useSettingsStore } from "@/stores/settings";

import Text from "@/components/controls/inputs/Text.vue";
import Switch from "@/components/controls/inputs/Switch.vue";

import type { Option } from "@/app";

interface Props {
	k: string;
	control: Option;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { k, control } = defineProps<Props>();

/**
 * Process the input type.
 *
 * @returns {string}
 * @since 2.0.0
 */
const input = computed((): string => {
	return control.type.toString().trim();
});

/**
 * Instantiate the store.
 */
const store = useSettingsStore();
</script>

<template>
	<Switch v-if="input === 'switch'" v-model="store.data[k]" />

	<Text
		v-if="input === 'text'"
		v-model="store.data[k]"
		:className="control?.className"
		:placeholder="control?.placeholder"
	/>
</template>
