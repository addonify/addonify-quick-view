<script setup lang="ts">
import { useProductStore } from "@/stores/products";

import Card from "@/components/products/Card.vue";
import Title from "@/components/products/Title.vue";

const store = useProductStore();
</script>

<template>
	<div id="app-primary" class="m-0 p-0 w-full flex flex-col">
		<section
			class="m-0 p-8 w-full flex flex-col relative bg-white rounded-2xl first:rounded-tl-none shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]"
		>
			<Title />

			<div class="grid grid-cols-2 gap-10 relative">
				<Card
					v-for="(item, k) in store.recommended"
					:key="k"
					:k="k"
					:item="item"
				/>
			</div>
		</section>
	</div>
</template>
