<script setup>
import Icon from "../icons/Icons.vue";

const { __ } = wp.i18n;
</script>
<template>
	<aside class="addonify-notice" data_layout="small">
		<div class="content-holder">
			<p class="content">
				<span class="icon">
					<Icon icon="signal-tower" />
				</span>
				{{
					__(
						"This is a major release, review new features & improvements.",
						"addonify-quick-view"
					)
				}}
				<a
					href="https://wordpress.org/plugins/addonify-quick-view/#developers"
					target="_blank"
				>
					{{ __("Change logs", "addonify-quick-view") }}
				</a>
			</p>
		</div>
	</aside>
</template>
