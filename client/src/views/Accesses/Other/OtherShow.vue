<template>
  <div class="container-fluid container_access w-100">
    <vue-headful
      title="Просмотр: Другое"
    />
    <div class="panel_line">
      <h3>Просмотр: {{ other.title + ' #' + id }}</h3>
      <div class="right ml-auto">
        <a id="go_back" class="button-1 ml-30" :href="back"
        >Вернуться</a>
        <a id="other_edit" class="button-1 ml-30" :href="url_edit">Изменить</a>
      </div>
    </div>
    <div class="content">
      <a class="preview_link" :href="other.link_sign_in" target="_blank">
        <span>Перейти на хостинг</span>
        <div class="image" :style="{ backgroundImage: 'url(' + screenshot + ')' }"></div>
      </a>
      <div class="list_accesses">
        <div class="form_control_group_input">
          <label>Доступ к аккаунту</label>
          <div class="form_control_input_and_label">
            <label for="input_email_login">E-mail:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_email_login"
                     type="text" v-model="other.email" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_login">Логин:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_login"
                     type="text" v-model="other.login" disabled>
            </div>
          </div>
          <div class="form_control_input_and_label">
            <label for="input_password">Пароль:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_password"
                     type="text" v-model="other.password" disabled>
            </div>
          </div>
        </div>
        <div v-if="!other.ftp" class="form_control_group_input">
          <label>Дополнительные данные</label>
          <div class="form_control_input_and_label">
            <label for="input_phone">Номер телефона:</label>
            <div class="form_control_container_input">
              <input class="control_input" id="input_phone"
                     type="text" v-model="other.phone" disabled>
            </div>
          </div>
        </div>
        <div class="w-100"></div>
        <div v-show="other.comment && other.comment !== ''" class="form_control_textarea_and_label w-100" style="height: 100%;">
          <label for="textarea_comment">Комментарий:</label>
          <textarea class="control_textarea w-100" id="textarea_comment"
                    v-model="other.comment" type="text" disabled></textarea>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueHeadful from 'vue-headful'
import route from '@/router/route'

export default {
  name: 'OtherShow',
  data: () => ({
    id: null,
    other: {
      title: ''
    },
    screenshot: ''
  }),
  mounted () {
    this.id = this.$route.params.id
    this.getOther()
  },
  methods: {
    getOther () {
      this.axios.get(route('other.show', [this.id]))
        .then(response => {
          this.other = response.data.data.content
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
          url: this.other.title
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
      return route('dashboard.other')
    },
    url_edit () {
      return route('dashboard.other.edit', [this.id])
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
