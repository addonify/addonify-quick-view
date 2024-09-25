<script setup lang="ts">
import { useSettingsStore } from "@/stores/settings";

import Tabs from "@/components/layout/Tabs.vue";
import Sidebar from "@/components/layout/Sidebar.vue";
import Primary from "@/components/layout/Primary.vue";
import Skeleton from "@/components/global/Skeleton.vue";
import { watchEffect } from "vue";

const store = useSettingsStore();

watchEffect(() => {
	console.log(store.settings, store.data);
});
</script>

<template>
	<main
		id="app-divider"
		class="w-full max-w-[1600px] mx-auto flex flex-row relative"
	>
		<template v-if="store.settings && store.data">
			<Tabs v-if="store.settings" />
			<Primary v-if="store.data && store.settings">
				<slot v-if="store.data && store.settings" />
			</Primary>
		</template>
		<Skeleton v-else />

		<Sidebar />
	</main>
</template>
