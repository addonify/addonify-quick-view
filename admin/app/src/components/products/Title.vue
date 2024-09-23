<script setup lang="ts">
import { __ } from "@wordpress/i18n";
</script>

<template>
	<div
		class="pb-4 mb-8 w-full flex flex-row items-center justify-between border-b border-gray-200"
	>
		<div class="flex-basis-0">
			<h3
				class="p-0 m-0 flex font-sans text-lg font-medium text-gray-600 bg-gradient-to-r from-[#12c2e9] via-[#c471ed] to-[#f64f59] bg-clip-text text-transparent"
			>
				{{ __("Recommended Products", "addonify-quick-view") }}
			</h3>
		</div>
	</div>
</template>
