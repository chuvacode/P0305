import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Vuelidate from 'vuelidate'
import './registerServiceWorker'
import store from './store'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Multiselect from 'vue-multiselect'
import Api from './api.js'

window.Event = new Vue()
window.axios = axios
window.api = new Api()

// Регистрируем глобальную пользовательскую директиву `v-focus`
Vue.directive('focus-if-not-empty', {
  // Когда привязанный элемент вставлен в DOM...
  inserted: function (el) {
    // Переключаем фокус на элемент
    if (el.value.trim() !== '') { el.focus() }
  }
})

Vue.component('multiselect', Multiselect)
Vue.use(Vuelidate)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.config.productionTip = false

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
