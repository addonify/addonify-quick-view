<script setup lang="ts">
import Header from "@/components/global/Header.vue";
</script>

<template>
	<Header />
	<div id="AppEntry" class="m-0 p-0 mt-36 pe-8 relative w-full">
		<router-view></router-view>
	</div>
</template>
