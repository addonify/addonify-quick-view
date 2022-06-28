<template>
	<footer class="adfy-colopon">
		<div class="adfy-row">
			<div class="adfy-col left">
				<p class="text">
					© 2020 - {{ thisYear }} Addonify Quick View
					<span class="version"
						>{{ __("Version", "addonify-quick-view") }}:
						{{ versionNumber }}</span
					>
				</p>
			</div>
			<div class="adfy-col right">
				<p class="text">
					<a
						href="https://wordpress.org/plugins/addonify-quick-view/#reviews"
						class="adfy-link"
						target="_blank"
					>
						{{ __("Rate", "addonify-quick-view") }}
						<span class="icon">
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
						</span>
						:)
					</a>
				</p>
			</div>
		</div>
	</footer>
</template>
<script setup>
	const { __ } = wp.i18n;
	const versionNumber = adfy_wp_locolizer.version_number;
	const thisYear = new Date().getFullYear();
</script>
