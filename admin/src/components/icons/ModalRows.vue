<script setup>
	/**
	 * Define props.
	 *
	 * @since 1.1.8
	 */
	const props = defineProps({
		layout: {
			type: String,
			required: true,
		},
	});
</script>
<template>
	<template v-if="props.layout === 'default'">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			class="check"
			viewBox="0 0 24 24"
		>
			<path
				d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z"
			></path>
		</svg>
		<svg
			width="160"
			height="110"
			viewBox="0 0 160 110"
			fill="none"
			xmlns="http://www.w3.org/2000/svg"
		>
			<rect width="160" height="110" rx="10" fill="#EAEAEA" />
			<rect x="13" y="15" width="55" height="45" rx="4" fill="#DBDBDB" />
			<rect x="13" y="68" width="15" height="15" rx="2" fill="#DBDBDB" />
			<rect x="33" y="68" width="15" height="15" rx="2" fill="#DBDBDB" />
			<rect x="53" y="68" width="15" height="15" rx="2" fill="#DBDBDB" />
			<rect x="83" y="19" width="40" height="5" rx="2" fill="#D9D9D9" />
			<rect x="129" y="19" width="20" height="5" rx="2" fill="#D9D9D9" />
			<path
				d="M88.6601 41.2898L85.57 43.1772L86.4102 39.6551L83.6602 37.2994L87.2696 37.01L88.6601 33.6667L90.0507 37.01L93.6602 37.2994L90.9102 39.6551L91.7503 43.1772L88.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M97.6601 41.2898L94.57 43.1772L95.4102 39.6551L92.6602 37.2994L96.2696 37.01L97.6601 33.6667L99.0507 37.01L102.66 37.2994L99.9102 39.6551L100.75 43.1772L97.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M106.66 41.2898L103.57 43.1772L104.41 39.6551L101.66 37.2994L105.27 37.01L106.66 33.6667L108.051 37.01L111.66 37.2994L108.91 39.6551L109.75 43.1772L106.66 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M115.66 41.2898L112.57 43.1772L113.41 39.6551L110.66 37.2994L114.27 37.01L115.66 33.6667L117.051 37.01L120.66 37.2994L117.91 39.6551L118.75 43.1772L115.66 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M124.66 41.2898L121.57 43.1772L122.41 39.6551L119.66 37.2994L123.27 37.01L124.66 33.6667L126.051 37.01L129.66 37.2994L126.91 39.6551L127.75 43.1772L124.66 41.2898Z"
				fill="#C2C2C2"
			/>
			<rect x="83" y="54" width="25" height="5" rx="2" fill="#D9D9D9" />
			<rect x="113" y="54" width="26" height="5" rx="2" fill="#D9D9D9" />
			<rect x="83" y="66" width="10" height="5" rx="2" fill="#D9D9D9" />
			<rect x="99" y="66" width="24" height="5" rx="2" fill="#D9D9D9" />
			<rect x="83" y="84" width="40" height="10" rx="5" fill="#C8C8C8" />
		</svg>
	</template>
	<template v-if="props.layout === 'row-reversed'">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			class="check"
			viewBox="0 0 24 24"
		>
			<path
				d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z"
			></path>
		</svg>

		<svg
			width="160"
			height="110"
			viewBox="0 0 160 110"
			fill="none"
			xmlns="http://www.w3.org/2000/svg"
		>
			<rect width="160" height="110" rx="10" fill="#EAEAEA" />
			<rect x="93" y="15" width="55" height="45" rx="4" fill="#DBDBDB" />
			<rect x="93" y="68" width="15" height="15" rx="2" fill="#DBDBDB" />
			<rect x="113" y="68" width="15" height="15" rx="2" fill="#DBDBDB" />
			<rect x="133" y="68" width="15" height="15" rx="2" fill="#DBDBDB" />
			<rect x="13" y="19" width="40" height="5" rx="2" fill="#D9D9D9" />
			<rect x="59" y="19" width="20" height="5" rx="2" fill="#D9D9D9" />
			<path
				d="M18.6601 41.2898L15.57 43.1772L16.4102 39.6551L13.6602 37.2994L17.2696 37.01L18.6601 33.6667L20.0507 37.01L23.6602 37.2994L20.9102 39.6551L21.7503 43.1772L18.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M27.6601 41.2898L24.57 43.1772L25.4102 39.6551L22.6602 37.2994L26.2696 37.01L27.6601 33.6667L29.0507 37.01L32.6602 37.2994L29.9102 39.6551L30.7503 43.1772L27.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M36.6601 41.2898L33.57 43.1772L34.4102 39.6551L31.6602 37.2994L35.2696 37.01L36.6601 33.6667L38.0507 37.01L41.6602 37.2994L38.9102 39.6551L39.7503 43.1772L36.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M45.6601 41.2898L42.57 43.1772L43.4102 39.6551L40.6602 37.2994L44.2696 37.01L45.6601 33.6667L47.0507 37.01L50.6602 37.2994L47.9102 39.6551L48.7503 43.1772L45.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<path
				d="M54.6601 41.2898L51.57 43.1772L52.4102 39.6551L49.6602 37.2994L53.2696 37.01L54.6601 33.6667L56.0507 37.01L59.6602 37.2994L56.9102 39.6551L57.7503 43.1772L54.6601 41.2898Z"
				fill="#C2C2C2"
			/>
			<rect x="13" y="54" width="25" height="5" rx="2" fill="#D9D9D9" />
			<rect x="43" y="54" width="26" height="5" rx="2" fill="#D9D9D9" />
			<rect x="13" y="66" width="10" height="5" rx="2" fill="#D9D9D9" />
			<rect x="29" y="66" width="24" height="5" rx="2" fill="#D9D9D9" />
			<rect x="13" y="84" width="40" height="10" rx="5" fill="#C8C8C8" />
		</svg>
	</template>
</template>
