<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";
import { useAnalyticsStore } from "@/stores/analytics";

import Skeleton from "@/components/global/Skeleton.vue";
import Table from "@/components/analytics/table/Table.vue";
import Toolbar from "@/components/analytics/table/Toolbar.vue";

const store = useAnalyticsStore();

/**
 * Render table.
 *
 * @since 2.0.0
 */
const data = computed(() => {
	if (
		!store.product ||
		!store.product.productsViews ||
		!store.product.productsViews.length
	) {
		return null;
	}
	return store.product.productsViews;
});
</script>

<template>
	<Toolbar />
	<div
		v-if="!store.loading.product && store.product?.productsViews"
		class="flex flex-col border border-gray-200 overflow-hidden rounded-xl shadow-sm"
	>
		<Table :data="data" />
	</div>

	<Skeleton v-if="store.loading.product" :size="25" />
</template>
