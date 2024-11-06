<script setup lang="ts">
import Title from "@/components/license/Title.vue";
import Section from "@/components/license/Section.vue";
import Manager from "@/components/license/Manager.vue";
</script>

<template>
	<div class="flex flex-col gap-12">
		<Section>
			<Title title="License management" />
			<Manager />
		</Section>
	</div>
</template>
