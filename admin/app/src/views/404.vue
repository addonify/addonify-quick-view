<script setup lang="ts">
import { MoveUpLeft } from "lucide-vue-next";
</script>

<template>
	<div
		class="mt-[200px] w-full max-w-[400px] mx-auto flex flex-col items-center text-center"
	>
		<h2
			class="p-0 m-0 pb-2 flex font-sans text-[200px] font-bold text-gray-800 bg-clip-text text-transparent bg-gradient-to-b from-blue-600 to-purple-500 dark:bg-gradient-to-r dark:from-yellow-200 dark:to-green-500 leading-none tracking-tight uppercase"
		>
			404
		</h2>

		<p class="p-0 m-0 mb-8 flex text-lg font-normal text-gray-700">
			Oops, something seems broken. We can't find the page you're looking for.
		</p>

		<RouterLink
			to="/"
			class="py-3 px-4 w-full flex flex-row items-center justify-center gap-x-2 text-base font-normal rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-100 disabled:text-gray-300 disabled:bg-gray-200 disabled:cursor-not-allowed shadow-none transition-all duration-300 ease"
		>
			<MoveUpLeft :size="24" />
			Go Home
		</RouterLink>
	</div>
</template>
