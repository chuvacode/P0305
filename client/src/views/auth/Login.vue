<template>
  <form class="form_login" action="" @submit.prevent="handleLogin">
    <div class="cabinet d-flex align-items-center" @click="handleEditUsername">
      <template v-if="!edit_username & GET_USERNAME !== null">
        <div v-if="GET_USERNAME !== '' & GET_USERNAME !== undefined">
          <div class="avatar avatar--large" :style="{'backgroundImage': `url('${GET_AVATAR_URL}')`}"></div>
          <span class="user_name">{{ GET_USERNAME }}</span>
        </div>
        <div v-else>
          <span class="user_name">Пользователь не существует</span>
        </div>
      </template>
      <template v-else>
        <input class="invisibly" type="text" v-model.trim="email" placeholder="Введите email" list="datalist_users" @focusout="handleFocusOutUsername" @keyup.enter="edit_username = false" > <!--v-focus-if-not-empty-->
        <datalist id="datalist_users">
          <option v-for="user in GET_ALL_USERS" :value="user.email" :key="user.id" />
        </datalist>
      </template>
    </div>
    <div>
      <input class="invisibly" type="password" v-model.trim="password" placeholder="Введите пароль">
    </div>
    <a id="btn_auth" class="button-1" href="#" @click.prevent="handleLogin">
      Авторизоваться
    </a>
  </form>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Login',
  mounted () {
    this.GET_ALL_USERS_FROM_API().then(response => {
      this.UPDATE_VIEW_USER_BY_ID(0)
      console.log(this.email)
      this.edit_username = this.email === null
    })
  },
  data: () => ({
    edit_username: false
  }),
  computed: {
    ...mapGetters([
      'GET_ALL_USERS',
      'GET_PASSWORD',
      'GET_EMAIL',
      'GET_USERNAME',
      'GET_AVATAR_URL'
    ]),
    email: {
      get () {
        return this.GET_EMAIL
      },
      set (data) {
        this.SET_EMAIL(data)
      }
    },
    password: {
      get () {
        return this.GET_PASSWORD
      },
      set (data) {
        this.SET_PASSWORD(data)
      }
    }
  },
  methods: {
    ...mapActions([
      'GET_ALL_USERS_FROM_API',
      'UPDATE_VIEW_USER_BY_ID',
      'SET_EMAIL',
      'LOGIN',
      'SET_PASSWORD'
    ]),
    handleEditUsername () {
      this.edit_username = true
    },
    handleFocusOutUsername () {
      this.edit_username = this.GET_USERNAME === null
    },
    handleLogin () {
      this.LOGIN()
    }
  }
}
</script>

<style scoped>
  .invisibly {
    min-height: 100%;
  }
</style>
