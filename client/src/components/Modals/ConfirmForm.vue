<template>
    <transition name="modal">
        <div v-show="GET_IS_VISIBILITY_CONFIRM_FORM" class="modal_container">
            <transition name="modal_form">
                <div v-show="GET_IS_VISIBILITY_CONFIRM_FORM" class="modal_form form_confirmation">
                    <div class="modal_content">
                        <form action="" class="row ">
                            <h3>Вы уверены?</h3>
                            <div>
                                <button class="button-1 mt-auto bg_green" @click.prevent="UPDATE_CONFIRM_STATUS(true)">Да</button>
                                <button class="button-1 mt-auto bg_red" @click.prevent="UPDATE_CONFIRM_STATUS(false)">Нет</button>
                            </div>

                        </form>
                    </div>
                </div>
            </transition>
            <transition name="overlay">
                <div v-if="GET_IS_VISIBILITY_CONFIRM_FORM" @click="TOGGLE_CONFIRM_FORM" class="overlay_bg"></div>
            </transition>
        </div>
    </transition>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ConfirmForm',
  computed: {
    ...mapGetters([
      'GET_IS_VISIBILITY_CONFIRM_FORM'
    ])
  },
  methods: {
    ...mapActions([
      'TOGGLE_CONFIRM_FORM',
      'UPDATE_CONFIRM_STATUS'
    ])
  }
}
</script>

<style scoped>

</style>
