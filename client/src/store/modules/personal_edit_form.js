export default {
  state: {
    IS_VISIBILITY_PERSONAL_EDIT_FORM: false,
    EDIT_PERSONAL_ID: null
  },
  actions: {
    START_PERSONAL_EDIT_FORM ({ commit }, personalID) {
      commit('UPDATE_IS_VISIBILITY_PERSONAL_EDIT_FORM', true)
      commit('UPDATE_EDIT_PERSONAL_ID', personalID)
    },
    CLOSE_PERSONAL_EDIT_FORM ({ commit }) {
      commit('UPDATE_IS_VISIBILITY_PERSONAL_EDIT_FORM', false)
      commit('UPDATE_EDIT_PERSONAL_ID', null)
    }
  },
  mutations: {
    UPDATE_IS_VISIBILITY_PERSONAL_EDIT_FORM (state, data) {
      state.IS_VISIBILITY_PERSONAL_EDIT_FORM = data
    },
    UPDATE_EDIT_PERSONAL_ID (state, data) {
      state.EDIT_PERSONAL_ID = data
    }
  },
  getters: {
    GET_IS_VISIBILITY_PERSONAL_EDIT_FORM (state) {
      return state.IS_VISIBILITY_PERSONAL_EDIT_FORM
    },
    GET_EDIT_PERSONAL_ID (state) {
      return state.IS_VISIBILITY_PERSONAL_EDIT_FORM
    }
  }
}
