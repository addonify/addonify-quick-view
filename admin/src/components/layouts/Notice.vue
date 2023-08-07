<script setup>
import Icon from "../icons/Icons.vue";
import { useNoticeStore } from "../../stores/notice";

const store = useNoticeStore();

const { __ } = wp.i18n;

/**
 * Hook: onMounted.
 *
 * @since 1.0.0
 */
 



</script>
<template>
	<aside
		v-if="!store.status.isFetching && store.isNoticeLive"
		v-for="notice in store.notices"
		class="addonify-notice"
		:class="notice.type"
		:data_size="notice.size"
	>
		<div class="content-holder">
			<p class="content">
				<span class="icon">
					<Icon icon="signal-tower" />
				</span>
				<span class="message" v-html="store.notice.data.content"></span>
			</p>
		</div>
	</aside>
</template>
