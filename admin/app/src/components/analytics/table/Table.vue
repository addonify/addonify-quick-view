<script setup lang="ts">
import { __ } from "@wordpress/i18n";
import { slice } from "@/utils/helpers";

import type { ProductsViewsCount } from "@/app";

interface Props {
	data: ProductsViewsCount[] | null;
}

/**
 * Define props.
 *
 * @since 2.0.0
 */
const { data = null } = defineProps<Props>();
</script>

<template>
	<table class="w-fll border-none shadow-none">
		<thead class="border-b border-b-gray-200">
			<tr>
				<th
					class="p-4 m-0 w-[60px] text-sm uppercase font-semibold font-sans text-left text-gray-600"
				>
					{{ __("SN", "addonify-quick-view") }}
				</th>

				<th
					class="p-4 m-0 text-sm uppercase font-semibold font-sans text-left text-gray-600"
				>
					{{ __("Product name", "addonify-quick-view") }}
				</th>

				<th
					class="p-4 m-0 w-[150px] text-sm uppercase font-semibold font-sans text-left text-gray-600"
				>
					{{ __("Views", "addonify-quick-view") }}
				</th>
			</tr>
		</thead>

		<tbody class="w-full relation">
			<tr
				v-for="(product, index) in data"
				:key="product.id"
				class="border-b border-b-gray-200 last:border-b-0"
			>
				<td
					class="p-4 m-0 w-[60px] text-sm font-sans text-left border border-none text-gray-600"
				>
					{{ index + 1 }}
				</td>

				<td class="p-4 m-0 text-sm font-sans text-left text-gray-600">
					<a
						:href="product.link"
						target="_blank"
						class="m-0 p-0 inline-flex items-center gap-x-4 text-md text-gray-700 hover:text-emerald-500"
					>
						<img
							:src="product.image"
							class="w-full max-w-[60px] inline-flex rounded-lg"
						/>

						{{ slice(product.name, 130) }}
					</a>
				</td>

				<td class="p-4 m-0 w-[150px] text-sm font-sans text-left text-gray-600">
					{{ product.viewsCount }}
				</td>
			</tr>
		</tbody>
	</table>
</template>
