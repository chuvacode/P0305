import route from '@/router/route'
import router from '../../router'

export default {
  state: {
    username: null,
    email: null,
    password: null,
    users: null,
    avatar_url: null,
    AUTHORIZED_USERNAME: null,
    AUTHORIZED_AVATAR_URL: null,
    AUTHORIZED_EMAIL: null,
    API_TOKEN: null
  },
  actions: {
    CHECK_AUTH ({ getters, dispatch, commit }) {
      if (window.localStorage.getItem('token') === null) router.push('/login')
      // Not found API TOKEN
      window.axios.defaults.headers.common.Authorization = 'Bearer ' + window.localStorage.getItem('token')
      // Not found USER DATA
      const isGetData = window.localStorage.getItem('user') === null
      return new Promise((resolve) => {
        window.api.call('get', route('api.get-user'))
          .then(({ data }) => {
            if (isGetData) {
              window.localStorage.setItem('user', JSON.stringify(data.data.user))
            }
            commit('UPDATE_AUTHORIZED_USERNAME')
            commit('UPDATE_AUTHORIZED_AVATAR_URL')
            resolve(true)
          })
          // eslint-disable-next-line handle-callback-err
          .catch(error => {
          })
      })
    },
    LOGIN ({ state, commit }) {
      // Checking the received data
      if (state.email === '' ||
        state.email === null ||
        state.password === '' ||
        state.password === null) { return window.newToast('Заполните все поля', 'warning') }
      // Create FormData
      const formData = new FormData()
      formData.append('username', state.email)
      formData.append('password', state.password)

      return new Promise((resolve) => {
        window.api.call('post', route('api.login'), formData)
          .then(({ data }) => {
            window.localStorage.setItem('token', data.data.token)
            window.localStorage.setItem('user', JSON.stringify(data.data.user))
            state.password = null
            router.push('/dashboard')
            resolve(resolve)
          })
          // eslint-disable-next-line handle-callback-err
          .catch(error => {
            window.newToast('Неверный логин или пароль', 'error')
          })
      })
    },
    LOGOUT ({ state }) {
      window.localStorage.removeItem('token')
      window.localStorage.removeItem('user')
      window.axios.defaults.headers.common.Authorization = null
      router.push({ name: 'login' })
    },
    GET_ALL_USERS_FROM_API ({ commit }) {
      return window.api.call('get', route('api.user.index'))
        .then(response => {
          commit('UPDATE_ALL_USERS', response.data.data.content)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Сервер не отвечает', 'error', 5)
        })
    },
    UPDATE_VIEW_USER_BY_ID ({ commit, state }, id) {
      commit('UPDATE_VIEW_USER', state.users[id])
    },
    SET_EMAIL ({ commit }, data) {
      commit('UPDATE_EMAIL', data)
    },
    SET_PASSWORD ({ commit }, data) {
      commit('UPDATE_PASSWORD', data)
    },
    SET_AUTHORIZED_USER ({ commit }, data) {
      commit('')
    }
  },
  mutations: {
    UPDATE_PASSWORD (state, data) {
      state.password = data
    },
    UPDATE_EMAIL (state, data) {
      state.email = data
    },
    UPDATE_VIEW_USER (state, data) {
      state.current_view_user = data
    },
    UPDATE_ALL_USERS (state, data) {
      state.users = data
    },
    UPDATE_AUTHORIZED_USER (state, data) {
      state.AUTHORIZED_USERNAME = window.localStorage.setItem('user', data)
    },
    UPDATE_AUTHORIZED_USERNAME (state) {
      state.AUTHORIZED_USERNAME = (JSON.parse(window.localStorage.getItem('user'))).name
    },
    UPDATE_AUTHORIZED_AVATAR_URL (state) {
      state.AUTHORIZED_AVATAR_URL = (JSON.parse(window.localStorage.getItem('user'))).avatar_url
    }
  },
  getters: {
    GET_USERNAME (state) {
      if (state.users == null || state.email === null || state.email === '') return null
      state.username = undefined
      state.users.map(user => {
        if (user.email === state.email) {
          state.username = user.name
        }
      })
      return state.username
    },
    GET_AVATAR_URL (state) {
      if (state.users == null) return null
      state.avatar_url = null
      state.users.map(user => {
        if (user.email === state.email) {
          state.avatar_url = user.avatar_url
        }
      })
      return state.avatar_url
    },
    GET_PASSWORD (state) {
      return state.password
    },
    GET_EMAIL (state) {
      return state.email
    },
    GET_ALL_USERS (state) {
      return state.users
    },
    GET_AUTHORIZED_USERNAME (state) {
      return state.AUTHORIZED_USERNAME
      // return (JSON.parse(window.localStorage.getItem('user'))).name
    },
    GET_AUTHORIZED_AVATAR_URL (state) {
      return state.AUTHORIZED_AVATAR_URL
      // return (JSON.parse(window.localStorage.getItem('user'))).avatar_url
    },
    GET_AUTHORIZED_EMAIL (state) {
      return state.AUTHORIZED_EMAIL
      // return (JSON.parse(window.localStorage.getItem('user'))).email
    },
    GET_API_TOKEN (state) {
      return state.API_TOKEN
      // return window.localStorage.getItem('token')
    }
  }
}
