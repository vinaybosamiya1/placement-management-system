import { createApp } from 'vue'
import App from './App.vue'
import './style.css'
import router from "./router/router.js";
import 'remixicon/fonts/remixicon.css'

createApp(App).use(router).mount('#app')
