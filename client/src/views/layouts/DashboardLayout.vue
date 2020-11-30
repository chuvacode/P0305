<template>
  <div class="position-relative overflow-hidden">
    <header>
      <div class="container-fluid d-flex align-items-center px-5">
        <span class="item_menu close_sidebar" :class="{hide: isOpenSidebar}" @click="handleToggleSidebar"><span></span></span>
        <div class="cabinet d-flex align-items-center" @mouseenter="isOpenCabinetMenu = true" @mouseleave="isOpenCabinetMenu = false">
          <div class="avatar" :style="{'backgroundImage':`url('${user.avatar_url}')`}"></div>
          <span class="user_name">{{ user.name }}</span>

          <div v-if="isOpenCabinetMenu" class="cabinet_container_menu">
            <ul class="cabinet_menu">
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

export default {
  name: 'Dashboard',
  data: () => ({
    isOpenCabinetMenu: false,
    isOpenSidebar: localStorage.isOpenSidebar === 'open',
    authenticated: window.auth.check(),
    user: window.auth.user
  }),
  methods: {
    handleToggleSidebar () {
      localStorage.isOpenSidebar = localStorage.isOpenSidebar === 'open' ? 'close' : 'open'
      this.isOpenSidebar = localStorage.isOpenSidebar === 'open'
      // this.isOpenSidebar = !this.isOpenSidebar
      this.$refs.sidebar.toggleSidebar()
    },
    logout () {
      window.auth.logout()
    }
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
