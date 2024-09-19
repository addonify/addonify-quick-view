<script setup lang="ts">
import { computed } from "vue";

import OptionTitle from "@/components/layout/OptionTitle.vue";
import ControlContainer from "@/components/controls/Control.vue";
import MasterControl from "@/components/controls/MasterControls.vue";

import type { Option } from "@/app";

interface Props {
	sections: Option[];
}

/**
 * Define props.
 *
 * @since 2.0.0
 */
const { sections } = defineProps<Props>();

/**
 * Get the width of the container.
 *
 * @param {Option} item
 * @return {string} class name
 * @since 2.0.0
 */
const widthClass = (item: Option): string => {
	return item?.width === "full" ? "grid-cols-1 gap-10" : "grid-cols-2";
};
</script>

<template>
	<div class="addonify-options w-full flex flex-col gap-8 relative">
		<div
			v-for="(item, k) in sections"
			:key="k"
			class="addonify-option pb-10 w-full grid justify-between gap-10 last:pb-0 border-b last:border-b-0 border-dashed border-gray-200"
			:class="widthClass(item)"
		>
			<OptionTitle :label="item.label" :description="item.description" />
			<ControlContainer :control="item">
				<MasterControl :k="k.toString()" :control="item" />
			</ControlContainer>
		</div>
	</div>
</template>
