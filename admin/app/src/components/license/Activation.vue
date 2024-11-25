<script setup lang="ts">
import dayjs from "dayjs";
import { computed } from "vue";
import { __ } from "@wordpress/i18n";
import { useLicenseStore } from "@/stores/license";
import { Earth, CalendarFold } from "lucide-vue-next";

const store = useLicenseStore();

/**
 * Get the activation status.
 *
 * @returns {string} The activation status.
 * @since 2.0.0
 */
const activation = computed((): string => {
	const unlimited = store?.data?.activationLeft === "unlimited" ? true : false;

	if (unlimited) {
		return __("Unlimited", "addonify-quick-view");
	}

	const limit = store?.data?.limit || (0 as number);

	const activated = Number(store?.data?.activationLeft) || (0 as number);

	return `${limit - activated} / ${limit}`;
});

/**
 * Get expiry date.
 * Format: 25 Jan, 2022
 *
 * @returns {string} The activation status.
 * @since 2.0.0
 */
const expiry = computed((): string => {
	if (store?.data?.expires === "lifetime") {
		return __("Never", "addonify-quick-view");
	}

	return dayjs(store?.data?.expires).format("DD MMM, YYYY");
});
</script>

<template>
	<ul v-if="store.data" class="mt-6 flex flex-col gap-4">
		<li
			class="p-0 m-0 flex items-center gap-2 text-sans font-normal text-sm text-gray-600"
		>
			<Earth :size="20" />
			{{ __("Activation: ", "addonify-quick-view") }}
			<span> {{ activation }} </span>
		</li>

		<li
			class="p-0 m-0 flex items-center gap-2 text-sans font-normal text-sm text-gray-600"
		>
			<CalendarFold :size="20" />
			{{ __("Expires: ", "addonify-quick-view") }}
			<span>{{ expiry }}</span>
		</li>
	</ul>
</template>
