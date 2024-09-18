<script setup>
import { onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useSettingsStore } from "@/stores/settings";

import Skeleton from "@/components/global/Skeleton.vue";

const route = useRoute();
const router = useRouter();
const store = useSettingsStore();

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {
	/**
	 * Redirect to 404 page if the slug doesn't exist.
	 *
	 * @since 2.0.0
	 */
	store.$subscribe(() => {
		if (store.settings && Object.keys(store.settings).length) {
			const pages = Object.keys(store.settings);
			const param = route.params;

			if (!param || !param.slug || !pages.includes(param.slug)) {
				router.push("/404");
			}
		}
	});
});
</script>

<template><Skeleton v-if="!store.data || !store.settings" /></template>
