import route from '@/router/route'
// import axios from 'axios'

export default {
  state: {
    IS_LOAD_HOSTS: true,
    ALL_HOSTS: [],
    SHORT_HOSTS: []
  },
  actions: {
    GET_SHORT_HOSTS_FROM_API ({ commit, state }) {
      return window.api.call('get', route('host.index'), {
        params: {
          short: true
        }
      })
        .then(response => {
          commit('UPDATE_SHORT_HOSTS', response.data.data.content)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Сервер не отвечает', 'error', 5)
        })
    },
    GET_ALL_HOSTS_FROM_API ({ commit, state }) {
      return window.api.call('get', route('host.index'))
        .then(response => {
          state.IS_LOAD_HOSTS = false
          commit('UPDATE_ALL_HOSTS', response.data.data.content)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          switch (error.message) {
            case 'Network Error':
              window.newToast('Сервер не отвечает', 'error', 5)
              break
            default:
              window.newToast('Не обработанная ошибка', 'error', 5)
              break
          }
          throw error
        })
    },
    ADD_HOST ({ dispatch }, formdata) {
      return window.api.call('post', route('host.store'), formdata)
        .then(response => {
          dispatch('GET_ALL_HOSTS_FROM_API')
          window.newToast('Успешно добавлено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    DESTROY_HOST_BY_ID ({ dispatch }, id) {
      return window.api.call('delete', route('host.destroy', [id]))
        .then(response => {
          dispatch('GET_ALL_HOSTS_FROM_API')
          window.newToast('Успешно удалено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    }
  },
  mutations: {
    UPDATE_ALL_HOSTS (state, data) {
      state.ALL_HOSTS = data
    },
    UPDATE_SHORT_HOSTS (state, data) {
      state.SHORT_HOSTS = data
    },
    UPDATE_IS_LOAD_HOSTS (state, data) {
      state.IS_LOAD_HOSTS = data
    }
  },
  getters: {
    GET_ALL_HOSTS (state) {
      return state.ALL_HOSTS
    },
    GET_SHORT_HOSTS (state) {
      return state.SHORT_HOSTS
    },
    GET_IS_LOAD_HOSTS (state) {
      return state.IS_LOAD_HOSTS
    }
  }
}
