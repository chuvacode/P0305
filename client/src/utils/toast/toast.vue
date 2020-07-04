<template>
  <div ref="toast" class="toast_message" :class="{ hide: !isVisibility, success: success, error: error, warning: warning }" @click="toggleToast">
    <span class="toast-label"></span>
    <span ref="toast_message" class="text">Данные успешно сохранены</span>
  </div>
</template>

<script>

export default {
  name: 'toast.plugin',
  data: () => ({
    isVisibility: false,
    stackMessage: [],
    success: false,
    error: false,
    warning: false
  }),
  mounted () {
    window.newToast = this.newToast
  },
  methods: {
    newToast (message, type = 'success', delay = 3) {
      this.openToast()
      this.$refs.toast_message.innerHTML = message
      this.setStatus(type)
      setTimeout(this.closeToast, 1000 * delay)
    },
    toggleToast () {
      this.isVisibility = !this.isVisibility
    },
    closeToast () {
      this.isVisibility = false
    },
    openToast () {
      this.isVisibility = true
    },
    setStatus (status) {
      this.success = false
      this.error = false
      this.warning = false

      switch (status) {
        case 'success':
          this.success = true
          break
        case 'error':
          this.error = true
          break
        case 'warning':
          this.warning = true
          break
      }
    }
  }
}

</script>

<style scoped>

</style>
