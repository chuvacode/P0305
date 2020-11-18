<template>
  <transition name="modal">
    <div v-show="isVisibility" class="modal_container">
      <transition name="modal_form">
        <div v-show="isVisibility" class="modal_form">
          <div class="modal_header">
            <h3>Форма добавления</h3>
            <div class="modal_close" @click.prevent="handleClose"></div>
          </div>
          <div class="modal_content">
            <form action="" class="row" ref="form_add_host" @submit.prevent="handleSubmit">
              <div class="col-12 d-flex flex-column">
                <div class="d-flex">
                  <!-- Поле для ввода заголовка -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.title.$error}">
                    <label for="input_title">Наименование:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.title.$error}" id="input_title" type="text"
                             v-model="title" @change="$v.title.$touch()">
                      <div v-if="!$v.title.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                    </div>
                  </div>
                  <!-- Поле для ввода ссылки для авторизации -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.link_sign_in.$error}">
                    <label for="input_link_sign_in">Ссылка для авторизации:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.link_sign_in.$error}" id="input_link_sign_in" type="text"  list="names"
                             v-model="link_sign_in" @change="$v.link_sign_in.$touch()">
                      <datalist id="names">
                        <option :value="'http://' + title" />
                        <option :value="'https://' + title" />
                      </datalist>
                      <div v-if="!$v.link_sign_in.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                      <div v-if="!$v.link_sign_in.url" class="error_notice"
                           tooltip="Значение не является ссылкой"></div>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <!-- Группа для ввода данных для авторизации в админ-панели -->
                  <div class="form_control_group_input col-6">
                    <label>Данные для авторизации:</label>
                    <div class="form_control_input_and_label" :class="{'error': $v.email.$error}">
                      <label for="input_email">E-mail:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.email.$error}" id="input_email"
                               type="text" v-model="email" @change="$v.email.$touch()">
                        <div v-if="!$v.email.required" class="error_notice"
                             tooltip="Это поле обязательно для заполнения"></div>
                        <div v-if="!$v.email.url" class="error_notice"
                             tooltip="Значение не является почтой"></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.login.$error}">
                      <label for="input_login">Логин:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.login.$error}" id="input_login"
                               type="text" v-model="login" @change="$v.login.$touch()">
                        <div v-if="!$v.login.required" class="error_notice"
                             tooltip="Это поле обязательно для заполнения"></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.password.$error}">
                      <label for="input_password">Пароль:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.password.$error}" id="input_password"
                               type="text" v-model="password" @change="$v.password.$touch()">
                        <div v-if="!$v.password.required" class="error_notice"
                             tooltip="Это поле обязательно для заполнения"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 d-flex flex-column" style="padding-bottom: 12px;">
                    <!-- Поле прикрепления к хостингу -->
                    <div class="form_control_input_and_label" :class="{'error': $v.phone.$error}">
                      <label for="input_phone">Телефон:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.phone.$error}" id="input_phone"
                               v-model="phone" type="text" @change="$v.phone.$touch()">
                        <div v-if="!$v.phone.required" class="error_notice"
                             tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
                      </div>
                    </div>
                    <!-- Поле для ввода комментария -->
                    <div class="form_control_textarea_and_label" style="height: 180px;">
                      <label for="textarea_comment">Комментарий(не обязательно):</label>
                      <textarea class="control_textarea" id="textarea_comment"
                                v-model="comment" type="text"></textarea>
                    </div>
                    <!-- Кнопка сохранения -->
                    <button type="submit" class="button-1 mt-auto" :disabled="submit_status === 'PENDING'">Сохранить
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
import { required, url, email } from 'vuelidate/lib/validators'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'FormAddOther',
  data: () => ({
    title: '',
    link_sign_in: '',
    login: '',
    password: '',
    phone: '',
    email: '',
    comment: '',
    submit_status: null
  }),
  computed: {
    ...mapGetters([
      'GET_SHORT_OTHERS'
    ])
  },
  props: [
    'isVisibility'
  ],
  mounted () {
    this.GET_SHORT_OTHERS_FROM_API()
  },
  methods: {
    ...mapActions([
      'ADD_OTHER',
      'GET_SHORT_OTHERS_FROM_API'
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
        formData.append('title', this.title)
        formData.append('link_sign_in', this.link_sign_in)
        formData.append('login', this.login)
        formData.append('password', this.password)
        formData.append('phone', this.phone)
        formData.append('email', this.email)
        formData.append('comment', this.comment)

        this.ADD_OTHER(formData)
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
      this.title = ''
      this.link_sign_in = ''
      this.email = ''
      this.login = ''
      this.password = ''
      this.phone = ''
      this.comment = ''
      this.$v.$reset()
    }
  },
  validations: {
    title: {
      required
    },
    link_sign_in: {
      required,
      url
    },
    email: {
      required,
      email
    },
    login: {
      required
    },
    password: {
      required
    },
    phone: {
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
