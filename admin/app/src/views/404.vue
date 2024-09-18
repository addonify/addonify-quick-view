<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { MoveUpLeft } from "lucide-vue-next";
</script>

<template>
	<div
		class="mt-[200px] w-full max-w-[400px] mx-auto flex flex-col items-center text-center"
	>
		<h2
			class="p-0 m-0 pb-2 flex font-sans text-[200px] font-bold leading-none tracking-tight uppercase text-gray-600 bg-gradient-to-r from-[#12c2e9] via-[#c471ed] to-[#f64f59] bg-clip-text text-transparent"
		>
			{{ __("404", "addonify-quick-view") }}
		</h2>

		<p class="p-0 m-0 mb-8 flex text-lg font-normal text-gray-700">
			{{
				__(
					"Oops, something seems broken. We can't find the page you're looking for.",
					"addonify-quick-view"
				)
			}}
		</p>

		<RouterLink
			to="/"
			class="py-3 px-4 w-full flex flex-row items-center justify-center gap-x-2 text-base font-normal rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-100 disabled:text-gray-300 disabled:bg-gray-200 disabled:cursor-not-allowed shadow-none transition-all duration-300 ease"
		>
			<MoveUpLeft :size="24" />
			{{ __("Go Home", "addonify-quick-view") }}
		</RouterLink>
	</div>
</template>
