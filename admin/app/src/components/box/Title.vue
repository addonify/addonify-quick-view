<script setup lang="ts">
import { ChevronRight } from "lucide-vue-next";

const props = defineProps({
	sections: {
		type: Object,
		required: true,
		default: () => ({}),
	},
});
</script>

<template>
	<div
		class="pb-4 w-full flex flex-row items-center justify-between border-b border-gray-200"
	>
		<div
			v-if="props.sections?.title && props.sections?.title?.length"
			class="flex flex-row"
		>
			<h3
				class="p-0 m-0 flex font-sans text-lg font-medium text-gray-600 bg-gradient-to-r from-[#12c2e9] via-[#c471ed] to-[#f64f59] bg-clip-text text-transparent"
			>
				{{ props.sections.title }}
			</h3>
		</div>
		<div class="flex-basis-0">
			<a
				href="#"
				target="_blank"
				class="inline-flex items-center gap-x-2 text-base text-blue-500 hover:text-blue-400 transition-colors duration-300 ease focus:outline-none focus:shadow-none leading-3"
			>
				Check docs
				<ChevronRight :size="16" />
			</a>
		</div>
	</div>
</template>
