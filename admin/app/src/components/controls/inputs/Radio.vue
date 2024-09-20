<script setup lang="ts">
import { computed } from "vue";

interface Props {
	modelValue: string | boolean;
	design?: string | null;
	choices: Record<any, any>;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { modelValue, choices, design = null } = defineProps<Props>();

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
	<template v-if="design === 'radioIcons'">
		<div class="is-icons">
			<el-radio-group v-model="value">
				<el-radio
					v-for="(v, k) in choices"
					:label="k"
					size="large"
					:border="true"
				>
					<span class="size-6 inline-flex" v-html="v"></span>
				</el-radio>
			</el-radio-group>
		</div>
	</template>

	<template v-else>
		<el-radio-group v-model="value" v-for="(v, k) in choices">
			<el-radio :label="k">{{ v }}</el-radio>
		</el-radio-group>
	</template>
</template>
