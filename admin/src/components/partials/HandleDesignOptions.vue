<script setup>
	import OptionBox from "./OptionBox.vue";
	import ColorGroup from "./design/ColorGroup.vue";
	import SectionTitle from "./SectionTitle.vue";
	const props = defineProps({
		section: Object,
		reactiveState: Object,
	});
</script>
<template>
	<div class="adfy-ui-option" v-for="(section, sectionKey) in props.section">
		<ColorGroup
			v-if="section.type == 'color-options-group'"
			:section="section"
			:reactiveState="props.reactiveState"
		/>
		<OptionBox
			v-else
			:section="section"
			:reactiveState="props.reactiveState"
		>
			<SectionTitle :section="section" :sectionKey="sectionKey" />
		</OptionBox>
	</div>
</template>
