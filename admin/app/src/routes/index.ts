import { createRouter, createWebHashHistory } from "vue-router";

import Index from "@/views/Index.vue";
import Error from "@/views/404.vue";

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
		component: Error,
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
