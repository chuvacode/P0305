<template>
  <div class="container-fluid container_access w-100">
    <div class="panel_line">
      <h3>Просмотр: {{ host.title + ' #' + id }}</h3>
      <div class="right ml-auto">
        <a id="go_back" class="button-1 ml-30" :href="back"
        >Вернуться</a>
        <a id="host_edit" class="button-1 ml-30" :href="url_edit">Изменить</a>
      </div>
    </div>
    <div class="content">
      <a class="preview_link" :href="host.link_sign_in" target="_blank">
        <span>Перейти на хостинг</span>
        <div class="image" :style="{ backgroundImage: 'url(' + screenshot + ')' }"></div>
      </a>
      <div class="list_accesses">
        <div class="form_control_group_input">
          <label>Доступ к хостингу</label>
          <div class="form_control_input_and_label">
            <label for="input_host_login">Логин:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_host_login"
                     type="text" v-model="host.host_login" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_host_password">Пароль:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_host_password"
                     type="text" v-model="host.host_password" disabled>
            </div>
          </div>
        </div>
        <div v-if="!host.ftp" class="form_control_group_input">
          <label>Доступ к FTP</label>
          <div class="form_control_input_and_label">
            <label for="input_ftp_server">Сервер:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_ftp_server"
                     type="text" v-model="host.ftp_server" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_ftp_login">Логин:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_ftp_login"
                     type="text" v-model="host.ftp_login" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_ftp_password">Пароль:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_ftp_password"
                     type="text" v-model="host.ftp_password" disabled>
            </div>
          </div>
        </div>
        <div class="w-100"></div>
        <div v-show="host.comment && host.comment !== ''" class="form_control_textarea_and_label w-100" style="height: 100%;">
          <label for="textarea_comment">Комментарий:</label>
          <textarea class="control_textarea w-100" id="textarea_comment"
                    v-model="host.comment" type="text" disabled></textarea>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import route from '@/router/route'

export default {
  name: 'HostShow',
  data: () => ({
    id: null,
    host: {
      title: ''
    },
    screenshot: ''
  }),
  mounted () {
    this.id = this.$route.params.id
    this.getHost()
  },
  methods: {
    getHost () {
      this.axios.get(route('host.show', [this.id]))
        .then(response => {
          this.host = response.data.data.content
          this.getSreenshot()
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          console.log('bad')
        })
    },
    getSreenshot () {
      this.axios.get(route('api.screenshot'), {
        params: {
          url: this.host.title
        }
      })
        .then(response => {
          this.screenshot = response.data.data.screenshot
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {})
    }
  },
  computed: {
    back () {
      return route('dashboard.host')
    },
    url_edit () {
      return route('dashboard.host.edit', [this.id])
    }
  },
  components: {
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
