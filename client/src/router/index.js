import Vue from 'vue'
import store from '../store'
import VueRouter from 'vue-router'
import route from './route'

Vue.use(VueRouter)

const routes = [
  { // Авторизация
    path: '/login',
    name: 'login',
    meta: { layout: 'empty', isPageLogin: true },
    component: () => import('../views/auth/Login')
  },
  { // Главная
    path: '/',
    name: 'home',
    meta: { layout: 'dashboard', middlewareAuth: true },
    redirect: { name: 'dashboard.host' }
  },
  { // Панель управления
    path: route('dashboard'),
    name: 'dashboard',
    meta: { layout: 'dashboard', middlewareAuth: true },
    redirect: { name: 'dashboard.host' }
  },
  { // Таблица доступов: Хостинг
    path: '/dashboard/host/', // route('dashboard.host'), // /dashboard/host/:id
    name: 'dashboard.host',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Просмотр: Хостинг
    path: route('dashboard.host.show') + ':id', // route('dashboard.host.show')
    name: 'dashboard.host.show',
    props: true,
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Host/HostShow')
  },
  { // Редактирование: Хостинга
    path: route('dashboard.host.edit') + ':id',
    name: 'dashboard.host.edit',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Host/HostEdit')
  },
  { // Таблица доступов: Сайт
    path: route('dashboard.site'),
    name: 'dashboard.site.index',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Site/SiteIndex')
  },
  { // Просмотр: Сайт
    path: route('dashboard.site.show') + ':id',
    name: 'dashboard.site.show',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Site/SiteShow')
  },
  { // Редактирование: Сайт
    path: route('dashboard.site.edit') + ':id',
    name: 'dashboard.site.edit',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Site/SiteEdit')
  },
  { // Таблица доступов: Другое
    path: route('dashboard.other'),
    name: 'dashboard.other',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Other/OtherIndex')
  },
  { // Просмотр: Другое
    path: route('dashboard.other.show') + ':id',
    name: 'dashboard.other.show',
    props: true,
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Other/OtherShow')
  },
  { // Редактирование: Другое
    path: route('dashboard.other.edit') + ':id',
    name: 'dashboard.other.edit',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Other/OtherEdit')
  },
  { // Отчеты
    path: route('dashboard.report'),
    name: 'dashboard.report',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Страница редактирования персонала
    path: route('dashboard.personal'),
    name: 'personal',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Account/Personal')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.isPageLogin)) {
    if (window.localStorage.getItem('token')) {
      next({
        path: '/dashboard',
        query: { redirect: to.fullPath }
      })
    }
  }
  if (to.matched.some(record => record.meta.middlewareAuth)) {
    store.dispatch('CHECK_AUTH')
      .then(authCheck => {
        if (!authCheck) {
          next({
            path: '/login',
            query: { redirect: to.fullPath }
          })
        }
      })
      .catch(() => {
        next({
          path: '/login',
          query: { redirect: to.fullPath }
        })
      })
  }
  next()
})

export default router
