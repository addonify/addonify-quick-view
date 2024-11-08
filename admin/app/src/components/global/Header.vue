<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";
import { Save, Star } from "lucide-vue-next";
import { useProStore } from "@/stores/pro";
import { toast } from "@steveyuowo/vue-hot-toast";
import { useSettingsStore } from "@/stores/settings";

import Logo from "@/components/global/Logo.vue";
import Button from "@/components/global/Button.vue";

const ps = useProStore();

const store = useSettingsStore();

/**
 * Get the WordPress localized data.
 */
const version = computed(() => {
	return {
		pro: ps.version || null,
		free: window?.addonifyQuickViewLocals?.version || null,
	};
});

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
		<div class="flex flex-row items-center gap-6">
			<Logo />

			<div
				class="ps-4 min-h-8 flex-basis-0 flex items-center gap-2 text-sm font-normal text-gray-300 border-l border-gray-200"
			>
				<div
					type="button"
					class="flex items-center gap-x-1 font-system bg-gradient-to-r from-[#12c2e9] via-[#c471ed] to-[#f64f59] bg-clip-text text-transparent leading-3"
				>
					<p
						class="p-0 m-0 flex text-xs font-system font-normal tracking-[3px] uppercase leading-3"
					>
						Addon Version -
					</p>
					<span>
						<template v-if="version.free && version.free.length > 0">
							v{{ version.free }}
						</template>

						<template v-if="version.pro && version.pro.length > 0">
							& v{{ version.pro }}
						</template>
					</span>
				</div>
			</div>
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
