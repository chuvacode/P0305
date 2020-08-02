import route from '@/router/route'
// import axios from 'axios'

export default {
  state: {
    ALL_SITES: []
  },
  actions: {
    GET_ALL_SITES_FROM_API (context) { // Получает полный список с доступами к сайтам
      return window.api.call('get', route('site.index'))
        .then(response => {
          context.commit('UPDATE_ALL_SITES', response.data.data.availables)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Сервер не отвечает', 'error', 5)
        })
    },
    DESTROY_SITE_BY_ID ({ dispatch }, id) {
      return window.api.call('delete', route('site.destroy', [id]))
        .then(response => {
          dispatch('GET_ALL_SITES_FROM_API')
          window.newToast('Успешно удалено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    ADD_SITE ({ dispatch }, formdata) {
      return window.api.call('post', route('site.store'), formdata)
        .then((response) => {
          dispatch('GET_ALL_SITES_FROM_API')
          window.newToast('Успешно добавлено', 'success', 3)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          window.newToast('Возникла ошибка', 'error', 3)
        })
    }
  },
  mutations: {
    UPDATE_ALL_SITES (state, data) {
      state.ALL_SITES = data
    }
  },
  getters: {
    GET_ALL_SITES (state) {
      return state.ALL_SITES
    }
  }
}
