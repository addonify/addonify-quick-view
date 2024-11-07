<script setup lang="ts">
import { onMounted } from "vue";
import { useProStore } from "@/stores/pro";
import { isProActive } from "@/utils/helpers";
import { useLicenseStore } from "@/stores/license";
import { useSettingsStore } from "@/stores/settings";

import "@steveyuowo/vue-hot-toast/vue-hot-toast.css";
import { Toaster } from "@steveyuowo/vue-hot-toast";

import Header from "@/components/global/Header.vue";

/**
 * Get the settings store.
 */
const store = useSettingsStore();

/**
 * Get the pro store.
 */
const ps = useProStore();

/**
 * Get the license store.
 */
const ls = useLicenseStore();

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {
	/**
	 * Array of promises to resolve.
	 */
	const methods = [];

	/**
	 * Get the pro data.
	 *
	 * @since 2.0.0
	 */
	if (!store.data || !store.settings) {
		methods.push(store.get());
	}

	/**
	 * If pro version if active,
	 * Get the pro addon information.
	 * Get the license information.
	 *
	 * @since 2.0.0
	 */
	if (isProActive()) {
		methods.push(ps.ping(), ls.get());
	}

	/**
	 * Wait for all the promises to resolve.
	 *
	 * @since 2.0.0
	 */
	await Promise.all(methods).catch(() => null);
});
</script>

<template>
	<Header />
	<div id="AppEntry" class="m-0 p-0 mt-36 pe-8 relative w-full">
		<router-view></router-view>
	</div>
	<Toaster />
</template>
