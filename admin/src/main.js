import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

const pinia = createPinia()
const app = createApp(App);
app.use(pinia)
app.use(router)
app.use(ElementPlus)
app.mount("#___adfy-quickview-app___");