<script setup lang="ts">
import { CircleHelp } from "lucide-vue-next";

/**
 * Define props.
 *
 * @since 2.0.0
 */
const props = defineProps({
	content: {
		type: String,
		required: true,
		default: "",
	},
	size: {
		type: Number,
		required: false,
		default: 16,
	},
});
</script>

<template>
	<div class="ms-2 flex-basis-0 inline-flex relative">
		<el-tooltip
			v-if="props.content && props.content.length > 0"
			:content="props.content"
			effect="dark"
			placement="top"
			popper-class="p-4 w-full max-w-[300px] inline-flex text-sm font-sans text-gray-300 rounded-md"
			class="inline-flex text-gray-200"
		>
			<span
				class="inline-flex items-center text-gray-400 hover:text-gray-500 hover:cursor-help leading-3 transition-colors duration-300 ease"
			>
				<CircleHelp :size="props.size" />
			</span>
		</el-tooltip>
	</div>
</template>
