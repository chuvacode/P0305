<template>
    <component :is="layout"></component>
</template>

<script>

import DashboardLayout from '../layouts/DashboardLayout'
import EmptyLayout from '../layouts/EmptyLayout'

export default {
  computed: {
    layout () {
      return (this.$route.meta.layout || 'empty') + '-layout'
    }
  },
  components: {
    DashboardLayout, EmptyLayout
  }
}
</script>

<style scoped>
/*@import '../s';*/
</style>
