<script setup>
	const props = defineProps({
		section: Object,
		sectionkey: String,
	});
</script>
<template>
	<h3 v-if="props.section.title" class="option-box-title">
		{{ props.section.title }}
	</h3>
</template>
