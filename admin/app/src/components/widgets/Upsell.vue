<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { Gem, CircleCheckBig } from "lucide-vue-next";

import Waves from "@/components/shapes/Waves.svg";
</script>

<template>
	<div
		:style="{ backgroundImage: `url(${Waves})` }"
		class="w-full block relative rounded-xl bg-zinc-900 bg-center bg-cover bg-no-repeat overflow-hidden"
	>
		<div class="px-8 py-10 w-full flex flex-col relative">
			<div class="w-full">
				<h3
					class="p-0 m-0 flex font-sans text-lg font-medium text-white leading-6"
				>
					{{ __("Get Addonify Quick View Pro!", "addonify-quick-view") }}
				</h3>
			</div>

			<div class="mt-8 w-full relative">
				<ul class="p-0 m-0 relative flex flex-col gap-4 text-gray-200">
					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("Unlock multi wishlist", "addonify-quick-view") }}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("Back in stock email", "addonify-quick-view") }}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("Low in stock email", "addonify-quick-view") }}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("Enable cost estimation", "addonify-quick-view") }}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{
							__(
								"Allow sharing wishlists in social media",
								"addonify-quick-view"
							)
						}}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("Additional color options", "addonify-quick-view") }}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("Additional typography options", "addonify-quick-view") }}
					</li>

					<li class="p-0 m-0 w-full flex flex-row items-center gap-x-2">
						<CircleCheckBig class="inline-flex size-5" />
						{{ __("...& many more.", "addonify-quick-view") }}
					</li>
				</ul>
			</div>

			<div class="mt-8 w-full flex flex-row items-center justify-center">
				<a
					href="https://wordpress.org/plugins/addonify-wishlist/"
					class="px-8 py-4 inline-flex items-center justify-center gap-3 text-blue-500 bg-white rounded-full shadow-lg hover:bg-emerald-500 hover:text-white hover:shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] transition-colors duration-500 ease focus:outline-none focus:shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
				>
					{{ __("Get premium", "addonify-quick-view") }}

					<Gem :size="18" />
				</a>
			</div>
		</div>
	</div>
</template>
