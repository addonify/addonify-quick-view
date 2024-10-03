<script setup>
import { onMounted } from "vue";
import { __ } from "@wordpress/i18n";
import { useAnalyticsStore } from "@/stores/analytics";

import Tabs from "@/components/layout/Tabs.vue";
import Sidebar from "@/components/layout/Sidebar.vue";
import Sections from "@/components/analytics/Sections.vue";

const store = useAnalyticsStore();

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {
	/**
	 * Get the views count.
	 *
	 * @since 2.0.0
	 */
	const methods = [store.getChart(), store.getProductViewCount()];

	Promise.all(methods).catch(() => null);
});
</script>

<template>
	<main
		id="app-divider"
		class="w-full max-w-[1600px] mx-auto flex flex-row relative"
	>
		<Tabs />
		<div id="app-primary" class="m-0 p-0 w-full flex flex-col">
			<Sections />
		</div>
		<Sidebar />
	</main>
</template>
