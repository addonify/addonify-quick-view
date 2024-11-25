<script setup>
import { onMounted } from "vue";
import { __ } from "@wordpress/i18n";
import { useProductStore } from "@/stores/products";

import Tabs from "@/components/layout/Tabs.vue";
import Sidebar from "@/components/layout/Sidebar.vue";
import Skeleton from "@/components/global/Skeleton.vue";
import ProductList from "@/components/products/List.vue";

const store = useProductStore();

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {
	/**
	 * Get the list of recommended products,
	 * and addons installed in the site.
	 *
	 * @since 2.0.0
	 */
	const methods = [store.getAddons()];

	if (!store.recommended || !Object.keys(store.recommended).length) {
		methods.push(store.getList());
	}

	Promise.all(methods).catch(() => null);
});
</script>

<template>
	<main
		id="app-divider"
		class="w-full max-w-[1600px] mx-auto flex flex-row relative"
	>
		<Tabs />
		<ProductList v-if="store.recommended" />
		<Skeleton v-else />
		<Sidebar />
	</main>
</template>
