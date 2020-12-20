// import store from './store'
class Api {
  call (requestType, url, data = null) {
    return new Promise((resolve, reject) => {
      window.axios[requestType](url, data)
        .then(response => {
          resolve(response)
        })
        .catch(response => {
          if (response.status === 401) {
            // store.dispatch('LOGOUT')
            // return
          }
          reject(response)
        })
    })
  }
}

export default Api
