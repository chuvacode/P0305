// require('./bootstrap');

// Подключение vue и его инструментов
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from "./router";
import Vuelidate from 'vuelidate'
import App from "./components/App";
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuelidate);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});

