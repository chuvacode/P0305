<template>
  <div class="position-relative overflow-hidden d-flex justify-content-center" style="height: 100vh;">
    <router-view />
    <toast></toast>
  </div>
</template>

<script>
import Toast from '@/utils/toast/toast'

export default {
  name: 'Empty',
  data: () => ({
    authenticated: window.auth.check(),
    user: window.auth.user
  }),
  mounted () {
    Event.$on('userLoggedIn', () => {
      this.authenticated = true
      this.user = window.auth.user
    })
  },
  components: {
    Toast
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>
