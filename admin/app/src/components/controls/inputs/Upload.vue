<script setup lang="ts">
import { ref, computed } from "vue";
import { __ } from "@wordpress/i18n";
import { Upload } from "lucide-vue-next";
import { toast } from "@steveyuowo/vue-hot-toast";

interface Props {
	note?: string | null;
	caption?: string | null;
}

/**
 * Define props.
 *
 * @ref https://vuejs.org/api/sfc-script-setup#reactive-props-destructure
 * @since 2.0.0
 */
const { note, caption } = defineProps<Props>();

/**
 * Define ref's.
 */
const fileList = ref([]);

const importing = ref(false);

/**
 * Process the JSON file and upload it.
 *
 * @param {File} raw
 * @return {void} void
 * @since: 2.0.0
 */
const processUpload = (raw: string): void => {
	const blob = new Blob([raw], {
		type: "application/json",
	});

	const formData = new FormData();

	const name = "addonify-quick-view-settings-backup";

	formData.append(name + "_import_file", blob, name + "_import_file.json");
};

/**
 * Verify file type.
 *
 * @param {File} raw
 * @return {void}
 * @since: 2.0.0
 */
const verify = (raw: string): void => {
	if (raw.type == "application/json") {
		/**
		 * Case: File is JSON.
		 * Handle the file upload.
		 */
		processUpload(raw);
	}

	// Clear the upload list
	fileList.value = [];

	toast({
		type: "error",
		duration: 5000,
		position: "top-center",
		message: __("Failed, please upload JSON file.", "addonify-quick-view"),
	});
};
</script>

<template>
	<div
		v-show="importing"
		class="w-full block"
		:class="importing ? 'block' : 'hidden'"
	>
		<el-skeleton :rows="6" animated />
	</div>

	<el-upload
		v-show="!importing"
		v-model:file-list="fileList"
		drag
		method="post"
		accept=".json"
		:auto-upload="true"
		:multiple="false"
		:before-upload="verify"
	>
		<Upload :size="62" :stroke-width="1" />

		<div
			v-if="caption && caption.length > 0"
			class="block text-sm font-normal text-gray-600 el-upload__text"
		>
			{{ caption }}
		</div>

		<template v-if="note && note.length > 0" #tip>
			<div class="text-xs text-gray-700 font-sans font-normal el-upload__tip">
				{{ note }}
			</div>
		</template>
	</el-upload>
</template>
