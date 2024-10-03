<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";
import { useAnalyticsStore } from "@/stores/analytics";

import Empty from "@/components/global/Empty.vue";
import Skeleton from "@/components/global/Skeleton.vue";

const store = useAnalyticsStore();

/**
 * Options for the chart.
 *
 * @since 2.0.0
 */
const opts = {
	chart: {
		height: 350,
		type: "bar",
		zoom: {
			enabled: false,
		},
	},
	plotOptions: {
		bar: {
			horizontal: false,
			borderRadius: 8,
			endingShape: "rounded",
			borderRadiusApplication: "end",
		},
	},
	toolbar: {
		show: true,
		tools: {
			download: false,
		},
	},
	dataLabels: {
		enabled: false,
	},
	legend: {
		show: false,
	},
	crosshairs: {
		show: false,
	},
	stroke: {
		show: true,
		width: 0,
		curve: "smooth",
		colors: ["transparent"],
	},
};

/**
 * Get the chart data.
 *
 * @returns {Record<string, number> | null} The chart data.
 * @since 2.0.0
 */
const xaxis = computed(() => {
	if (!store.chart || !store.chart.views) {
		return null;
	}

	return {
		xaxis: {
			categories: Object.keys(store.chart.views),
		},
	};
});

/**
 * Get series data.
 *
 * @since 2.0.0
 */
const series = computed(() => {
	if (
		!store.chart ||
		!store.chart.views ||
		!Object.keys(store.chart.views).length
	) {
		return null;
	}

	return [
		{
			data: Object.values(store.chart.views),
			name: __("Total views", "addonify-quick-view"),
		},
	];
});

/**
 * Get options.
 *
 * @since 2.0.0
 */
const options = computed(() => {
	if (!store.chart || !store.chart.views) {
		return null;
	}

	return {
		...opts,
		...xaxis.value,
	};
});

/**
 * Render the chart.
 *
 * @since 2.0.0
 */
const renderChart = computed(() => {
	if (
		store.chart &&
		store.chart.views &&
		!store.loading.chart &&
		Object.keys(store.chart.views).length > 0
	) {
		return true;
	}

	return false;
});
</script>

<template>
	<apexchart
		v-if="renderChart"
		:series="series"
		:options="options"
		width="100%"
		height="500px"
		type="bar"
	/>

	<skeleton v-if="store.loading.chart" :size="15" />

	<Empty
		v-if="!store.loading.chart && !renderChart"
		content="Oops! not enough data to render a chart."
	/>
</template>

<style scope>
.apexcharts-toolbar {
	display: none !important;
}
</style>
