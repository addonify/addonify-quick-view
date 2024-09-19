<script setup lang="ts">
import Title from "@/components/layout/BoxTitle.vue";
import Option from "@/components/layout/Option.vue";

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
		class="m-0 p-8 w-full flex flex-col relative bg-white rounded-2xl first:rounded-tl-none shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
	>
		<Title :sections="props.sections" />
		<Option :sections="props.sections.sub_sections" />
	</section>
</template>
