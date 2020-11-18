<template>
  <transition name="modal">
    <div v-show="isVisibility" class="modal_container">
      <transition name="modal_form">
        <div v-show="isVisibility" class="modal_form" style="min-height: 355px;">
          <div class="modal_header">
            <h3>Форма добавления</h3>
            <div class="modal_close" @click.prevent="handleClose"></div>
          </div>
          <div class="modal_content">
            <form action="" class="row" ref="form_add_host" @submit.prevent="handleSubmit">
              <div class="col-12 d-flex flex-column">
                <div class="d-flex">
                  <!-- Поле для ввода заголовка -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.name.$error}">
                    <label for="input_name">Имя пользователя:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.name.$error}" id="input_name" type="text"
                             v-model="name" @change="$v.name.$touch()">
                      <div v-if="!$v.name.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                    </div>
                  </div>
                  <div class="col-6 d-flex flex-column">
                    <!-- Поле с выбором привелегии -->
                    <div class="form_control_input_and_label">
                      <label>Привилегия</label>
                      <div class="form_control_container_input">
                        <multiselect v-model="privilege" track-by="name" label="label"
                                     :options="GET_PRIVILEGES"
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
                    <label for="input_email">Почта:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.email.$error}" id="input_email" type="text"
                             v-model="email" @change="$v.email.$touch()" placeholder="youremail@mail.ru">
                      <div v-if="!$v.email.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                      <div v-if="!$v.email.email" class="error_notice"
                           tooltip="Почта указана не верно"></div>
                    </div>
                  </div>
                  <!-- Поле для ввода пароля -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.password.$error}">
                    <label for="input_password">Пароль:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.password.$error}" id="input_password" type="text"
                             v-model="password" @change="$v.password.$touch()">
                      <div v-if="!$v.password.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="col-6"></div>
                  <div class="col-6 form_control_input_and_label">
                    <!-- Кнопка сохранения -->
                    <button type="submit" class="button-1 mt-30" :disabled="submit_status === 'PENDING'">Сохранить
                    </button>
                  </div>

                </div>
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
import { required, email } from 'vuelidate/lib/validators'
import { mapActions } from 'vuex'

export default {
  name: 'FormAddPersonal',
  data: () => ({
    name: '',
    email: '',
    privilege: '',
    password: '',
    submit_status: null
  }),
  computed: {
    GET_PRIVILEGES () {
      return [
        {
          name: 'administrator',
          label: 'Администатор'
        },
        {
          name: 'worker',
          label: 'Рабочий'
        }
      ]
    }
  },
  props: [
    'isVisibility'
  ],
  mounted () {
    this.privilege = {
      name: 'worker',
      label: 'Рабочий'
    }
  },
  methods: {
    ...mapActions([
      'ADD_PERSONAL'
    ]),
    handleClose () {
      this.$emit('close')
    },
    handleSubmit () {
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submit_status = 'ERROR'
      } else {
        this.submit_status = 'PENDING'

        const formData = new FormData()
        formData.append('name', this.name)
        formData.append('email', this.email)
        formData.append('password', this.password)
        formData.append('privilege', this.privilege.name)

        this.ADD_PERSONAL(formData)
          .then(response => {
            this.submit_status = 'OK'
            this.handleClose()
            this.clearForm()
          })
        // eslint-disable-next-line handle-callback-err
          .catch(error => {
            this.submit_status = 'ERROR'
            window.newToast('Возникла ошибка', 'error', 3)
          })
      }
    },
    clearForm () {
      this.name = ''
      this.email = ''
      this.password = ''
      this.privilege = {
        name: 'worker',
        label: 'Рабочий'
      }
      this.$v.$reset()
    }
  },
  validations: {
    name: {
      required
    },
    email: {
      required,
      email
    },
    privilege: {
      required
    },
    password: {
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
