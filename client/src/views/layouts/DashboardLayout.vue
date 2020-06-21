<template>
  <div>
    <header>
      <div class="container-fluid d-flex align-items-center px-5">
        <span class="item_menu close_sidebar" :class="{hide: isOpenSidebar}" @click="handleToggleSidebar"><span></span></span>
        <div class="cabinet d-flex align-items-center">
          <div class="avatar" style="background-image: url('/images/avatar.png');"></div>

          <span class="user_name">Чуваков Алексей</span>
        </div>
      </div>
    </header>

    <main class="d-flex">
      <sidebar ref="sidebar"></sidebar>
      <router-view ref="main"/>
    </main>

    <footer>

    </footer>
  </div>
</template>

<script>
import Sidebar from '@/components/Sidebar'

export default {
  name: 'Dashboard',
  data: () => ({
    isOpenSidebar: localStorage.isOpenSidebar === 'open'
  }),
  methods: {
    handleToggleSidebar () {
      localStorage.isOpenSidebar = localStorage.isOpenSidebar === 'open' ? 'close' : 'open'
      this.isOpenSidebar = localStorage.isOpenSidebar === 'open'
      // this.isOpenSidebar = !this.isOpenSidebar
      this.$refs.sidebar.toggleSidebar()
    }
  },
  mounted () {
    // localStorage.isOpenSidebar = localStorage.isOpenSidebar === undefined ? 'open' : localStorage.isOpenSidebar
    // console.log(localStorage.isOpenSidebar)
    // this.isOpenSidebar = localStorage.isOpenSidebar
  },
  components: {
    Sidebar
  }
}
</script>

<style scoped>

</style>
