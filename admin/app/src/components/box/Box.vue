<script setup lang="ts">
import Title from "./Title.vue";

/**
 * Define props.
 *
 * @since 2.0.0
 */
const props = defineProps({
	sections: {
		type: Object,
		required: true,
		default: () => ({}),
	},
});
</script>

<template>
	<section
		class="min-h-[400px] p-8 w-full flex flex-col bg-white rounded-2xl first:rounded-tl-none shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
	>
		<Title :sections="props.sections" />
	</section>
</template>
