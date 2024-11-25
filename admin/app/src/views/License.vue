<script setup>
import { onMounted, computed } from "vue";
import { useRouter } from "vue-router";
import { useProStore } from "@/stores/pro";
import { isProActive } from "@/utils/helpers";

import Tabs from "@/components/layout/Tabs.vue";
import Sidebar from "@/components/layout/Sidebar.vue";
import Sections from "@/components/license/Sections.vue";

const router = useRouter();

const ps = useProStore();

/**
 * Check if we need to load this route.
 *
 * @returns {boolean}
 * @since 2.0.0
 */
const proAccess = computed(() => {
	return ps.active && isProActive();
});

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {
	/**
	 * Redirect to "/" page if pro is not active.
	 *
	 * @since 2.0.0
	 */
	if (!proAccess.value) {
		router.push("/");
	}
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
