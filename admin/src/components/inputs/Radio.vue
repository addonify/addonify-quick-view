<script setup>
	import { computed } from "vue";
	import { ElRadio, ElRadioGroup } from "element-plus";
	import ModalRows from "../icons/ModalRows.vue";

	/**
	 * Define props.
	 *
	 * @since 1.1.8
	 */
	const props = defineProps({
		modelValue: {
			type: String,
			required: true,
		},
		choices: {
			type: [Object, Array],
			required: true,
		},
		style: {
			type: String,
			required: false,
			default: "default",
		},
	});

	/**
	 * Define emit.
	 * Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	 *
	 * @since 1.1.8
	 */
	const emit = defineEmits(["update:modelValue"]);
	const vModelVal = computed({
		get() {
			return props.modelValue;
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
</script>
<template>
	<template v-if="props.style === 'images'">
		<div class="radio-images">
			<el-radio-group v-model="vModelVal">
				<el-radio v-for="(value, key) in props.choices" :label="key">
					<ModalRows :layout="key" />
				</el-radio>
			</el-radio-group>
		</div>
	</template>
	<template v-if="props.style === 'default'">
		<el-radio-group v-model="vModelVal">
			<el-radio v-for="(value, key) in props.choices" :label="key">
				{{ value }}
			</el-radio>
		</el-radio-group>
	</template>
</template>
<style lang="scss">
	.adfy-options {
		// For: images
		.radio-images {
			.el-radio-group {
				display: flex;
				flex-wrap: wrap;
				align-items: center;
				gap: 30px;

				.el-radio {
					display: inline-flex;
					gap: 0;
					align-items: center;
					width: auto;
					height: auto;
					padding: 15px;
					border: 2px solid #dfdfdf;
					border-radius: 10px;

					&.is-checked {
						border-color: var(--addonify_primary_color);

						.el-radio__label {
							svg.check {
								display: inline-flex;
							}
						}
					}

					.el-radio__input {
						display: none;
					}

					.el-radio__label {
						position: relative;
						svg:not(.check) {
							display: inline-flex;
							width: auto;
							max-width: 160px;
							height: auto;
						}
						svg.check {
							display: none;
							width: 26px;
							height: 26px;
							fill: var(--addonify_primary_color);
							position: absolute;
							right: -10px;
							top: -10px;
							z-index: 5;
						}
					}
				}
			}
		}
	}
</style>
