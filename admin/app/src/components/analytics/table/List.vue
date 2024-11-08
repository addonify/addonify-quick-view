<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { useAnalyticsStore } from "@/stores/analytics";

import Empty from "@/components/global/Empty.vue";
import Skeleton from "@/components/global/Skeleton.vue";
import Table from "@/components/analytics/table/Table.vue";
import Toolbar from "@/components/analytics/table/Toolbar.vue";
import Pagination from "@/components/analytics/table/Pagination.vue";

const store = useAnalyticsStore();
</script>

<template>
	<Toolbar />

	<div
		v-if="!store.loading.product && store.product?.productsViews"
		class="flex flex-col border border-gray-200 overflow-hidden rounded-xl shadow-sm"
	>
		<Table :data="store.data" />
	</div>

	<Pagination
		v-if="!store.loading.product && store.data && store.data.length > 0"
	/>

	<Skeleton v-if="store.loading.product" :size="25" />

	<Empty
		v-if="!store.loading.product && (!store.data || !store.data.length)"
		:content="__('No data!', 'addonify-quick-view')"
		class="my-[20px] max-w-[calc(100%-40px)] mx-auto"
	/>
</template>
