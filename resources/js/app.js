// require('./bootstrap');

// Подключение vue и его инструментов
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import router from "./router";
import App from "./components/App";

// Vue.component('accesses-host', require('./components/HostTable').default);
// Vue.component('sidebar', require('./components/Sidebar').default);

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});

