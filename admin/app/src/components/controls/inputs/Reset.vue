<script setup lang="ts">
import { ref } from "vue";
import Swal from "sweetalert2";
import { __ } from "@wordpress/i18n";
import { RotateCcw } from "lucide-vue-next";
import { toast } from "@steveyuowo/vue-hot-toast";
import { useSettingsStore } from "@/stores/settings";

import Button from "@/components/global/Button.vue";

interface Props {
	buttonLabel?: string | null;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { buttonLabel } = defineProps<Props>();

const loading = ref(false);

const store = useSettingsStore();

/**
 * Handle reset.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleReset = async (): Promise<void> => {
	const swal = await Swal.fire({
		title: __("Sure?", "addonify-quick-view"),
		text: __(
			"All the options will be reset. Are you sure you would like to proceed?",
			"addonify-quick-view"
		),
		icon: "question",
		showCancelButton: false,
		confirmButtonText: __("Yes, reset", "addonify-quick-view"),
		showCloseButton: true,
	});

	if (!swal.isConfirmed) {
		return;
	}

	loading.value = true;

	await toast
		.promise(store.export(), {
			loading: __("Resetting...", "addonify-quick-view"),
			success: __("Success!.", "addonify-quick-view"),
			error: __("Failed!.", "addonify-quick-view"),
			position: "top-center",
		})
		.finally(() => {
			loading.value = false;
		});
};
</script>

<template>
	<Button
		type="button"
		:loading="loading"
		:disabled="loading"
		@click="handleReset()"
		class="bg-red-500 hover:bg-red-600 focus:bg-red-600 focus:ring-red-500"
	>
		<RotateCcw v-if="!loading" :size="18" />

		{{ buttonLabel ?? __("Reset", "addonify-quick-view") }}
	</Button>
</template>
