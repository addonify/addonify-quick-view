<script setup lang="ts">
import { computed } from "vue";
import { mc } from "@/utils/tailwind";
import { Check, CircleAlert, TriangleAlert } from "lucide-vue-next";

type AlertType = "success" | "error" | "warning";

interface Props {
	type: AlertType;
	title?: string | undefined;
	content?: string | undefined;
	claX?: string | undefined;
}

/**
 * Define props.
 *
 * @since 2.0.0
 */
const { type, title, content, claX } = defineProps<Props>();

const color = {
	success: {
		container: "bg-teal-50 border-teal-500",
		icon: "bg-teal-200 border-teal-100 text-teal-600",
		title: "text-green-800",
		content: "text-green-700",
	},
	error: {
		container: "bg-red-50 border-red-500",
		icon: "bg-red-200 text-red-600 border-red-100",
		title: "text-red-800",
		content: "text-red-700",
	},
	warning: {
		container: "bg-yellow-50 border-yellow-500",
		icon: "bg-yellow-200 text-yellow-600 border-yellow-100",
		title: "text-yellow-800",
		content: "text-yellow-700",
	},
};

/**
 * Get the alert color.
 *
 * @since 2.0.0
 */
const getColor = computed(() => {
	return color[type];
});

/**
 * Get container classes.
 *
 * @since 2.0.0
 */
const containerClass = computed(() => {
	return getColor.value.container + " " + mc(claX || "");
});
</script>

<template>
	<div
		role="alert"
		:class="containerClass"
		class="px-2 py-4 border-l-2 rounded-lg"
	>
		<div class="flex">
			<div class="shrink-0">
				<span
					:class="getColor.icon"
					class="inline-flex justify-center items-center size-8 rounded-full border-4"
				>
					<Check v-if="type === 'success'" :size="16" />
					<TriangleAlert v-else-if="type === 'warning'" :size="16" />
					<CircleAlert v-else :size="16" />
				</span>
			</div>

			<div class="ms-2 relative">
				<h3 :class="getColor.title" class="p-0 m-0 block font-sans font-medium">
					{{ title || "Success" }}
				</h3>

				<p
					v-if="content && content.length > 0"
					:class="getColor.content"
					class="p-0 m-0 block font-sans font-normal text-sm"
				>
					{{ content }}
				</p>

				<slot />
			</div>
		</div>
	</div>
</template>
