export default {
  state: {
    SIDEBAR_IS_VISIBILITY: localStorage.isOpenSidebar === 'open'
  },
  actions: {
    TOGGLE_SIDEBAR ({ commit, state }) {
      localStorage.isOpenSidebar = localStorage.isOpenSidebar === 'open' ? 'close' : 'open'
      state.SIDEBAR_IS_VISIBILITY = localStorage.isOpenSidebar === 'open'
    }
  },
  mutations: {
  },
  getters: {
    GET_SIDEBAR_IS_VISIBILITY (state) {
      return state.SIDEBAR_IS_VISIBILITY
    }
  }
}
