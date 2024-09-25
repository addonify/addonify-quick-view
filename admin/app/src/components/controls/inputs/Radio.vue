<script setup lang="ts">
import { computed } from "vue";
import { CircleCheckBig } from "lucide-vue-next";

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
	<template v-if="design === 'icons'">
		<div class="is-icons">
			<el-radio-group v-model="value">
				<el-radio
					v-for="(label, k) in choices"
					:value="k"
					size="large"
					:border="true"
				>
					<span class="size-[22px] inline-flex" v-html="label"></span>
				</el-radio>
			</el-radio-group>
		</div>
	</template>

	<template v-else-if="design === 'images'">
		<div class="is-images">
			<el-radio-group v-model="value">
				<el-radio
					v-for="(label, k) in choices"
					:value="k"
					class="p-0 m-0 inline-flex relative"
				>
					<span class="inline-flex" v-html="label"></span>

					<CircleCheckBig
						:size="20"
						class="check-icon absolute bottom-0 right-0 text-blue-500"
					/>
				</el-radio>
			</el-radio-group>
		</div>
	</template>

	<template v-else>
		<el-radio-group
			v-model="value"
			class="p-0 m-0 flex flex-wrap items-center gap-6"
		>
			<el-radio
				v-for="(label, k) in choices"
				:value="k"
				:label="label"
				class="p-0 m-0 inline-flex items-center"
			>
				{{ label }}
			</el-radio>
		</el-radio-group>
	</template>
</template>
