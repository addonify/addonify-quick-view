<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { useAnalyticsStore } from "@/stores/analytics";

const as = useAnalyticsStore();
</script>

<template>
	<section class="mt-6 w-full flex items-center justify-between">
		<div class="flex-basis-0 relative">
			<p
				class="p-0 m-0 inline-flex items-center gap-x-1 text-sm font-sans font-normal text-gray-600"
			>
				{{ __("Displaying page", "addonify-quick-view") }}
				{{ as.pagination.cursor }}
				{{ __("of", "addonify-quick-view") }}
				{{ as.links.length }}.
			</p>
		</div>

		<div class="flex items-center relative">
			<el-select
				v-model="as.pagination.cursor"
				size="large"
				filterable
				collapse-tags
				collapse-tags-tooltip
			>
				<el-option v-for="k in as.links" :key="k" :value="k" :label="k" />
			</el-select>
		</div>
	</section>
</template>
