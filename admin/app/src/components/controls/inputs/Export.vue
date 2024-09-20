<script setup lang="ts">
import { ref } from "vue";
import { __ } from "@wordpress/i18n";
import { ArrowDownToLine } from "lucide-vue-next";
import { toast } from "@steveyuowo/vue-hot-toast";
import { useSettingsStore } from "@/stores/settings";

import Button from "@/components/global/Button.vue";

interface Props {
	label?: string | null;
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
 * Handle export.
 *
 * @returns {Promise<void>}
 * @since 2.0.0
 */
const handleExport = async (): Promise<void> => {
	loading.value = true;

	await toast
		.promise(store.export(), {
			loading: __("Exporting...", "addonify-quick-view"),
			success: __("Success! exported.", "addonify-quick-view"),
			error: __("Failed! exporting.", "addonify-quick-view"),
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
		@click="handleExport()"
	>
		<ArrowDownToLine v-if="!loading" :size="18" />

		{{ buttonLabel ?? __("Export", "addonify-quick-view") }}
	</Button>
</template>
