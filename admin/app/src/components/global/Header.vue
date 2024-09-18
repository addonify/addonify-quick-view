<script setup lang="ts">
import { computed } from "vue";
import { Save } from "lucide-vue-next";

import Logo from "@/components/global/Logo.vue";
import Button from "@/components/global/Button.vue";

/**
 * Get the WordPress localized data.
 */
const { version } = window.addonifyQuickViewLocals;

/**
 * Computed function to check if the save button is disabled.
 *
 * @returns {boolean}
 * @since 2.0.0
 */
const disableCompute = computed(() => {
	return true;
});
</script>

<template>
	<div
		class="px-6 py-4 flex flex-row items-center justify-between gap-5 fixed left-[180px] right-[20px] top-[40px] z-50 bg-white rounded-full shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
	>
		<div class="flex flex-row items-center gap-x-3">
			<Logo />

			<span
				class="py-1.5 px-4 inline-flex items-center rounded-full text-xs font-normal bg-orange-100 text-orange-400"
			>
				v{{ version }}
			</span>
		</div>
		<div class="flex flex-row items-center gap-x-3">
			<Button :disabled="disableCompute">
				Save Options
				<Save :size="18" />
			</Button>
		</div>
	</div>
</template>
