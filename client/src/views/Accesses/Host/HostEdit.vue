<template>
  <div class="container-fluid container_access w-100">
    <vue-headful
      title="Редактирование: Хостинг"
    />
    <div class="panel_line">
      <h3>Редактирование: {{ host.title + ' #' + id }}</h3>
      <div class="right ml-auto">
        <a id="go_back" class="button-1 ml-30" :href="back"
        >Вернуться</a>
        <a id="add_new_host" class="button-1 ml-30" href="/home"
           @click.prevent="hostSave"
        >Сохранить</a>
      </div>
    </div>
    <div class="content">
      <form action="" ref="form_add_host" @submit.prevent="" class="list_accesses">
        <div class="form_control_group_input">
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
            <label for="input_title">Страница авторизации:</label>
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
        <div class="w-100"></div>
        <div class="d-flex">
          <div class="form_control_group_input mr-50">
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
            <label>Доступ к FTP</label>
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
        <div class="w-100"></div>
        <div class="form_control_textarea_and_label w-100" style="height: 100%;">
          <label for="textarea_comment">Комментарий:</label>
          <textarea class="control_textarea w-100" id="textarea_comment"
                    v-model="comment" type="text"></textarea>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import VueHeadful from 'vue-headful'
import route from '@/router/route'

import { required, requiredIf, url } from 'vuelidate/lib/validators'

export default {
  name: 'HostEdit',
  data: () => ({
    id: null,
    host: {
      title: ''
    },
    title: '',
    link_sign_in: '',
    host_login: '',
    host_password: '',
    ftp_server: '',
    ftp_login: '',
    ftp_password: '',
    comment: '',
    form_status: null
  }),
  mounted () {
    this.id = this.$route.params.id
    this.getHost()
  },
  methods: {
    getHost () {
      this.axios.get(route('host.edit', this.id))
        .then(response => {
          this.host = response.data.data.content

          this.title = this.host.title
          this.link_sign_in = this.host.link_sign_in
          this.host_login = this.host.host_login
          this.host_password = this.host.host_password
          this.ftp_server = this.host.ftp_server
          this.ftp_login = this.host.ftp_login
          this.ftp_password = this.host.ftp_password
          this.comment = this.host.comment
        })
    },
    hostSave () {
      this.$v.$touch()

      if (this.$v.$invalid) {
        this.form_status = 'ERROR'
        return
      }

      this.form_status = 'PENDING'
      const formData = new FormData()

      if (this.title !== this.host.title) formData.append('title', this.title)
      if (this.title !== this.host.link_sign_in) formData.append('link_sign_in', this.link_sign_in)
      if (this.title !== this.host.ftp_login) formData.append('ftp_login', this.ftp_login)
      if (this.title !== this.host.ftp_password) formData.append('ftp_password', this.ftp_password)
      if (this.title !== this.host.ftp_server) formData.append('ftp_server', this.ftp_server)
      if (this.title !== this.host.host_login) formData.append('host_login', this.host_login)
      if (this.title !== this.host.host_password) formData.append('host_password', this.host_password)
      if (this.title !== this.host.comment) formData.append('comment', this.comment)
      formData.append('_method', 'PATCH')

      this.axios.post(route('host.update', [this.id]), formData)
        .then(response => {
          this.$router.push({ name: 'dashboard.host.show', params: { id: this.id } })
          window.newToast('Успешно сохранено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    ifNotFull () {
      let check = 0

      check += this.ftp_server ? 1 : 0
      check += this.ftp_login ? 1 : 0
      check += this.ftp_password ? 1 : 0

      return !(check === 0 || check === 3)
    }
  },
  computed: {
    back () {
      return route('dashboard.host')
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
  },
  components: {
    VueHeadful
  }
}
</script>

<style scoped>
  .list_accesses {
    max-width: 600px;
  }
  #textarea_comment {
    min-height: 140px;
  }
</style>
