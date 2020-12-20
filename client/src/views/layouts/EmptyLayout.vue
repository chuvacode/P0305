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
  mounted () {
    // console.log('DD123')
  },
  components: {
    Toast
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>
