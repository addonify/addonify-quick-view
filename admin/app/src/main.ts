import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./routes";

import "@/assets/app.scss";

import "@fontsource/inter";
import "@fontsource/inter/400.css";
import "@fontsource/inter/500.css";
import "@fontsource/inter/600.css";
import "@fontsource/inter/700.css";

import Vue3Lottie from "vue3-lottie";

/**
 * Use the plugins.
 *
 * @since 1.0.0
 */
const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(Vue3Lottie);

/**
 * Mount the vue app.
 *
 * @since 1.0.0
 */
app.mount("#addonify-quick-view-app");
