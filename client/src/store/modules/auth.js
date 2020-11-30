import route from '@/router/route'

export default {
  state: {
    username: null,
    email: null,
    password: null,
    users: null,
    avatar_url: null
    // current_view_user: {
    //   id: null,
    //   name: null,
    //   email: null,
    //   avatar_url: null
    // }
  },
  actions: {
    LOGIN ({ state }) {
      if (state.email === '' || state.email === null ||
        state.password === '' || state.password === null) return window.newToast('Заполните все поля', 'warning')
      const formData = new FormData()
      formData.append('username', state.email)
      formData.append('password', state.password)

      return new Promise((resolve) => {
        window.api.call('post', route('api.login'), formData)
          .then(({ data }) => {
            window.auth.login(data.data.token, data.data.user)
            resolve(resolve)
          })
          // eslint-disable-next-line handle-callback-err
          .catch(error => {
            window.newToast('Неверный логин или пароль', 'error')
          })
      })
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
      // if (state.users == null) return null
      // console.log((state.users.map(user => {
      //   console.log(state.email)
      //   if (user.email === state.email) {
      //     return user.name
      //   }
      // })).shift())
      return state.users
    }
  }
}
