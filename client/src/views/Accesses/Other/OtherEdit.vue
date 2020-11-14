<template>
  <div class="container-fluid container_access w-100">
    <vue-headful
      title="Редактирование: Другое"
    />
    <div class="panel_line">
      <h3>Редактирование: {{ other.title + ' #' + id }}</h3>
      <div class="right ml-auto">
        <a id="go_back" class="button-1 ml-30" :href="back"
        >Вернуться</a>
        <a id="add_new_other" class="button-1 ml-30" href="/home"
           @click.prevent="otherSave"
        >Сохранить</a>
      </div>
    </div>
    <div class="content">
      <form action="" ref="form_add_other" @submit.prevent="" class="list_accesses">
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
            <label>Доступ к аккаунту</label>
            <div class="form_control_input_and_label" :class="{'error': $v.email.$error}">
              <label for="input_email">E-mail:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.email.$error}" id="input_email"
                       type="text" v-model="email" @change="$v.email.$touch()">
                <div v-if="!$v.email.required" class="error_notice"
                     tooltip="Это поле обязательно для заполнения"></div>
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
          <div class="form_control_group_input">
            <label>Дополнительные поля</label>
            <div class="form_control_input_and_label" :class="{'error': $v.phone.$error}">
              <label for="input_phone">Телефон:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.phone.$error}" id="input_phone"
                       v-model="phone" type="text" @change="$v.phone.$touch()">
                <div v-if="!$v.phone.required" class="error_notice"
                     tooltip="" tooltip-2=""></div>
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
import route from '@/router/route'
import VueHeadful from 'vue-headful'
import { required, url, email } from 'vuelidate/lib/validators'

export default {
  name: 'OtherEdit',
  data: () => ({
    id: null,
    other: {
      title: ''
    },
    title: '',
    link_sign_in: '',
    login: '',
    password: '',
    email: '',
    phone: '',
    comment: '',
    form_status: null
  }),
  mounted () {
    this.id = this.$route.params.id
    this.getOther()
  },
  methods: {
    getOther () {
      this.axios.get(route('other.edit', this.id))
        .then(response => {
          this.other = response.data.data.content

          this.title = this.other.title
          this.link_sign_in = this.other.link_sign_in
          this.login = this.other.login
          this.password = this.other.password
          this.email = this.other.email
          this.phone = this.other.phone
          this.comment = this.other.comment
        })
    },
    otherSave () {
      this.$v.$touch()

      if (this.$v.$invalid) {
        this.form_status = 'ERROR'
        return
      }

      this.form_status = 'PENDING'
      const formData = new FormData()

      if (this.title !== this.other.title) formData.append('title', this.title)
      if (this.link_sign_in !== this.other.link_sign_in) formData.append('link_sign_in', this.link_sign_in)
      if (this.login !== this.other.login) formData.append('login', this.login)
      if (this.password !== this.other.password) formData.append('password', this.password)
      if (this.email !== this.other.email) formData.append('email', this.email)
      if (this.phone !== this.other.phone) formData.append('phone', this.phone)
      if (this.comment !== this.other.comment) formData.append('comment', this.comment)
      formData.append('_method', 'PATCH')

      this.axios.post(route('other.update', [this.id]), formData)
        .then(response => {
          this.$router.push({ name: 'dashboard.other.show', params: { id: this.id } })
          window.newToast('Успешно сохранено', 'success', 3)
        })
      // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    ifNotFull () {
      let check = 0

      check += this.email ? 1 : 0
      check += this.login ? 1 : 0
      check += this.password ? 3 : 0

      return !(check === 0 || check >= 4)
    }
  },
  computed: {
    back () {
      return route('dashboard.other')
    }

  },
  validations: {
    title: {
      required
    },
    login: {
      required
    },
    password: {
      required
    },
    email: {
      required,
      email
    },
    phone: {
      required
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
