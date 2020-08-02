import Vue from 'vue'
import VueRouter from 'vue-router'
import route from './route'

Vue.use(VueRouter)

const routes = [
  { // Авторизация
    path: '/login',
    name: 'login',
    meta: { layout: 'empty' },
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
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Отчеты
    path: route('dashboard.report'),
    name: 'dashboard.report',
    meta: { layout: 'dashboard', middlewareAuth: true },
    component: () => import('../views/Accesses/Host/HostIndex')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.middlewareAuth)) {
    if (!window.auth.check()) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })

      return
    }
  }

  next()
})

export default router
