<template>
  <div class="container-fluid container_access w-100">
    <div class="panel_line">
      <h3>Редактирование: {{ site.title + ' #' + id }}</h3>
      <div class="right ml-auto">
        <a id="go_back" class="button-1 ml-30" :href="back"
        >Вернуться</a>
        <a id="add_new_site" class="button-1 ml-30" href="/home"
           @click.prevent="siteSave"
        >Сохранить</a>
      </div>
    </div>
    <div class="content">
      <form action="" ref="form_add_site" @submit.prevent="" class="list_accesses">
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
          <div class="form_control_input_and_label" :class="{'error': $v.site_url.$error}">
            <label for="input_title">Ссылка на сайт:</label>
            <div class="form_control_container_input">
              <input class="control_input" :class="{'error': $v.site_url.$error}" id="site_url" type="text"
                     v-model="site_url" @change="$v.site_url.$touch()">
              <div v-if="!$v.site_url.required" class="error_notice"
                   tooltip="Это поле обязательно для заполнения"></div>
              <div v-if="!$v.site_url.url" class="error_notice"
                   tooltip="Значение не является ссылкой"></div>
            </div>
          </div>
          <div class="form_control_input_and_label" :class="{'error': $v.admin_panel_url.$error}">
            <label for="input_title">Страница админ-панели:</label>
            <div class="form_control_container_input">
              <input class="control_input" :class="{'error': $v.admin_panel_url.$error}" id="input_admin_panel_url" type="text"  list="names"
                     v-model="admin_panel_url" @change="$v.admin_panel_url.$touch()">
              <datalist id="names">
                <option :value="'http://' + title" />
                <option :value="'https://' + title" />
              </datalist>
              <div v-if="!$v.admin_panel_url.required" class="error_notice"
                   tooltip="Это поле обязательно для заполнения"></div>
              <div v-if="!$v.admin_panel_url.url" class="error_notice"
                   tooltip="Значение не является ссылкой"></div>
            </div>
          </div>
          <div class="form_control_container_input mt-0">
            <multiselect v-model="host" :options="options" :selectLabel="'Выбрать'" track-by="id" label="title" :custom-label="nameHostWithlogin" :selectedLabel="''" :placeholder="'Выберите хостинг'" :deselectLabel="'Убрать'" >
              <template v-slot:noResult>
                Не найдено
              </template>
            </multiselect>
          </div>

        </div>
        <div class="w-100"></div>
        <div class="d-flex">
          <div class="form_control_group_input mr-50">
            <label>Доступ к хостингу</label>
            <div class="form_control_input_and_label" :class="{'error': $v.admin_panel_login.$error}">
              <label for="input_admin_panel_login">Логин:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.admin_panel_login.$error}" id="input_admin_panel_login"
                       type="text" v-model="admin_panel_login" @change="$v.admin_panel_login.$touch()">
                <div v-if="!$v.admin_panel_login.required" class="error_notice"
                     tooltip="Это поле обязательно для заполнения"></div>
              </div>
            </div>
            <div class="form_control_input_and_label" :class="{'error': $v.admin_panel_password.$error}">
              <label for="input_admin_panel_password">Пароль:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.admin_panel_password.$error}" id="input_admin_panel_password"
                       type="text" v-model="admin_panel_password" @change="$v.admin_panel_password.$touch()">
                <div v-if="!$v.admin_panel_password.required" class="error_notice"
                     tooltip="Это поле обязательно для заполнения"></div>
              </div>
            </div>
          </div>
          <div class="form_control_group_input mr-50">
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
          <div class="form_control_group_input">
            <label>Доступ к БД</label>
            <div class="form_control_input_and_label" :class="{'error': $v.db_server.$error}">
              <label for="input_db_server">Сервер:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.db_server.$error}" id="input_db_server"
                       v-model="db_server" type="text" @change="$v.db_server.$touch()">
                <div v-if="!$v.db_server.required" class="error_notice"
                     tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
              </div>
            </div>
            <div class="form_control_input_and_label" :class="{'error': $v.db_name.$error}">
              <label for="input_db_name">Наиименование:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.db_name.$error}" id="input_db_name"
                       v-model="db_name" type="text" @change="$v.db_name.$touch()">
                <div v-if="!$v.db_name.required" class="error_notice"
                     tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
              </div>
            </div>
            <div class="form_control_input_and_label" :class="{'error': $v.db_login.$error}">
              <label for="input_db_login">Логин:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.db_login.$error}" id="input_db_login"
                       v-model="db_login" type="text" @change="$v.db_login.$touch()">
                <div v-if="!$v.db_login.required" class="error_notice"
                     tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
              </div>
            </div>
            <div class="form_control_input_and_label" :class="{'error': $v.db_password.$error}">
              <label for="input_db_password">Пароль:</label>
              <div class="form_control_container_input">
                <input class="control_input" :class="{'error': $v.db_password.$error}" id="input_db_password"
                       v-model="db_password" type="text" @change="$v.db_password.$touch()">
                <div v-if="!$v.db_password.required" class="error_notice"
                     tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
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

    <toast></toast>

  </div>
</template>

<script>
import route from '@/router/route'
import Toast from '@/utils/toast/toast'
import { required, requiredIf, url } from 'vuelidate/lib/validators'

export default {
  name: 'SiteEdit',
  data: () => ({
    id: null,
    site: {
      title: ''
    },
    title: '',
    site_url: '',
    admin_panel_url: '',
    host: '',
    admin_panel_login: '',
    admin_panel_password: '',
    ftp_server: '',
    ftp_login: '',
    ftp_password: '',
    db_server: '',
    db_name: '',
    db_login: '',
    db_password: '',
    comment: '',
    form_status: null,
    options: []
  }),
  mounted () {
    this.id = this.$route.params.id
    this.getSite()
    this.getHosts()
  },
  methods: {
    getHosts () {
      this.axios.get(route('host.index'), {
        params: {
          short: true
        }
      })
        .then(response => {
          this.options = response.data.data.content
          console.log(this.options)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
        })
    },
    // eslint-disable-next-line camelcase
    nameHostWithlogin ({ host_login, id, title }) {
      console.log({ host_login, id, title })
      // eslint-disable-next-line camelcase
      return `${title} (${host_login})`
    },
    getSite () {
      this.axios.get(route('site.edit', this.id))
        .then(response => {
          this.site = response.data.data.content
          this.title = this.site.title
          this.site_url = this.site.site_url
          this.admin_panel_url = this.site.admin_panel_url
          this.admin_panel_login = this.site.admin_panel_login
          this.admin_panel_password = this.site.admin_panel_password
          this.ftp_server = this.site.ftp_server
          this.ftp_login = this.site.ftp_login
          this.ftp_password = this.site.ftp_password
          this.db_server = this.site.db_server
          this.db_name = this.site.db_name
          this.db_login = this.site.db_login
          this.db_password = this.site.db_password
          this.comment = this.site.comment
          this.host = this.site.host ? this.site.host.host : null
        })
    },
    siteSave () {
      this.$v.$touch()

      if (this.$v.$invalid) {
        this.form_status = 'ERROR'
        return
      }

      this.form_status = 'PENDING'
      const formData = new FormData()

      if (this.title !== this.site.title) formData.append('title', this.title)
      if (this.site_url !== this.site.site_url) formData.append('site_url', this.site_url)
      if (this.admin_panel_url !== this.site.admin_panel_url) formData.append('admin_panel_url', this.admin_panel_url)
      if (this.ftp_login !== this.site.ftp_login) formData.append('ftp_login', this.ftp_login)
      if (this.ftp_password !== this.site.ftp_password) formData.append('ftp_password', this.ftp_password)
      if (this.ftp_server !== this.site.ftp_server) formData.append('ftp_server', this.ftp_server)
      if (this.admin_panel_login !== this.site.admin_panel_login) formData.append('admin_panel_login', this.admin_panel_login)
      if (this.admin_panel_password !== this.site.admin_panel_password) formData.append('admin_panel_password', this.admin_panel_password)
      if (this.comment !== this.site.comment) formData.append('comment', this.comment)
      if (this.host !== null) formData.append('host', this.host.id)
      formData.append('_method', 'PATCH')
      this.axios.post(route('site.update', [this.id]), formData)
        .then(response => {
          this.$router.push({ name: 'dashboard.site.show', params: { id: this.id } })
          window.newToast('Успешно сохранено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    ifNotFullFTP () {
      let check = 0

      check += this.ftp_server ? 1 : 0
      check += this.ftp_login ? 1 : 0
      check += this.ftp_password ? 1 : 0

      return !(check === 0 || check === 3)
    },
    ifNotFullDB () {
      let check = 0

      check += this.db_server ? 1 : 0
      check += this.db_name ? 1 : 0
      check += this.db_login ? 1 : 0
      check += this.db_password ? 1 : 0

      return !(check === 0 || check === 4)
    }
  },
  computed: {
    back () {
      return route('dashboard.site')
    }
  },
  validations: {
    title: {
      required
    },
    admin_panel_url: {
      required,
      url
    },
    admin_panel_login: {
      required
    },
    admin_panel_password: {
      required
    },
    ftp_server: {
      required: requiredIf(function () {
        return this.ifNotFullFTP()
      })
    },
    ftp_login: {
      required: requiredIf(function () {
        return this.ifNotFullFTP()
      })
    },
    ftp_password: {
      required: requiredIf(function () {
        return this.ifNotFullFTP()
      })
    },
    db_server: {
      required: requiredIf(function () {
        return this.ifNotFullDB()
      })
    },
    db_name: {
      required: requiredIf(function () {
        return this.ifNotFullDB()
      })
    },
    db_login: {
      required: requiredIf(function () {
        return this.ifNotFullDB()
      })
    },
    db_password: {
      required: requiredIf(function () {
        return this.ifNotFullDB()
      })
    },
    site_url: {
      required,
      url
    }
  },
  components: {
    Toast
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>
  .list_accesses {
    max-width: 600px;
  }
  #textarea_comment {
    min-height: 140px;
  }
</style>
