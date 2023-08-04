<script setup>
	import InputControl from "../InputControl.vue";

	const props = defineProps({
		section: Object,
		reactiveState: Object,
	});
</script>
<template>
	<section class="jumbo-section jumbo-box">
		<div class="jumbo-header">
			<p class="sec-title" v-if="props.section.title !== ''">
				{{ props.section.title }}
			</p>
			<p class="sec-excerpt" v-if="props.section.description !== ''">
				{{ props.section.description }}
			</p>
		</div>
		<div class="jumbo-content adfy-options">
			<template v-for="(field, key) in props.section.fields">
				<div class="ui-option">
					<div class="col-left option-label">
						<span class="label">{{ field.label }}</span>
					</div>
					<div class="col-right input">
						<InputControl
							:field="field"
							:fieldKey="key"
							:reactiveState="props.reactiveState"
						/>
					</div>
				</div>
			</template>
		</div>
	</section>
</template>
