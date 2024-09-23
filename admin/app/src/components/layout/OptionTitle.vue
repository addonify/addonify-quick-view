<script setup lang="ts">
import ToolTip from "@/components/global/ToolTip.vue";

/**
 * Define props.
 *
 * @since 2.0.0
 */
const props = defineProps({
	label: {
		type: String,
		required: true,
		default: "",
	},
	description: {
		type: String,
		required: true,
		default: "",
	},
});
</script>

<template>
	<div class="flex-basis-0 relative">
		<p
			v-if="props.label && props.label.length > 0"
			class="p-0 m-0 inline-flex font-sans text-base font-normal text-gray-700"
		>
			{{ props.label }}

			<ToolTip
				v-if="props.description && props.description.length > 0"
				:content="props.description"
			/>
		</p>
	</div>
</template>
