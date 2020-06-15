<template>
    <transition name="modal">
        <div v-show="isVisibility" class="modal_container">
            <transition name="modal_form">
                <div v-show="isVisibility" class="modal_form form_confirmation">
                    <div class="modal_content">
                        <form action="" class="row ">
                            <h3>Вы уверены?</h3>
                            <div>
                                <button class="button-1 mt-auto bg_green" @click.prevent="handleConfirm">Да</button>
                                <button class="button-1 mt-auto bg_red" @click.prevent="handleRefute">Нет</button>
                            </div>

                        </form>
                    </div>
                </div>
            </transition>
            <transition name="overlay">
                <div v-if="isVisibility" @click="handleClose" class="overlay_bg"></div>
            </transition>
        </div>
    </transition>
</template>

<script>
export default {
  name: 'ConfirmForm',
  props: [
    'isVisibility'
  ],
  methods: {
    handleConfirm () {
      this.$emit('confirm')
    },
    handleRefute () {
      this.$emit('refute')
    },
    handleClose () {
      this.$emit('close')
    }
  }
}
</script>

<style scoped>

</style>
