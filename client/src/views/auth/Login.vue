<template>
  <form class="form_login" action="" @submit.prevent="login">
    <div class="cabinet d-flex align-items-center" @click="handleEditUsername">
      <template v-if="!edit_username & username !== ''">
        <div v-if="username !== undefined">
          <div class="avatar" :style="{'backgroundImage': `url('${avatar_url}')`}"></div>
          <span class="user_name">{{ username }}</span>
        </div>
        <div v-else>
          <span class="user_name">Пользователь не существует</span>
        </div>
      </template>
      <template v-if="!edit_username & username === ''">
        <span class="user_name">Пользователя не существует</span>
      </template>
      <template v-if="edit_username">
        <input class="invisibly" type="text" v-model.trim="email" placeholder="Введите email" list="datalist_users" @focusout="edit_username = false" @keyup.enter="edit_username = false">
        <datalist id="datalist_users">
          <option v-for="user in users" :value="user.email" :key="user.id" />
        </datalist>
      </template>
    </div>
    <div>
      <input class="invisibly" type="password" v-model.trim="password" placeholder="Введите пароль">
    </div>
    <a id="btn_auth" class="button-1" href="#" @click.prevent="login">
      Авторизоваться
    </a>
  </form>
</template>

<script>
import route from '@/router/route'

export default {
  name: 'Login',
  data: () => ({
    email: '',
    password: '',
    edit_username: false,
    users: [
      {
        id: 0,
        name: 'Чуваков Алексей',
        email: 'aleksey.chuv@yandex.ru',
        avatar_url: '/images/avatar.png'
      }
    ]
  }),
  computed: {
    username () {
      return (this.users.map(user => {
        if (user.email === this.email) {
          return user.name
        }
      })).shift()
    },
    avatar_url () {
      return (this.users.map(user => {
        if (user.email === this.email) return user.avatar_url
      })).shift()
    }
  },
  methods: {
    handleEditUsername () {
      this.edit_username = true
    },
    login () {
      if (this.email === '' || this.password === '') return

      const formData = new FormData()
      formData.append('username', this.email)
      formData.append('password', this.password)

      this.axios.post(route('api.login'), formData)
        .then(({ data }) => {
          window.auth.login(data.data.token, data.data.user)
          this.$router.push('/dashboard')
        })
        .catch(({ response }) => {
          alert(response.data.message)
        })
    }
  },
  mounted () {
    this.email = this.users[0].email
    if (window.auth.check()) {
      this.$router.push('/dashboard')
    }
  }
}
</script>

<style scoped>
  .invisibly {
    min-height: 100%;
  }
</style>
