// import route from '@/router/route'

export default {
  state: {
    LOGINED_USERNAME: null,
    LOGINED_EMAIL: null,
    LOGINED_AVATAR_URL: null
  },
  actions: {

  },
  mutations: {
    UPDATE_LOGINED_EMAIL (state, data) {
      state.LOGINED_EMAIL = data
    },
    UPDATE_LOGINED_USERNAME (state, data) {
      state.LOGINED_USERNAME = data
    },
    UPDATE_LOGINED_AVATAR_URL (state, data) {
      state.LOGINED_AVATAR_URL = data
    }
  },
  getters: {
    GET_LOGINED_USERNAME (state) {
      return state.LOGINED_USERNAME
    },
    GET_LOGINED_AVATAR_URL (state) {
      return state.LOGINED_AVATAR_URL
    },
    GET_LOGINED_EMAIL (state) {
      return state.LOGINED_EMAIL
    }
  }
}
