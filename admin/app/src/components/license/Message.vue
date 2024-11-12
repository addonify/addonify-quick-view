<script setup lang="ts">
import { computed } from "vue";
import { __ } from "@wordpress/i18n";
import { ExternalLink } from "lucide-vue-next";
import { useLicenseStore } from "@/stores/license";

import Alert from "@/components/global/Alert.vue";

const store = useLicenseStore();

/**
 * Check if alert should be shown.
 *
 * @since 2.0.0
 */
const show = computed(() => {
	const status = store.getData.status;
	return status === "expired" || status === "disabled";
});
</script>

<template>
	<div v-if="show" class="mb-14 w-full flex flex-col gap-8">
		<Alert
			v-if="store.getData.status === 'expired'"
			type="error"
			title="Action required!"
		>
			<p class="p-0 m-0 mt-2 block font-sans font-normal text-sm text-red-700">
				<span class="mb-2 block">
					{{
						__(
							"Your license has been expired. Please renew your license to enjoy the benefits.",
							"addonify-quick-view"
						)
					}}
				</span>

				<a
					v-if="store.renewalLink"
					:href="store.renewalLink"
					target="_blank"
					class="py-3 px-6 inline-flex items-center gap-2 font-sans text-md bg-blue-500 text-white hover:bg-emerald-500 hover:text-white focus:bg-blue-500 focus:text-white focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-lg transition-colors duration-500 ease"
				>
					{{ __("Renew license - claim 15% off", "addonify-quick-view") }}

					<ExternalLink :size="20" />
				</a>
			</p>
		</Alert>

		<Alert
			v-if="store.getData.status === 'disabled'"
			type="error"
			title="License revoked!"
			content="Your license has been revoked. Please contact the support team for further assistance."
		/>
	</div>
</template>
