<template>
  <transition name="modal">
    <div v-show="GET_IS_VISIBILITY_PERSONAL_EDIT_FORM" class="modal_container">
      <transition name="modal_form">
        <div v-show="GET_IS_VISIBILITY_PERSONAL_EDIT_FORM" class="modal_form" style="min-height: 355px;">
          <div class="modal_header">
            <h3>Форма редактирования</h3>
            <div class="modal_close" @click.prevent="CLOSE_PERSONAL_EDIT_FORM"></div>
          </div>
          <div class="modal_content">
            <form action="" class="row" ref="form_add_host" @submit.prevent="handleSubmit">
              <div class="col-12 d-flex flex-column">
                <div class="d-flex">
                  <!-- Поле для ввода заголовка -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.username.$error}">
                    <label for="form_edit_personal_input_username">Имя пользователя:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.username.$error}" id="form_edit_personal_input_username" type="text"
                             v-model="username" @change="$v.username.$touch()">
                      <div v-if="!$v.username.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                    </div>
                  </div>
                  <div class="col-6 d-flex flex-column">
                    <!-- Поле с выбором привелегии -->
                    <div class="form_control_input_and_label">
                      <label>Привилегия</label>
                      <div class="form_control_container_input">
                        <multiselect v-model="privilege" track-by="name" label="label" value="name"
                                     :options="GET_LIST_PRIVILEGES_PERSONAL_EDIT_FORM"
                                     :selectLabel="'Выбрать'"
                                     :deselectLabel="''"
                                     :selectedLabel="''"
                                     :placeholder="'Выберите привилегию'"
                                     :allow-empty="false" >
                          <template v-slot:noResult>
                            Не найдено
                          </template>
                        </multiselect>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <!-- Поле для ввода почты -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.email.$error}">
                    <label for="form_edit_personal_input_email">Почта:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.email.$error}" id="form_edit_personal_input_email" type="text"
                             v-model="email" @change="$v.email.$touch()" placeholder="youremail@mail.ru">
                      <div v-if="!$v.email.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                      <div v-if="!$v.email.email" class="error_notice"
                           tooltip="Почта указана не верно"></div>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="col-6"></div>
                  <div class="col-6 form_control_input_and_label">
                    <!-- Кнопка сохранения -->
                    <button type="submit" class="button-1 mt-30" :disabled="GET_SUBMIT_STATUS_PERSONAL_EDIT_FORM === 'PENDING'">Сохранить
                    </button>
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>
      </transition>
      <transition name="overlay">
        <div v-if="GET_IS_VISIBILITY_PERSONAL_EDIT_FORM" @click="CLOSE_PERSONAL_EDIT_FORM" class="overlay_bg"></div>
      </transition>
    </div>
  </transition>
</template>

<script>
import { required, email } from 'vuelidate/lib/validators'
import { mapActions, mapGetters, mapMutations } from 'vuex'

export default {
  name: 'FormEditPersonal',
  computed: {
    ...mapGetters([
      'GET_IS_VISIBILITY_PERSONAL_EDIT_FORM',
      'GET_SUBMIT_STATUS_PERSONAL_EDIT_FORM',
      'GET_LIST_PRIVILEGES_PERSONAL_EDIT_FORM',
      'GET_USERNAME_PERSONAL_EDIT_FORM',
      'GET_EMAIL_PERSONAL_EDIT_FORM',
      'GET_PRIVILEGE_PERSONAL_EDIT_FORM',
      'GET_LIST_PRIVILEGES_PERSONAL_EDIT_FORM'
    ]),
    username: {
      get () {
        return this.GET_USERNAME_PERSONAL_EDIT_FORM
      },
      set (data) {
        this.UPDATE_USERNAME_PERSONAL_EDIT_FORM(data)
      }
    },
    email: {
      get () {
        return this.GET_EMAIL_PERSONAL_EDIT_FORM
      },
      set (data) {
        this.UPDATE_EMAIL_PERSONAL_EDIT_FORM(data)
      }
    },
    privilege: {
      get () {
        return this.GET_PRIVILEGE_PERSONAL_EDIT_FORM
      },
      set (data) {
        this.UPDATE_PRIVILEGE_PERSONAL_EDIT_FORM(data)
      }
    }
  },
  methods: {
    ...mapActions([
      'CLOSE_PERSONAL_EDIT_FORM',
      'SUBMIT_PERSONAL_EDIT_FORM'
    ]),
    ...mapMutations([
      'UPDATE_USERNAME_PERSONAL_EDIT_FORM',
      'UPDATE_EMAIL_PERSONAL_EDIT_FORM',
      'UPDATE_PRIVILEGE_PERSONAL_EDIT_FORM',
      'UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM'
    ]),
    handleSubmit () {
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM('ERROR')
      } else {
        this.SUBMIT_PERSONAL_EDIT_FORM()
          .then(response => {
            this.$v.$reset()
          })
      }
    }
  },
  validations: {
    username: {
      required
    },
    email: {
      required,
      email
    },
    privilege: {
      required
    }
  }
}
</script>

<style scoped>
  .multiselect--above .multiselect__content-wrapper {
    max-width: 283px!important;
  }
</style>
