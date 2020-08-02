<template>
  <div class="position-relative overflow-hidden d-flex justify-content-center" style="height: 100vh;">
    <router-view />
  </div>
</template>

<script>
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
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>
