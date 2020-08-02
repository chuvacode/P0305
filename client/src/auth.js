// import axios from 'axios'

import route from '@/router/route'
import router from './router'

class Auth {
  constructor () {
    this.token = window.localStorage.getItem('token')

    const userData = window.localStorage.getItem('user')
    this.user = userData ? JSON.parse(userData) : null

    if (this.token) {
      window.axios.defaults.headers.common.Authorization = 'Bearer ' + this.token
      this.getUser()
    }
  }

  login (token, user) {
    window.localStorage.setItem('token', token)
    window.localStorage.setItem('user', JSON.stringify(user))

    window.axios.defaults.headers.common.Authorization = 'Bearer ' + token

    this.token = token
    this.user = user

    Event.$emit('userLoggedIn')
  }

  logout () {
    window.localStorage.removeItem('token')
    window.localStorage.removeItem('user')

    this.token = null
    this.user = null

    router.push({ name: 'login' })
  }

  check () {
    return !!this.token
  }

  getUser () {
    window.api.call('get', route('api.get-user'))
      .then(({ data }) => {
        this.user = data
      })
    // window.axios.get(route('api.get-user'))
    //   .then(({ data }) => {
    //     this.user = data
    //   })
    //   .catch(({ response }) => {
    //     if (response.status === 401) {
    //       this.logout()
    //     }
    //   })
  }
}

export default Auth
