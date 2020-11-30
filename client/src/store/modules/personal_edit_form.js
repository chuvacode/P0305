import route from '@/router/route'

export default {
  state: {
    IS_VISIBILITY_PERSONAL_EDIT_FORM: false,
    ID_PERSONAL_EDIT_FORM: null,
    SUBMIT_STATUS_PERSONAL_EDIT_FORM: null,
    USERNAME_PERSONAL_EDIT_FORM: '',
    EMAIL_PERSONAL_EDIT_FORM: '',
    LIST_PRIVILEGES_PERSONAL_EDIT_FORM: [
      {
        name: 'administrator',
        label: 'Администатор'
      },
      {
        name: 'worker',
        label: 'Рабочий'
      }
    ],
    PRIVILEGE_PERSONAL_EDIT_FORM: {
      name: 'worker',
      label: 'Рабочий'
    }
  },
  actions: {
    SUBMIT_PERSONAL_EDIT_FORM ({ state, commit, dispatch }) {
      commit('UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM', 'PENDING')

      const formData = new FormData()
      formData.append('name', state.USERNAME_PERSONAL_EDIT_FORM)
      formData.append('email', state.EMAIL_PERSONAL_EDIT_FORM)
      formData.append('privilege', state.PRIVILEGE_PERSONAL_EDIT_FORM.name)

      return window.api.call('post', route('personal.update'), formData)
        .then(response => {
          window.newToast('Успешно обновлено', 'success', 3)
          commit('UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM', 'OK')
          dispatch('CLOSE_PERSONAL_EDIT_FORM')
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          commit('UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM', 'ERROR')
          window.newToast('Возникла ошибка', 'error', 3)
        })
    },
    START_PERSONAL_EDIT_FORM ({ state, commit }, personalID) {
      commit('UPDATE_IS_VISIBILITY_PERSONAL_EDIT_FORM', true)
      commit('UPDATE_ID_PERSONAL_EDIT_FORM', personalID)
      window.api.call('get', route('personal.edit', [personalID]))
        .then(response => {
          // eslint-disable-next-line no-unused-vars
          const data = response.data.data.content
          commit('UPDATE_USERNAME_PERSONAL_EDIT_FORM', data.name)
          commit('UPDATE_EMAIL_PERSONAL_EDIT_FORM', data.email)
          commit('UPDATE_PRIVILEGE_PERSONAL_EDIT_FORM', data.privilege)
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          console.log(error)
        })
    },
    CLOSE_PERSONAL_EDIT_FORM ({ commit, dispatch }) {
      commit('UPDATE_IS_VISIBILITY_PERSONAL_EDIT_FORM', false)
      dispatch('CLEAR_PERSONAL_EDIT_FORM')
    },
    CLEAR_PERSONAL_EDIT_FORM ({ commit, state }) {
      commit('UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM', null)
      commit('UPDATE_USERNAME_PERSONAL_EDIT_FORM', '')
      commit('UPDATE_EMAIL_PERSONAL_EDIT_FORM', '')
      commit('UPDATE_PRIVILEGE_PERSONAL_EDIT_FORM', state.LIST_PRIVILEGES_PERSONAL_EDIT_FORM[1].name)
    }
  },
  mutations: {
    UPDATE_IS_VISIBILITY_PERSONAL_EDIT_FORM (state, data) {
      state.IS_VISIBILITY_PERSONAL_EDIT_FORM = data
    },
    UPDATE_ID_PERSONAL_EDIT_FORM (state, data) {
      state.ID_PERSONAL_EDIT_FORM = data
    },
    UPDATE_USERNAME_PERSONAL_EDIT_FORM (state, data) {
      state.USERNAME_PERSONAL_EDIT_FORM = data
    },
    UPDATE_EMAIL_PERSONAL_EDIT_FORM (state, data) {
      state.EMAIL_PERSONAL_EDIT_FORM = data
    },
    UPDATE_PRIVILEGE_PERSONAL_EDIT_FORM (state, data) {
      if (typeof data !== 'string') data = data.name
      state.LIST_PRIVILEGES_PERSONAL_EDIT_FORM.forEach(privilege => {
        if (privilege.name === data) {
          state.PRIVILEGE_PERSONAL_EDIT_FORM = privilege
        }
      })
    },
    UPDATE_SUBMIT_STATUS_PERSONAL_EDIT_FORM (state, data) {
      state.SUBMIT_STATUS_PERSONAL_EDIT_FORM = data
    }
  },
  getters: {
    GET_IS_VISIBILITY_PERSONAL_EDIT_FORM (state) {
      return state.IS_VISIBILITY_PERSONAL_EDIT_FORM
    },
    GET_SUBMIT_STATUS_PERSONAL_EDIT_FORM  (state) {
      return state.SUBMIT_STATUS_PERSONAL_EDIT_FORM
    },
    GET_USERNAME_PERSONAL_EDIT_FORM  (state) {
      return state.USERNAME_PERSONAL_EDIT_FORM
    },
    GET_EMAIL_PERSONAL_EDIT_FORM  (state) {
      return state.EMAIL_PERSONAL_EDIT_FORM
    },
    GET_PRIVILEGE_PERSONAL_EDIT_FORM  (state) {
      return state.PRIVILEGE_PERSONAL_EDIT_FORM
    },
    GET_LIST_PRIVILEGES_PERSONAL_EDIT_FORM  (state) {
      return state.LIST_PRIVILEGES_PERSONAL_EDIT_FORM
    }
  }
}
