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
                  <!-- Поле для ввода ссылки на сайт -->
                  <div class="form_control_input_and_label col-6" :class="{'error': $v.site_url.$error}">
                    <label for="input_title">Ссылка на сайт:</label>
                    <div class="form_control_container_input">
                      <input class="control_input" :class="{'error': $v.site_url.$error}" id="input_site_url" type="text"  list="names"
                             v-model="site_url" @change="$v.site_url.$touch()">
                      <datalist id="names">
                        <option :value="'http://' + title" />
                        <option :value="'https://' + title" />
                      </datalist>
                      <div v-if="!$v.site_url.required" class="error_notice"
                           tooltip="Это поле обязательно для заполнения"></div>
                      <div v-if="!$v.site_url.url" class="error_notice"
                           tooltip="Значение не является ссылкой"></div>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <!-- Группа для ввода данных для авторизации в админ-панели -->
                  <div class="form_control_group_input col-6">
                    <label>Доступ к админ-панели:</label>
                    <div class="form_control_input_and_label" :class="{'error': $v.admin_panel_url.$error}">
                      <label for="input_host_login">Ссылка:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.admin_panel_url.$error}" id="input_admin_panel_url"
                               type="text" v-model="admin_panel_url" @change="$v.admin_panel_url.$touch()" list="admin_panel_url_list">
                        <datalist id="admin_panel_url_list">
                          <option :value="site_url + '/wplogin'" />
                          <option :value="site_url + '/wp-admin'" />
                          <option :value="site_url + '/wp-login.php'" />
                          <option :value="site_url + '/administrator'" />
                          <option :value="site_url + '/manager'" />
                        </datalist>
                        <div v-if="!$v.admin_panel_url.required" class="error_notice"
                             tooltip="Это поле обязательно для заполнения"></div>
                        <div v-if="!$v.admin_panel_url.url" class="error_notice"
                             tooltip="Значение не является ссылкой"></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.admin_panel_login.$error}">
                      <label for="input_host_login">Логин:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.admin_panel_login.$error}" id="input_host_login"
                               type="text" v-model="admin_panel_login" @change="$v.admin_panel_login.$touch()">
                        <div v-if="!$v.admin_panel_login.required" class="error_notice"
                             tooltip="Это поле обязательно для заполнения"></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.admin_panel_password.$error}">
                      <label for="input_host_password">Пароль:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.admin_panel_password.$error}" id="input_host_password"
                               type="text" v-model="admin_panel_password" @change="$v.admin_panel_password.$touch()">
                        <div v-if="!$v.admin_panel_password.required" class="error_notice"
                             tooltip="Это поле обязательно для заполнения"></div>
                      </div>
                    </div>
                  </div>
                  <!-- Группа для ввода данных для FTP -->
                  <div class="form_control_group_input col-6">
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
                <div class="d-flex">
                  <!-- Группа для ввода данных для базы-данных -->
                  <div class="form_control_group_input col-6">
                    <label>Доступ к БД(не обязательно)</label>
                    <div class="form_control_input_and_label" :class="{'error': $v.db_server.$error}">
                      <label for="input_ftp_server">Сервер:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.db_server.$error}" id="input_db_server"
                               v-model="db_server" type="text" @change="$v.db_server.$touch()">
                        <div v-if="!$v.db_server.required" class="error_notice"
                             tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.db_name.$error}">
                      <label for="input_ftp_server">Имя:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.db_name.$error}" id="input_db_name"
                               v-model="db_name" type="text" @change="$v.db_name.$touch()">
                        <div v-if="!$v.db_name.required" class="error_notice"
                             tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.db_login.$error}">
                      <label for="input_ftp_login">Логин:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.db_login.$error}" id="input_db_login"
                               v-model="db_login" type="text" @change="$v.db_login.$touch()">
                        <div v-if="!$v.db_login.required" class="error_notice"
                             tooltip="Все поля доступа к БД должны быть заполнены или пусты" tooltip-2=""></div>
                      </div>
                    </div>
                    <div class="form_control_input_and_label" :class="{'error': $v.db_password.$error}">
                      <label for="input_ftp_password">Пароль:</label>
                      <div class="form_control_container_input">
                        <input class="control_input" :class="{'error': $v.db_password.$error}" id="input_db_password"
                               v-model="db_password" type="text" @change="$v.db_password.$touch()">
                        <div v-if="!$v.db_password.required" class="error_notice"
                             tooltip="Все поля доступа к FTP должны быть заполнены или пусты" tooltip-2=""></div>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 d-flex flex-column" style="padding-bottom: 12px;">
                    <!-- Поле для ввода комментария -->
                    <div class="form_control_textarea_and_label" style="height: 180px;">
                      <label for="textarea_comment">Комментарий(не обязательно):</label>
                      <textarea class="control_textarea" id="textarea_comment"
                                v-model="comment" type="text"></textarea>
                    </div>
                    <!-- Поле прикрепления к хостингу -->
                    <div class="form_control_input_and_label">
                      <div class="form_control_container_input mt-0">
                        <multiselect v-model="host" :options="GET_SHORT_HOSTS" :selectLabel="'Выбрать'" track-by="id" :custom-label="nameHostWithlogin" label="title" :selectedLabel="''" :placeholder="'Выберите хостинг'" :deselectLabel="'Убрать'" >
                          <template v-slot:noResult>
                            Не найдено
                          </template>
                        </multiselect>
                      </div>
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
        <div v-if="isVisibility" @click="clearForm" class="overlay_bg"></div> <!--handleClose-->
      </transition>
    </div>
  </transition>
</template>

<script>
import { required, requiredIf, url } from 'vuelidate/lib/validators'
import route from '@/router/route'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'FormAddHost',
  data: () => ({
    title: '',
    site_url: '',
    admin_panel_url: '',
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
    host: '',
    submit_status: null
  }),
  computed: {
    ...mapGetters([
      'GET_SHORT_HOSTS'
    ])
  },
  props: [
    'isVisibility'
  ],
  mounted () {
    this.GET_SHORT_HOSTS_FROM_API()
  },
  methods: {
    ...mapActions([
      'ADD_SITE',
      'GET_SHORT_HOSTS_FROM_API'
    ]),
    // eslint-disable-next-line camelcase
    nameHostWithlogin ({ host_login, id, title }) {
      // eslint-disable-next-line camelcase
      return `${title} (${host_login})`
    },
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
        formData.append('site_url', this.site_url)
        formData.append('admin_panel_url', this.admin_panel_url)
        formData.append('admin_panel_login', this.admin_panel_login)
        formData.append('admin_panel_password', this.admin_panel_password)
        formData.append('ftp_server', this.ftp_server)
        formData.append('ftp_login', this.ftp_login)
        formData.append('ftp_password', this.ftp_password)
        formData.append('db_server', this.db_server)
        formData.append('db_name', this.db_name)
        formData.append('db_login', this.db_login)
        formData.append('db_password', this.db_password)
        formData.append('comment', this.comment)
        formData.append('host', this.host && this.host !== '' ? this.host.id : null)

        this.ADD_SITE(formData)
          .then(response => {
            this.submit_status = 'OK'
            this.handleClose()
            this.clearForm()
            this.axios.get(route('api.screenshot', [this.title]))
          })
          // eslint-disable-next-line handle-callback-err
          .catch(error => {
            this.submit_status = 'ERROR'
            window.newToast('Возникла ошибка', 'error', 3)
          })
      }
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
    },
    clearForm () {
      this.title = ''
      this.site_url = ''
      this.admin_panel_url = ''
      this.admin_panel_login = ''
      this.admin_panel_password = ''
      this.ftp_server = ''
      this.ftp_login = ''
      this.ftp_password = ''
      this.db_server = ''
      this.db_name = ''
      this.db_login = ''
      this.db_password = ''
      this.$v.$reset()
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
  }
}
</script>

<style scoped>
  .multiselect--above .multiselect__content-wrapper {
    max-width: 283px!important;
  }
</style>
