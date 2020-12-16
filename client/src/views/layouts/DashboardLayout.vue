<template>
  <div class="position-relative overflow-hidden">
    <header>
      <div class="container-fluid d-flex align-items-center px-5">
        <span class="item_menu close_sidebar" :class="{hide: GET_SIDEBAR_IS_VISIBILITY}" @click="TOGGLE_SIDEBAR"><span></span></span>
        <div class="cabinet d-flex align-items-center" @mouseenter="isOpenCabinetMenu = true" @mouseleave="isOpenCabinetMenu = false">
          <div class="avatar" :style="{'backgroundImage':`url('${GET_LOGINED_AVATAR_URL}')`}"></div>
          <span class="user_name">{{ GET_LOGINED_USERNAME }}</span>

          <div v-if="isOpenCabinetMenu" class="cabinet_container_menu">
            <ul class="cabinet_menu">
              <li @click="export_all">Экспорт доступов</li>
              <li @click="logout">Выход</li>
            </ul>
          </div>

        </div>
      </div>
    </header>

    <main class="d-flex">
      <sidebar ref="sidebar"></sidebar>
      <router-view ref="main"/>
    </main>

    <footer>

    </footer>
    <toast></toast>
    <confirm-form></confirm-form>
  </div>
</template>

<script>
import Toast from '@/utils/toast/toast'
import Sidebar from '@/components/Sidebar'
import ConfirmForm from '@/components/Modals/ConfirmForm'
import { mapActions, mapGetters } from 'vuex'
import route from '../../router/route'

export default {
  name: 'Dashboard',
  data: () => ({
    isOpenCabinetMenu: false,
    isOpenSidebar: localStorage.isOpenSidebar === 'open',
    authenticated: window.auth.check(),
    user: window.auth.user
  }),
  methods: {
    ...mapActions([
      'TOGGLE_SIDEBAR'
    ]),
    logout () {
      window.auth.logout()
    },
    export_all () {
      window.api.call('get', route('accesses.export'))
        .then(response => {
          window.open(response.data, '_blank')
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          console.log(error)
        })
    }
  },
  computed: {
    ...mapGetters([
      'GET_SIDEBAR_IS_VISIBILITY',
      'GET_LOGINED_USERNAME',
      'GET_LOGINED_AVATAR_URL'
    ])
  },
  mounted () {
    Event.$on('userLoggedIn', () => {
      this.authenticated = true
      this.user = window.auth.user
    })
  },
  components: {
    Sidebar, Toast, ConfirmForm
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style lang="scss" scoped>
</style>
