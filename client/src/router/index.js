import Vue from 'vue'
import VueRouter from 'vue-router'
import route from './route'

Vue.use(VueRouter)

const routes = [
  { // Главная
    path: '/',
    name: 'home',
    meta: { layout: 'dashboard' },
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Панель управления
    path: route('dashboard'),
    name: 'dashboard',
    meta: { layout: 'dashboard' },
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Таблица доступов: Хостинг
    path: '/dashboard/host/', // route('dashboard.host'), // /dashboard/host/:id
    name: 'dashboard.host',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Просмотр: Хостинг
    path: route('dashboard.host.show') + ':id', // route('dashboard.host.show')
    name: 'dashboard.host.show',
    props: true,
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Host/HostShow')
  },
  { // Редактирование: Хостинга
    path: route('dashboard.host.edit') + ':id',
    name: 'dashboard.host.edit',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Host/HostEdit')
  },
  { // Таблица доступов: Сайт
    path: route('dashboard.site'),
    name: 'dashboard.site',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Site/SiteIndex')
  },
  { // Просмотр: Сайт
    path: route('dashboard.site.show'),
    name: 'dashboard.site',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Site/SiteShow')
  },
  { // Редактирование: Сайт
    path: route('dashboard.site.edit'),
    name: 'dashboard.site',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Site/SiteEdit')
  },
  { // Таблица доступов: Другое
    path: route('dashboard.other'),
    name: 'dashboard.other',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Host/HostIndex')
  },
  { // Отчеты
    path: route('dashboard.report'),
    name: 'dashboard.report',
    meta: {
      layout: 'dashboard'
    },
    component: () => import('../views/Accesses/Host/HostIndex')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
