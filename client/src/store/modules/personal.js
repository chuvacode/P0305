import route from '@/router/route'

export default {
  state: {
    ALL_PERSONAL: [],
    IS_LOAD_PERSONAL: true
  },
  actions: {
    GET_ALL_PERSONAL_FROM_API ({ commit, state }) {
      return window.api.call('get', route('personal.index'))
        .then(response => {
          state.IS_LOAD_PERSONAL = false
          commit('UPDATE_ALL_PERSONAL', response.data.data.content)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Сервер не отвечает', 'error', 5)
        })
    },
    ADD_PERSONAL ({ dispatch }, formdata) {
      return window.api.call('post', route('personal.store'), formdata)
        .then(response => {
          dispatch('GET_ALL_PERSONAL_FROM_API')
          window.newToast('Успешно добавлено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    DESTROY_PERSONAL_BY_ID ({ dispatch }, id) {
      return window.api.call('delete', route('personal.destroy', [id]))
        .then(response => {
          dispatch('GET_ALL_PERSONAL_FROM_API')
          window.newToast('Успешно удалено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    }
  },
  mutations: {
    UPDATE_ALL_PERSONAL (state, data) {
      state.ALL_PERSONAL = data
    },
    UPDATE_IS_LOAD_PERSONAL (state, data) {
      state.IS_LOAD_PERSONAL = data
    }
  },
  getters: {
    GET_ALL_PERSONAL (state) {
      return state.ALL_PERSONAL
    },
    GET_IS_LOAD_PERSONAL (state) {
      return state.IS_LOAD_PERSONAL
    }
  }
}
