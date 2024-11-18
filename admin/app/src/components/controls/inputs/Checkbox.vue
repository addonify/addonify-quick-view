<script lang="ts" setup>
import { computed } from "vue";

type CheckboxValue = string | number;

interface Props {
	modelValue: CheckboxValue[];
	design: string | null | undefined;
	choices: Record<any, any>;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { modelValue, design = null, choices } = defineProps<Props>();

/**
 * Define emits for v-model usage.
 * @ref https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since: 2.0.0
 */
const emit = defineEmits(["update:modelValue"]);

const value = computed({
	get: () => modelValue,
	set: (val) => emit("update:modelValue", val),
});
</script>

<template>
	<template v-if="design === 'buttons'">
		<el-checkbox-group v-model="value" class="is-button" size="large">
			<el-checkbox-button
				v-for="(label, k) in choices"
				:label="label"
				:value="k"
				class="font-sans text-sm font-normal"
			>
				{{ label }}
			</el-checkbox-button>
		</el-checkbox-group>
	</template>

	<template v-else>
		<el-checkbox-group
			v-model="value"
			class="flex flex-row flex-wrap items-center gap-6"
		>
			<el-checkbox
				v-for="(label, k) in choices"
				:label="label"
				:value="k"
				class="flex items-center gap-x-1 leading-3 font-sans text-sm font-normal"
			/>
		</el-checkbox-group>
	</template>
</template>
