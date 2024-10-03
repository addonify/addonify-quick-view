<script setup lang="ts">
import Title from "@/components/analytics/Title.vue";
import Section from "@/components/analytics/Section.vue";
import Chart from "@/components/analytics/chart/Chart.vue";
</script>

<template>
	<div class="flex flex-col gap-12">
		<Section>
			<Title title="All Products View" />
			<Chart />
		</Section>

		<Section>
			<Title title="Products View Count" />
		</Section>
	</div>
</template>
