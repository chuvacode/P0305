import route from '@/router/route'

export default {
  state: {
    IS_LOAD_OTHERS: true,
    ALL_OTHERS: [],
    SHORT_OTHERS: []
  },
  actions: {
    GET_SHORT_OTHERS_FROM_API ({ commit, state }) {
      return window.api.call('get', route('other.index'), {
        params: {
          short: true
        }
      })
        .then(response => {
          state.IS_LOAD_OTHERS = false
          commit('UPDATE_SHORT_OTHERS', response.data.data.content)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Сервер не отвечает', 'error', 5)
        })
    },
    GET_ALL_OTHERS_FROM_API ({ commit }) {
      return window.api.call('get', route('other.index'))
        .then(response => {
          commit('UPDATE_ALL_OTHERS', response.data.data.content)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Сервер не отвечает', 'error', 5)
        })
    },
    ADD_OTHER ({ dispatch }, formdata) {
      return window.api.call('post', route('other.store'), formdata)
        .then(response => {
          dispatch('GET_ALL_OTHERS_FROM_API')
          window.newToast('Успешно добавлено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    DESTROY_OTHER_BY_ID ({ dispatch }, id) {
      return window.api.call('delete', route('other.destroy', [id]))
        .then(response => {
          dispatch('GET_ALL_OTHERS_FROM_API')
          window.newToast('Успешно удалено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    }
  },
  mutations: {
    UPDATE_ALL_OTHERS (state, data) {
      state.ALL_OTHERS = data
    },
    UPDATE_SHORT_OTHERS (state, data) {
      state.SHORT_OTHERS = data
    },
    UPDATE_IS_LOAD_OTHERS (state, data) {
      state.IS_LOAD_OTHERS = data
    }
  },
  getters: {
    GET_ALL_OTHERS (state) {
      return state.ALL_OTHERS
    },
    GET_SHORT_OTHERS (state) {
      return state.SHORT_OTHERS
    },
    GET_IS_LOAD_OTHERS (state, data) {
      return state.IS_LOAD_OTHERS
    }
  }
}
