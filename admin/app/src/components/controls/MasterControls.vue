<script setup lang="ts">
import { computed } from "vue";
import { useSettingsStore } from "@/stores/settings";

import Text from "@/components/controls/inputs/Text.vue";
import Color from "@/components/controls/inputs/Color.vue";
import Radio from "@/components/controls/inputs/Radio.vue";
import Reset from "@/components/controls/inputs/Reset.vue";
import Select from "@/components/controls/inputs/Select.vue";
import Switch from "@/components/controls/inputs/Switch.vue";
import Number from "@/components/controls/inputs/Number.vue";
import Upload from "@/components/controls/inputs/Upload.vue";
import Export from "@/components/controls/inputs/Export.vue";
import Textarea from "@/components/controls/inputs/Textarea.vue";

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

	<Textarea
		v-else-if="input === 'textarea'"
		v-model="store.data[k]"
		:className="control?.className"
		:placeholder="control?.placeholder"
	/>

	<Select
		v-else-if="input === 'select'"
		v-model="store.data[k]"
		:choices="control.choices"
		:placeholder="control?.placeholder"
	/>

	<Radio
		v-else-if="input === 'radio'"
		v-model="store.data[k]"
		:design="control.design"
		:choices="control.choices as Record<any, unknown>"
	/>

	<Color v-else-if="input === 'color'" v-model="store.data[k]" />

	<Number
		v-else-if="input === 'number'"
		v-model="store.data[k]"
		:min="control?.min"
		:max="control?.max"
		:step="control?.step"
		:design="control?.design"
		:precision="control?.precision"
		:sliderInput="control?.sliderInput"
		:placeholder="control?.placeholder"
		:sliderTipText="control?.sliderTipText"
	/>

	<Upload
		v-else-if="input === 'import-option'"
		:note="control?.note"
		:caption="control?.caption"
	/>

	<Export
		v-else-if="input === 'export-option'"
		:label="control?.label"
		:buttonLabel="control?.buttonLabel"
	/>

	<Reset
		v-else-if="input === 'action-button'"
		:label="control?.label"
		:buttonLabel="control?.buttonLabel"
	/>
</template>
