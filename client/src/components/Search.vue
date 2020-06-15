<template>
    <div class="search">
        <input v-model="search" @input="handleInput" ref="search" type="text">
        <div @click.prevent="handleButtonSearch">
            <a href="#"></a>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Search',
  data: () => ({
    search: ''
  }),
  methods: {
    handleButtonSearch () {
      this.$nextTick(() => {
        this.$refs.search.focus()
      })
    },
    handleInput () {
      this.$emit('input', this.search)
    }
  }
}
</script>

<style scoped>

</style>
