import { createApp } from 'vue'
import App from './App.vue'
import './style.css'
import router from "./router/index.js";
import 'remixicon/fonts/remixicon.css'
// import axios from 'axios';

createApp(App).use(router).mount('#app')
