<script setup>
	import { useOptionsStore } from "../../stores/options";
	import OptionBox from "./OptionBox.vue";
	import ColorGroup from "./design/ColorGroup.vue";
	import SectionTitle from "./SectionTitle.vue";

	const props = defineProps({
		section: Object,
		reactiveState: Object,
		currentPage: String,
	});

	const store = useOptionsStore();
	//console.log(props.section);
</script>
<template>
	<section
		v-for="(section, sectionKey) in props.section"
		v-show="
			sectionKey == 'general' ? true : store.options.enable_plugin_styles
		"
		class="addonify-section"
	>
		<ColorGroup
			v-if="section.type == 'render-jumbo-box'"
			:section="section"
			:reactiveState="props.reactiveState"
		/>
		<OptionBox
			v-else
			:section="section"
			:sectionKey="sectionKey"
			:reactiveState="props.reactiveState"
			:currentPage="props.currentPage"
		>
			<SectionTitle
				:section="section"
				:sectionKey="sectionKey"
				:currentPage="props.currentPage"
			/>
		</OptionBox>
	</section>
</template>
