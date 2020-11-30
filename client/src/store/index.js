import Vue from 'vue'
import Vuex from 'vuex'
import host from '@/store/modules/host'
import site from '@/store/modules/site'
import other from '@/store/modules/other'
import personal from '@/store/modules/personal'
// eslint-disable-next-line camelcase
import personal_edit_form from '@/store/modules/personal_edit_form'
import auth from '@/store/modules/auth'
// eslint-disable-next-line camelcase
import confirm_form from '@/store/modules/confirm_form'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    host, site, other, confirm_form, personal, auth, personal_edit_form
  }
})
