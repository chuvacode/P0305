<template>
  <div class="container-fluid container_access w-100">
    <div class="panel_line">
      <h3>Просмотр: {{ site.title + ' #' + id }}</h3>
      <div class="right ml-auto">
        <a id="go_back" class="button-1 ml-30" :href="back"
        >Вернуться</a>
        <a id="site_edit" class="button-1 ml-30" :href="url_edit">Изменить</a>
      </div>
    </div>
    <div class="content">
      <a class="preview_link" :href="site.link_sign_in" target="_blank">
        <span>Перейти на хостинг</span>
        <div class="image" :style="{backgroundImage: 'url(' + screenshot + ')'}"></div>
      </a>

      <div class="list_accesses">
        <div class="form_control_group_input mr-50">
          <label>Доступ к админ-панели</label>
          <div class="form_control_input_and_label">
            <label for="input_admin_panel_login">Логин:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_admin_panel_login"
                     type="text" v-model="site.admin_panel_login" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_admin_panel_password">Пароль:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_admin_panel_password"
                     type="text" v-model="site.admin_panel_password" disabled>
            </div>
          </div>
        </div>
        <div v-if="this.site.ftp_server" class="form_control_group_input mr-50">
          <label>Доступ к FTP</label>
          <div class="form_control_input_and_label">
            <label for="input_ftp_server">Сервер:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_ftp_server"
                     type="text" v-model="site.ftp_server" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_ftp_login">Логин:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_ftp_login"
                     type="text" v-model="site.ftp_login" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_ftp_password">Пароль:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_ftp_password"
                     type="text" v-model="site.ftp_password" disabled>
            </div>
          </div>
        </div>
        <div v-if="this.site.db_server" class="form_control_group_input">
          <label>Доступ к БД</label>
          <div class="form_control_input_and_label">
            <label for="input_db_server">Сервер:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_db_server"
                     type="text" v-model="site.db_server" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_db_name">Наименование:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_db_name"
                     type="text" v-model="site.db_name" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_db_login">Логин:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_db_login"
                     type="text" v-model="site.db_login" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_db_password">Пароль:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_db_password"
                     type="text" v-model="site.db_password" disabled>
            </div>
          </div>
        </div>
        <div class="w-100"></div>
        <div v-if="this.site.comment !== '' && this.site.comment" class="form_control_textarea_and_label w-100" style="height: 100%;">
          <label for="textarea_comment">Комментарий:</label>
          <textarea class="control_textarea w-100" id="textarea_comment"
                    v-model="site.comment" type="text" disabled></textarea>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import route from '@/router/route'

export default {
  name: 'SiteShow',
  data: () => ({
    id: null,
    site: {
      title: ''
    },
    screenshot: ''
  }),
  mounted () {
    this.id = this.$route.params.id
    this.getSite()
  },
  methods: {
    getSite () {
      this.axios.get(route('site.show', [this.id]))
        .then(response => {
          this.site = response.data.data.content
          this.getSreenshot()
        })
      // eslint-disable-next-line handle-callback-err
        .catch(error => {
          console.log('bad')
        })
    },
    getSreenshot () {
      this.axios.get(route('api.screenshot', [this.site.title]))
        .then(response => {
          this.screenshot = response.data.data.screenshot
        })
      // eslint-disable-next-line handle-callback-err
        .catch(error => {})
    }
  },
  computed: {
    back () {
      return route('dashboard.site')
    },
    url_edit () {
      return route('dashboard.site.edit', [this.id])
    }
  },
  components: {
  }
}
</script>

<style scoped>
  .list_accesses {
    /*max-width: 800px;*/
  }
  #textarea_comment {
    min-height: 140px;
    max-width: 568px;
  }
</style>
