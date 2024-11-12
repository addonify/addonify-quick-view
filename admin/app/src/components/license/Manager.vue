<script setup lang="ts">
import { ref, computed, watchEffect } from "vue";
import { __ } from "@wordpress/i18n";
import { useLicenseStore } from "@/stores/license";
import { toast } from "@steveyuowo/vue-hot-toast";
import { Key, ExternalLink } from "lucide-vue-next";

import Alerts from "@/components/license/Message.vue";
import Spinner from "@/components/global/Spinner.vue";
import Input from "@/components/controls/inputs/Text.vue";
import Activation from "@/components/license/Activation.vue";

interface Label {
	[key: string]: string;
}

const store = useLicenseStore();

const license = ref<string>("");

const error = ref<string | null>(null);

/**
 * Get the border color of the license box.
 *
 * @returns {string} The border color.
 * @since 2.0.0
 */
const colors = {
	container: {
		valid: "border-green-500",
		inactive: "border-gray-200",
		expired: "border-red-500",
		disabled: "border-red-500",
	},
	badge: {
		valid: "bg-green-200 text-green-800",
		inactive: "bg-gray-100 text-gray-600",
		expired: "bg-red-200 text-red-800",
		disabled: "bg-red-200 text-red-800",
	},
};

/**
 * Get the colors based on the license status.
 *
 * @returns {Record<string, string>}
 * @since 2.0.0
 */
const getColor = computed((): Record<string, string> => {
	const status = store.getData?.status;

	switch (status) {
		case "valid":
			return {
				badge: colors.badge.valid,
				container: colors.container.valid,
			};

		case "expired":
			return {
				badge: colors.badge.expired,
				container: colors.container.expired,
			};

		case "disabled":
			return {
				badge: colors.badge.disabled,
				container: colors.container.disabled,
			};

		default:
			return {
				badge: colors.badge.inactive,
				container: colors.container.inactive,
			};
	}
});

/**
 * Get the labels based on the license status.
 *
 * @returns {string>}
 * @since 2.0.0
 */
const getLabel = computed((): string => {
	const labels: Label = {
		valid: __("Active", "addonify-quick-view"),
		expired: __("Expired", "addonify-quick-view"),
		inactive: __("Inactive", "addonify-quick-view"),
		disabled: __("Disabled", "addonify-quick-view"),
	};

	return labels[store.getData?.status];
});

/**
 * Handle license activation.
 *
 * @returns {Promise<void>} The promise object.
 * @since 2.0.0
 */
const activate = async (): Promise<void> => {
	const result = await store.activate(license.value as string);

	if (!result || !result?.success) {
		toast({
			type: "error",
			duration: 5000,
			position: "top-center",
			message:
				result?.message ||
				__("Failed to activate the license.", "addonify-quick-view"),
		});
		return;
	}

	toast({
		type: "success",
		duration: 5000,
		position: "top-center",
		message:
			result?.message ||
			__("Success! license activated.", "addonify-quick-view"),
	});
};

/**
 * Handle license deactivation.
 *
 * @returns {Promise<void>} The promise object.
 * @since 2.0.0
 */
const deactivate = async (): Promise<void> => {
	const result = await store.deactivate(license.value as string);

	if (!result || !result?.success) {
		toast({
			type: "error",
			duration: 5000,
			position: "top-center",
			message:
				result?.message ||
				__("Failed to deactivate the license.", "addonify-quick-view"),
		});
		return;
	}

	toast({
		type: "success",
		duration: 5000,
		position: "top-center",
		message:
			result?.message ||
			__("Success! license deactivated.", "addonify-quick-view"),
	});
};

/**
 * Watch for the license change.
 *
 * @since 2.0.0
 */
watchEffect(async () => {
	/**
	 * Set the license value.
	 */
	license.value = store.license || "";

	/**
	 * Check the license status.
	 *
	 * @since 2.0.0
	 */
	if (store.license && store.license.length > 0) {
		await store.check();
	}
});
</script>

<template>
	<Alerts />

	<section
		:class="getColor.container"
		class="px-8 py-12 min-h-60 w-full relative border-2 rounded-xl"
	>
		<span
			:class="getColor.badge"
			class="py-1.5 px-3 absolute left-10px top-[-15px] inline-flex items-center gap-x-2 text-xs font-normal rounded-full"
		>
			<Key :size="14" />

			{{ getLabel }}
		</span>

		<div class="w-full grid grid-cols-2 gap-10 relative">
			<div class="flex-basis-0 relative">
				<p class="p-0 m-0 block font-sans text-base font-normal text-gray-600">
					{{
						__("Addonify quick view pro license manager", "addonify-quick-view")
					}}
				</p>

				<Activation />
			</div>

			<div class="flex-1 flex flex-col gap-4 relative">
				<Input
					v-model="license"
					:disabled="store.loading || store.license ? true : false"
					placeholder="Paste the license..."
				/>

				<button
					v-if="!store.license || !store.license.length"
					@click="activate()"
					:disabled="store.loading"
					type="button"
					class="p-2 w-full flex items-center justify-center gap-x-2 text-base font-normal rounded-lg border border-transparent bg-blue-600 text-white hover:bg-emerald-500 focus:outline-none focus:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-100 disabled:text-gray-300 disabled:bg-gray-200 disabled:cursor-not-allowed shadow-none transition-all duration-300 ease"
				>
					{{ __("Activate", "addonify-quick-view") }}

					<Spinner v-if="store.loading" />
				</button>

				<button
					v-if="store.license && store.license.length > 0"
					@click="deactivate()"
					:disabled="store.loading"
					type="button"
					class="p-2 w-full flex items-center justify-center gap-x-2 text-base font-normal rounded-lg border border-transparent bg-red-600 text-white hover:bg-emerald-500 focus:outline-none focus:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-100 disabled:text-gray-300 disabled:bg-gray-200 disabled:cursor-not-allowed shadow-none transition-all duration-300 ease"
				>
					{{ __("Deactivate", "addonify-quick-view") }}

					<Spinner v-if="store.loading" />
				</button>
			</div>
		</div>

		<div
			class="mt-6 pt-6 sw-full block relative border-dashed border-t border-gray-200"
		>
			<p class="p-0 m-0 block font-sans text-base font-normal text-gray-600">
				{{
					__(
						"Having trouble with the license? Please check the ",
						"addonify-quick-view"
					)
				}}

				<a
					href="https://docs.addonify.com/"
					target="_blank"
					class="inline-flex items-center gap-x-1 text-blue-600 hover:text-green-500 focus:text-blue-600"
				>
					{{ __("documentation", "addonify-quick-view") }}

					<ExternalLink :size="16" />
				</a>
			</p>
		</div>
	</section>
</template>
