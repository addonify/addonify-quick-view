<script setup>
	import { ref, toRefs, reactive, onMounted, watch, computed } from "vue";
	import axios from "axios";
	import { Check, Close } from "@element-plus/icons-vue";
	import Loading from "../Loading.vue";

	let BASE_API_URL = adfy_wp_locolizer.api_url;

	let state = reactive({
		allOptions: {},
		options: {}, // holds api response.
		errors: [],
		isLoading: true,
		needSave: false,
		isSaving: false,
		isEqual: true,
	});

	let { isLoading, options } = toRefs(state);

	// ⚡️ Make a API call to get the settings.

	// Define function to map key & value.
	let objectMap = computed((object) => {
		let newObj = object;

		Object.keys(a.setting).map(function (key) {
			let keySettings = a.setting[key].settings;

			Object.keys(keySettings).map(function (settingId) {
				let settingValue = keySettings[settingId].value;
				aValue[settingId] = settingValue;
			});
		});

		return newObj;
	});

	let FetchSettings = async () => {
		try {
			let res = await axios.get(BASE_API_URL + "get_options");
			state.options = res.data.settings;
			let settings = res.data.settings;
			// Assign the option to ref.
			enableQuickView.value = JSON.parse(
				settings.general.section_fields.enable_quick_view.value
			);
			console.log(settings);
			state.isLoading = false;
		} catch (err) {
			console.log(err);
			state.errors = err;
		}
	};

	// ⚡️ Watch the changes.

	let enableQuickView = ref();
	let quickViewButtonPosition = ref("");
	let quickViewButtonPositionOptions = [
		{
			value: "after",
			label: "After add to cart button",
		},
		{
			value: "before",
			label: "Before add to cart button",
		},
		{
			value: "overlay",
			label: "Overlay on the product thumbnail",
		},
	];
	let quickViewButtonLabel = ref("");
	let quickViewModalContents = ref([
		"Image",
		"Title",
		"Price",
		"Rating",
		"Add to Cart",
	]);
	let quickViewModalProductImage = ref("");
	let quickViewModalProductImageOptions = [
		{
			value: "Product image only",
			label: "Product image only",
		},
		{
			value: "Product image or gallery",
			label: "Product image or gallery",
		},
	];
	let quickViewEnableLightBox = ref(false);
	let quickViewModalEnableViewDetailButton = ref(false);

	// ⚡️ Call FetchOptions function on mounted hook.
	onMounted(() => {
		FetchSettings();
	});
</script>
<template>
	<Loading v-if="isLoading" />
	<form v-else id="adfy-settings-form" class="adfy-form" @submit.prevent>
		{{ options }}
		<h3 class="option-box-title">General</h3>
		<div class="adfy-options">
			<div class="adfy-option-columns option-box">
				<div class="adfy-col left">
					<div class="label">
						<p class="option-label">Enable quick view</p>
						<p class="option-description">
							Once enabled, it will be visible in product catalog.
						</p>
					</div>
				</div>
				<div class="adfy-col right">
					<div class="input">
						<el-switch
							v-model="enableQuickView"
							class="enable-addonify-quick-view"
							size="large"
							inline-prompt
							:active-icon="Check"
							:inactive-icon="Close"
						/>
					</div>
				</div>
			</div>
		</div>
		<!-- // adfy-options -->
		<div class="adfy-setting-options" v-if="enableQuickView">
			<h3 class="option-box-title">Button Options</h3>
			<div class="adfy-options">
				<div class="adfy-option-columns option-box">
					<div class="adfy-col left">
						<div class="label">
							<p class="option-label">Button position</p>
							<p class="option-description">
								Choose where you want to show the quick view
								button.
							</p>
						</div>
					</div>
					<div class="adfy-col right">
						<div class="input">
							<el-select
								v-model="state.button_position"
								placeholder="Select"
								size="large"
							>
								<el-option
									v-for="item in quickViewButtonPositionOptions"
									:key="item.value"
									:label="item.label"
									:value="item.value"
								/>
							</el-select>
						</div>
					</div>
				</div>
			</div>
			<!-- // adfy-options -->
			<div class="adfy-options">
				<div class="adfy-option-columns option-box">
					<div class="adfy-col left">
						<div class="label">
							<p class="option-label">Button label</p>
						</div>
					</div>
					<div class="adfy-col right">
						<div class="input">
							<el-input
								v-model="quickViewButtonLabel"
								size="large"
								placeholder="Quick view"
							/>
						</div>
					</div>
				</div>
			</div>
			<!-- // adfy-options -->
			<h3 class="option-box-title">Modal Box Options</h3>
			<div class="adfy-options">
				<div class="adfy-option-columns option-box fullwidth">
					<div class="adfy-col left">
						<div class="label">
							<p class="option-label">Content to display</p>
							<p class="option-description">
								Which content would you like to display on quick
								view modal.
							</p>
						</div>
					</div>
					<div class="adfy-col right">
						<div class="input">
							<el-checkbox-group v-model="quickViewModalContents">
								<el-checkbox label="Image" size="large" />
								<el-checkbox label="Title" size="large" />
								<el-checkbox label="Price" size="large" />
								<el-checkbox label="Rating" size="large" />
								<el-checkbox label="Add to Cart" size="large" />
								<el-checkbox label="Excerpt" size="large" />
								<el-checkbox label="Meta" size="large" />
							</el-checkbox-group>
						</div>
					</div>
				</div>
			</div>
			<!-- // adfy-options -->
			<div class="adfy-options">
				<div class="adfy-option-columns option-box">
					<div class="adfy-col left">
						<div class="label">
							<p class="option-label">Product thumbnail</p>
							<p class="option-description">
								Choose whether you want to display single
								product image or gallery in quick view modal.
							</p>
						</div>
					</div>
					<div class="adfy-col right">
						<div class="input">
							<el-select
								v-model="quickViewModalProductImage"
								placeholder="Select"
								size="large"
							>
								<el-option
									v-for="item in quickViewModalProductImageOptions"
									:key="item.value"
									:label="item.label"
									:value="item.value"
								/>
							</el-select>
						</div>
					</div>
				</div>
			</div>
			<!-- // adfy-options -->
			<div class="adfy-options">
				<div class="adfy-option-columns option-box">
					<div class="adfy-col left">
						<div class="label">
							<p class="option-label">Enable lightbox</p>
							<p class="option-description">
								Enable lightbox for product images in quick view
								modal.
							</p>
						</div>
					</div>
					<div class="adfy-col right">
						<div class="input">
							<el-switch
								v-model="quickViewEnableLightBox"
								class="enable-addonify-quick-view"
								size="large"
								inline-prompt
								:active-icon="Check"
								:inactive-icon="Close"
							/>
						</div>
					</div>
				</div>
			</div>
			<!-- // adfy-options -->
			<div class="adfy-options">
				<div class="adfy-option-columns option-box">
					<div class="adfy-col left">
						<div class="label">
							<p class="option-label">
								Display view detail button
							</p>
							<p class="option-description">
								Enable display view detail button in modal.
							</p>
						</div>
					</div>
					<div class="adfy-col right">
						<div class="input">
							<el-switch
								v-model="quickViewModalEnableViewDetailButton"
								class="enable-addonify-quick-view"
								size="large"
								inline-prompt
								:active-icon="Check"
								:inactive-icon="Close"
							/>
						</div>
					</div>
				</div>
			</div>
			<!-- // adfy-options -->
		</div>
		<!-- // adfy-setting-options -->
	</form>
</template>
<style lang="css" scoped>
	.el-checkbox {
		--el-checkbox-font-weight: normal;
	}
</style>
