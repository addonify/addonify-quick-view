<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";
import { Save, Star } from "lucide-vue-next";
import { toast } from "@steveyuowo/vue-hot-toast";
import { useSettingsStore } from "@/stores/settings";

import Logo from "@/components/global/Logo.vue";
import Button from "@/components/global/Button.vue";

const store = useSettingsStore();

/**
 * Get the WordPress localized data.
 */
const { version } = window.addonifyQuickViewLocals;

/**
 * Get the button text.
 *
 * @returns {string}
 * @since 2.0.0
 */
const btnLabel = computed((): string => {
	return store.saving
		? __("Saving...", "addonify-quick-view")
		: __("Save options", "addonify-quick-view");
});

/**
 * Handle the button click event.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleUpdate = async (): Promise<void> => {
	if (store.loading) {
		return;
	}

	const success = await store.update().catch((message) => {
		toast({
			type: "error",
			duration: 5000,
			message: message,
			position: "top-center",
		});
	});

	if (success) {
		toast({
			type: "success",
			duration: 3000,
			position: "top-center",
			message: __("Success! settings updated.", "addonify-quick-view"),
		});
	}
};
</script>

<template>
	<header
		id="app-header"
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

		<div class="flex flex-row items-center gap-6">
			<a
				target="_blank"
				href="https://wordpress.org/support/plugin/addonify-quick-view/reviews/?filter=5"
				class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm hover:bg-gray-50 hover:text-blue-500 focus:outline-none focus:bg-gray-50 focus:text-gray-500"
			>
				<span class="inline-flex items-center text-yellow-500 leading-3">
					<Star :size="14" />
					<Star :size="14" />
					<Star :size="14" />
					<Star :size="14" />
					<Star :size="14" />
				</span>

				<span class="text-sm font-sans font-normal leading-3">
					{{ __("[ Rate AQV ]", "addonify-quick-view") }}
				</span>
			</a>

			<Button
				:loading="store.saving"
				:disabled="store.saving || !store.haveChanges"
				@click="handleUpdate()"
			>
				{{ btnLabel }}

				<Save v-if="!store.saving" :size="18" />
			</Button>
		</div>
	</header>
</template>
