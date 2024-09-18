import { createRouter, createWebHashHistory } from "vue-router";
//import { useSettingsStore } from "@/stores/settings";

import Index from "@/views/Index.vue";

/**
 * Instantiate the settings store.
 */
//const store = useSettingsStore();

/**
 * Define the default routes for our app.
 *
 * @since 2.0.0
 */
const defaults = [
	{
		path: "/",
		name: "Index",
		component: Index,
		redirect: "/s/general", // Static entry point.
	},
	{
		path: "/s/:slug",
		name: "Settings",
		component: Index,
	},
	{
		path: "/:catchAll(.*)*",
		name: "404",
		component: Index,
	},
];

/**
 * Build the routes.
 *
 * @since 2.0.0
 */
const routes = [...defaults];

const router = createRouter({
	history: createWebHashHistory(),
	routes,
});

export default router;
