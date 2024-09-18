<script setup lang="ts">
import { computed } from "vue";
import { useRoute } from "vue-router";
import { useSettingsStore } from "@/stores/settings";

import Box from "@/components/box/Box.vue";

const route = useRoute();
const store = useSettingsStore();

/**
 * Get computed slug.
 *
 * @returns {string | null}
 * @since 2.0.0
 */
const slug = computed(() => route?.params?.slug || null);

/**
 * Check if the slug exists in the settings store.
 *
 * @returns {boolean}
 * @since 2.0.0
 */
const renderBox = computed(() => {
	if (!slug.value) {
		return false;
	}

	const section = store.settings[slug.value];

	return section && Object.keys(section).length > 0;
});
</script>
<template>
	<div id="app-primary" class="m-0 p-0 w-full flex flex-col">
		<template v-if="renderBox">
			<form @submit.prevent class="w-full flex flex-col gap-12 relative">
				<Box
					v-for="(sections, key) in store.settings[slug].sections"
					:key="key"
					:sections="sections"
					:reactive="store.data"
				/>
			</form>
		</template>
	</div>
</template>
