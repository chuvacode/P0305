import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Vuelidate from 'vuelidate'
import './registerServiceWorker'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
// import Multiselect from '@/utils/multiselect/Multiselect'
import Multiselect from 'vue-multiselect'
import Auth from '@/auth.js'
import Api from './api.js'

window.Event = new Vue()
window.axios = axios
window.api = new Api()
window.auth = new Auth()

Vue.component('multiselect', Multiselect)
Vue.use(Vuelidate)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
