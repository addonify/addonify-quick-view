<script>
	import axios from "axios";
	import Loading from "../Loading.vue";
	//import { Check, Close } from "@element-plus/icons-vue";
	export default {
		name: "Options",
		components: {
			Loading,
			//Check,
			//Close,
		},
		setup() {
			// expose to template and other options API hooks
			return {};
		},
		data() {
			return {
				options: {
					enable_quick_view: false, // boolean
					quick_view_btn_label: "", // string
				},
				newOptions: {},
				isLoading: true,
				needSave: false,
				isSaving: false,
				BASE_API_URL: adfy_wp_locolizer.api_url,
			};
		},
		computed: {
			option() {
				return Object.assign({}, this.options);
			},
		},
		methods: {
			async fetchSettings() {
				try {
					let res = await axios.get(
						this.BASE_API_URL + "get_options"
					);
					this.options = res.data.settings_values;
					let settings = res.data.settings_values;
					//console.log(settings);
					// Assign the option.
					this.options.enable_quick_view = JSON.parse(
						settings.enable_quick_view
					);
					this.options.quick_view_btn_label =
						settings.quick_view_btn_label;

					this.isLoading = false;
				} catch (err) {
					console.log(err);
					this.errors = err;
				}
			},

			saveSettings() {
				let res = axios
					.post(this.BASE_API_URL + "update_options", this.options)
					.then((res) => {
						console.log(res);
						alert("Settings saved");
					})
					.catch((err) => {
						console.log(err);
						alert("Failed to save settings!!!!");
					});
			},
		},

		beforeMount() {
			this.fetchSettings();
		},
	};
</script>
<template>
	<Loading v-if="isLoading" />
	<form
		v-else
		id="adfy-settings-form"
		class="adfy-form"
		@submit.prevent="saveSettings"
		method="post"
	>
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
							v-model="options.enable_quick_view"
							class="enable-addonify-quick-view"
							size="large"
							inline-prompt
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
						<p class="option-label">Button label</p>
					</div>
				</div>
				<div class="adfy-col right">
					<div class="input">
						<el-input
							v-model="options.quick_view_btn_label"
							size="large"
							placeholder="Quick view"
						/>
					</div>
				</div>
			</div>
		</div>
		<!-- // adfy-options -->

		<button type="submit" class="adfy-button" :disabled="needSave == false">
			Save
		</button>
	</form>
</template>
<style lang="css" scoped>
	.el-checkbox {
		--el-checkbox-font-weight: normal;
	}
</style>
