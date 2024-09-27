<script setup lang="ts">
import { ref } from "vue";
import { __ } from "@wordpress/i18n";
import { toast } from "@steveyuowo/vue-hot-toast";
import { useSettingsStore } from "@/stores/settings";

import { Vue3Lottie } from "vue3-lottie";
import UploadAnimation from "@/components/lottie/Upload.json";

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

const store = useSettingsStore();

/**
 * Process the JSON file and upload it.
 *
 * @param {File} raw
 * @return {Promise<void>}
 * @since: 2.0.0
 */
const handleUpload = async (raw: File): Promise<void> => {
	const blob = new Blob([raw], {
		type: "application/json",
	});

	const formData = new FormData();

	const name = "addonify-quick-view-settings-backup";

	formData.append(name, blob, name + ".json");

	/**
	 * Send the form data to the store.
	 */
	importing.value = true;

	const options = {
		duration: 5000,
		position: "top-center",
	};

	const success = await store.import(formData).catch((message) => {
		toast({
			type: "error",
			duration: 5000,
			message: message,
			position: "top-center",
		});
	});

	if (success) {
		toast({
			type: "success",
			duration: 5000,
			position: "top-center",
			message: __("Success! options imported.", "addonify-quick-view"),
		});

		window.location.reload();
	}

	/**
	 * Set the importing state.
	 */
	importing.value = false;
};

/**
 * Verify the uploaded file.
 *
 * @param {File} raw
 * @return {void}
 * @since: 2.0.0
 */
const verify = (raw: File): void => {
	if (!raw || raw.type !== "application/json") {
		toast({
			type: "error",
			duration: 10000,
			position: "top-center",
			message: __("Failed, please upload JSON file.", "addonify-quick-view"),
		});
		return;
	}

	/**
	 * Send the uploaded file to the handle method.
	 */
	handleUpload(raw);

	/**
	 * Clear the upload list
	 */
	fileList.value = [];
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
		<Vue3Lottie :animationData="UploadAnimation" :height="200" :width="200" />

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
