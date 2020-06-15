<template>
  <component :is="layout"></component>
</template>

<script>

import DashboardLayout from '@/views/layouts/DashboardLayout'
import EmptyLayout from '@/views/layouts/EmptyLayout'

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

<style lang="scss">
  @import "scss/app";
</style>
