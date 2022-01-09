import { createApp } from "vue";
import App from './App.vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import router from './router';
import store from './store';
import axiosConfig from '@/axiosConfig';

createApp(App)
    .use(ElementPlus)
    .use(store)
    .use(router)
    .use(axiosConfig)
    .mount("#app");
