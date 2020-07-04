// import route from '@/router/route'
// import axios from 'axios'

export default {
  state: {
    IS_VISIBILITY_CONFIRM_FORM: false,
    CONFIRM_PAYLOAD: null
  },
  actions: {
    START_CONFIRM_FORM (context, payload) {
      context.commit('UPDATE_CONFIRM_PAYLOAD', payload)
      context.commit('UPDATE_IS_VISIBILITY_CONFIRM_FORM', true)
    },
    TOGGLE_CONFIRM_FORM ({ commit, state }) {
      commit('UPDATE_IS_VISIBILITY_CONFIRM_FORM', !state.IS_VISIBILITY_CONFIRM_FORM)
    },
    UPDATE_CONFIRM_STATUS ({ commit, dispatch, state }, status) {
      if (status) {
        state.CONFIRM_PAYLOAD()
      }

      dispatch('TOGGLE_CONFIRM_FORM')
      commit('UPDATE_CONFIRM_PAYLOAD', null)
    }
  },
  mutations: {
    UPDATE_CONFIRM_PAYLOAD (state, data) {
      state.CONFIRM_PAYLOAD = data
    },
    UPDATE_IS_VISIBILITY_CONFIRM_FORM (state, data) {
      state.IS_VISIBILITY_CONFIRM_FORM = data
    }
  },
  getters: {
    GET_IS_VISIBILITY_CONFIRM_FORM (state) {
      return state.IS_VISIBILITY_CONFIRM_FORM
    }
  }
}
