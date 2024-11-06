<script setup>
import { onMounted } from "vue";

import Tabs from "@/components/layout/Tabs.vue";
import Sidebar from "@/components/layout/Sidebar.vue";
import Sections from "@/components/license/Sections.vue";

/**
 * Hook: onMounted.
 * Fired when the component is mounted.
 *
 * @ref https://vuejs.org/api/composition-api-lifecycle
 * @since 2.0.0
 */
onMounted(async () => {});
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
