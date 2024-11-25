<script setup lang="ts">
import { isProActive } from "@/utils/helpers";

import Help from "@/components/widgets/Help.vue";
import UpSell from "@/components/widgets/UpSell.vue";
</script>

<template>
	<div id="app-sidebar" class="ms-12 w-full max-w-[300px] flex flex-col gap-12">
		<Help />
		<UpSell v-if="!isProActive()" />
	</div>
</template>
