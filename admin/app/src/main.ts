import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./routes";

import "@fontsource/inter";
import "@fontsource/inter/400.css";
import "@fontsource/inter/500.css";
import "@fontsource/inter/600.css";
import "@fontsource/inter/700.css";

import "@/assets/app.scss";

/**
 * Fix: ElementPlusResolver "ElMessage" CSS import issue.
 */
import "element-plus/es/components/message/style/css";

/**
 * Use the plugins.
 *
 * @since 1.0.0
 */
const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);

/**
 * Mount the vue app.
 *
 * @since 1.0.0
 */
app.mount("#addonify-quick-view-app");
