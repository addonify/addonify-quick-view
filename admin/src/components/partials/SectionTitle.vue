<script setup>
	import { useOptionsStore } from "../../stores/options";
	const props = defineProps({
		section: Object,
		sectionkey: String,
		currentPage: String,
	});

	//console.log(props.sectionkey);
	//console.log(props.currentPage);
	//console.log(props.section);

	const store = useOptionsStore();

	const titleVisibility = (page) => {
		if (page === "design") {
			return true;
		} else if (page === "settings") {
			return props.sectionkey.includes("general")
				? true
				: store.options.enable_quick_view;
		} else {
			return false;
		}
	};
</script>
<template>
	<h3
		class="option-box-title"
		v-if="props.section.title"
		v-show="titleVisibility(props.currentPage)"
	>
		{{ props.section.title }}
	</h3>
</template>
