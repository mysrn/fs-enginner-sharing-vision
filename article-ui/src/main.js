import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import './assets/main.css'

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap-icons/font/bootstrap-icons.css';
import axios from 'axios';

const app = createApp(App)

app.use(router)
app.mount('#app')

app.config.globalProperties.$axios = axios
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/article';
