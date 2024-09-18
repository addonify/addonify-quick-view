<script setup lang="ts">
import { onMounted } from "vue";
import { useSettingsStore } from "@/stores/settings";

import Header from "@/components/global/Header.vue";

/**
 * Get the settings store.
 */
const store = useSettingsStore();

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {
	if (!store.data || !store.settings) {
		/**
		 * Get the settings.
		 *
		 * @since 2.0.0
		 */
		await store.get();
	}
});
</script>

<template>
	<Header />
	<div id="AppEntry" class="m-0 p-0 mt-36 pe-8 relative w-full">
		<router-view></router-view>
	</div>
</template>
