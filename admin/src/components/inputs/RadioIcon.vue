<script setup>
	import { computed } from "vue";
	import { ElRadio, ElRadioGroup } from "element-plus";

	const props = defineProps({
		modelValue: String,
		choices: [Object, Array],
	});

	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const emit = defineEmits(["update:modelValue"]);
	const vModalVal = computed({
		get() {
			return props.modelValue;
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
</script>
<template>
	<el-radio-group v-model="vModalVal">
		<el-radio
			v-for="(value, key) in props.choices"
			:label="key"
			size="large"
			border
		>
			<span v-html="value"></span>
		</el-radio>
	</el-radio-group>
</template>
<style lang="scss">
	.adfy-options {
		.el-radio-group {
			display: flex;
			align-items: center;
			gap: 20px;
			.el-radio {
				display: inline-flex;
				gap: 10px;
				align-items: center;
				margin: 0;
				padding: 10px 20px;
				height: auto;

				span {
					line-height: 1;
				}

				.el-radio__label {
					padding: 0;
					svg {
						display: inline-flex;
						align-items: center;
						justify-content: center;
						fill: #464646;
						width: 20px;
						height: 20px;
						line-height: 1;
					}
				}
			}
		}
	}
</style>
