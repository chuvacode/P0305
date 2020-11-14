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
              <div class="col-6 d-flex flex-column">
                <div class="form_control_input_and_label" :class="{'error': $v.title.$error}">
                  <label for="input_title">Наименование:</label>
                  <div class="form_control_container_input">
                    <input class="control_input" :class="{'error': $v.title.$error}" id="input_title" type="text"
                           v-model="title" @change="$v.title.$touch()">
                    <div v-if="!$v.title.required" class="error_notice"
                         tooltip="Это поле обязательно для заполнения"></div>
                  </div>
                </div>
                <div class="form_control_input_and_label" :class="{'error': $v.link_sign_in.$error}">
                  <label for="input_link_sign_in">Страница авторизации:</label>
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
                <div class="form_control_textarea_and_label" style="height: 100%;">
                  <label for="textarea_comment">Комментарий(не обязательно):</label>
                  <textarea style="max-height: 90px; height: 100%;" class="control_textarea" id="textarea_comment"
                            v-model="comment" type="text"></textarea>
                </div>
                <button type="submit" class="button-1 mt-auto fix-bottom" :disabled="submit_status === 'PENDING'">Сохранить
                </button>
              </div>
              <div class="col-6">
                <div class="form_control_group_input">
                  <label>Доступ к хостингу</label>
                  <div class="form_control_input_and_label" :class="{'error': $v.host_login.$error}">
                    <label for="input_host_login">Логин:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.host_login.$error}" id="input_host_login"
                             type="text" v-model="host_login" @change="$v.host_login.$touch()">
                      <div v-if="!$v.host_login.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                    </div>
                  </div>
                  <div class="form_control_input_and_label" :class="{'error': $v.host_password.$error}">
                    <label for="input_host_password">Пароль:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.host_password.$error}" id="input_host_password"
                             type="text" v-model="host_password" @change="$v.host_password.$touch()">
                      <div v-if="!$v.host_password.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                    </div>
                  </div>
                </div>
                <div class="form_control_group_input">
                  <label>Доступ к FTP(не обязательно)</label>
                  <div class="form_control_input_and_label" :class="{'error': $v.ftp_server.$error}">
                    <label for="input_ftp_server">Сервер:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.ftp_server.$error}" id="input_ftp_server"
                             v-model="ftp_server" type="text" @change="$v.ftp_server.$touch()">
                      <div v-if="!$v.ftp_server.required" class="error_notice"
                           tooltip="Все поля доступа к FTP должны быть заполнены или пусты" tooltip-2=""></div>
                    </div>
                  </div>
                  <div class="form_control_input_and_label" :class="{'error': $v.ftp_login.$error}">
                    <label for="input_ftp_login">Логин:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.ftp_login.$error}" id="input_ftp_login"
                             v-model="ftp_login" type="text" @change="$v.ftp_login.$touch()">
                      <div v-if="!$v.ftp_login.required" class="error_notice"
                           tooltip="Все поля доступа к FTP должны быть заполнены или пусты" tooltip-2=""></div>
                    </div>
                  </div>
                  <div class="form_control_input_and_label" :class="{'error': $v.ftp_password.$error}">
                    <label for="input_ftp_password">Пароль:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.ftp_password.$error}" id="input_ftp_password"
                             v-model="ftp_password" type="text" @change="$v.ftp_password.$touch()">
                      <div v-if="!$v.ftp_password.required" class="error_notice"
                           tooltip="Все поля доступа к FTP должны быть заполнены или пусты" tooltip-2=""></div>
                    </div>
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
import { required, requiredIf, url } from 'vuelidate/lib/validators'
import { mapActions } from 'vuex'
import route from '@/router/route'
export default {
  name: 'FormAddHost',
  data: () => ({
    title: '',
    link_sign_in: '',
    host_login: '',
    host_password: '',
    ftp_server: '',
    ftp_login: '',
    ftp_password: '',
    comment: '',
    submit_status: null
  }),
  props: [
    'isVisibility'
  ],
  methods: {
    ...mapActions([
      'ADD_HOST'
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
        formData.append('host_login', this.host_login)
        formData.append('host_password', this.host_password)
        formData.append('ftp_server', this.ftp_server)
        formData.append('ftp_login', this.ftp_login)
        formData.append('ftp_password', this.ftp_password)
        formData.append('comment', this.comment)

        this.ADD_HOST(formData)
          .then(response => {
            this.submit_status = 'OK'
            this.handleClose()
            this.axios.get(route('api.screenshot', [this.title]))
          })
          // eslint-disable-next-line handle-callback-err
          .catch(error => {
            this.submit_status = 'ERROR'
          })
      }
    },
    ifNotFull () {
      let check = 0

      check += this.ftp_server ? 1 : 0
      check += this.ftp_login ? 1 : 0
      check += this.ftp_password ? 1 : 0

      return !(check === 0 || check === 3)
    }
  },
  validations: {
    title: {
      required
    },
    host_login: {
      required
    },
    host_password: {
      required
    },
    ftp_server: {
      required: requiredIf(function () {
        return this.ifNotFull()
      })
    },
    ftp_login: {
      required: requiredIf(function () {
        return this.ifNotFull()
      })
    },
    ftp_password: {
      required: requiredIf(function () {
        return this.ifNotFull()
      })
    },
    link_sign_in: {
      required,
      url
    }
  }
}
</script>

<style scoped>

</style>
