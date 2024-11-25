<script setup lang="ts">
import { ref, computed } from "vue";
import { __ } from "@wordpress/i18n";
import { toast } from "@steveyuowo/vue-hot-toast";
import { useProductStore } from "@/stores/products";

import Button from "@/components/global/Button.vue";

import type { Products, InstalledAddon as Addon } from "@/app";

interface Props {
	k: string | number;
	item: Products;
}

/**
 * Define props.
 *
 * @since 2.0.0
 */
const { k, item } = defineProps<Props>();

const loading = ref(false);

const store = useProductStore();

/**
 * Get the status of the addon.
 *
 * @returns {string | null}
 * @since 2.0.0
 */
const status = computed((): string | null => {
	/**
	 * Find the status in installed addons.
	 */
	const addon = store.installed.find(
		(item: Addon) => item.textdomain === k.toString().trim()
	);

	return addon && Object.keys(addon).length > 0 ? addon.status : null;
});

/**
 * Get the label based on the status.
 *
 * @param {string} k
 * @returns {string} label
 * @since 2.0.0
 */
const label = computed((): string => {
	if (!status.value) {
		return __("Install plugin", "addonify-quick-view");
	}
	return status.value === "active"
		? __("Active", "addonify-quick-view")
		: __("Activate plugin", "addonify-quick-view");
});

/**
 * Get button color class.
 *
 * @returns {string} class.
 * @since 2.0.0
 */
const btnClass = computed((): string => {
	if (!status.value) {
		return "text-white bg-blue-500 hover:bg-blue-600 focus:bg-blue-500";
	}
	return status.value === "active"
		? "text-white bg-green-500 hover:bg-green-600 focus:bg-green-500"
		: "bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-500 focus:ring-emerald-500";
});

/**
 * Handle the button click event.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleClick = async (): Promise<void> => {
	if (status.value && status.value === "active") {
		return;
	}

	loading.value = true;

	let result: any;

	/**
	 * Install the plugin.
	 */
	if (!status.value) {
		result = await store.install(k.toString().trim()).catch((e) => {
			toast({
				type: "error",
				duration: 5000,
				position: "top-center",
				message: e.message,
			});
		});

		if (result) {
			toast({
				type: "success",
				duration: 5000,
				position: "top-center",
				message: __("Success, installed.", "addonify-quick-view"),
			});
		}
	}

	/**
	 * Activate the plugin.
	 */
	if (status.value === "inactive") {
		result = await store.activate(k.toString().trim()).catch((e) => {
			toast({
				type: "error",
				duration: 5000,
				position: "top-center",
				message: e.message,
			});
		});

		if (result) {
			toast({
				type: "success",
				duration: 5000,
				position: "top-center",
				message: __("Success, activated.", "addonify-quick-view"),
			});
		}
	}

	/**
	 * Stop the loading.
	 */
	loading.value = false;
};
</script>

<template>
	<div
		class="p-10 relative w-full flex flex-col border border-gray-200 rounded-xl hover:shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] transition-all duration-500 ease"
	>
		<span
			class="px-3 py-2 m-0 absolute top-4 right-4 inline-flex items-center justify-center font-sans text-xs font-normal text-orange-400 bg-orange-50 rounded-full leading-3"
		>
			{{ item.category }}
		</span>

		<div class="w-full block">
			<img
				:src="item.thumbnail"
				:alt="item.name"
				class="inline-flex max-w-28"
			/>
		</div>

		<div class="mt-6 w-full block">
			<h3
				class="p-0 m-0 w-full text-lg font-sans font-medium text-gray-600 leading-6"
			>
				{{ item.name }}
			</h3>
		</div>

		<div class="mt-4 mb-6 w-full block">
			<p class="m-0 p-0 block font-sans text-sm font-normal text-gray-600">
				{{ item.description }}
			</p>
		</div>

		<div class="w-full block">
			<Button
				@click="handleClick()"
				:loading="loading"
				:disabled="status === 'active'"
				:class="btnClass"
				loadingClass="text-white"
				class="px-6 max-w-max inline-flex rounded-full"
			>
				{{ label }}
			</Button>
		</div>
	</div>
</template>
