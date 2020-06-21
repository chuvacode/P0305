import VueRouter from 'vue-router';
import route from "./route";

export default new VueRouter({
    routes: [
        { // Главная
            path: '/',
            name: "home",
            meta: { layout: 'dashboard' },
            component: () => import('./views/Accesses/AccessesHosts')
        },
        { // Панель управления
            path: route('dashboard'),
            name: "dashboard",
            meta: { layout: 'dashboard' },
            component: () => import('./views/Accesses/AccessesHosts')
        },
        { // Таблица доступов: Хостинг
            path: "/dashboard/host/:host",//route('dashboard.host'), // /dashboard/host/:id
            name: "dashboard.host",
            meta: {
                layout: 'dashboard'
            },
            component: () => import('./views/Accesses/AccessesHosts')
        },
        { // Просмотр: Хостинг
            path: route('dashboard.host.edit') + ':id', // route('dashboard.host.show')
            name: "dashboard.host.show",
            props: true,
            meta: {
                layout: 'dashboard'
            },
            component: () => import('./views/Accesses/Host/HostShow')
        },
        { // Редактирование: Хостинга
            path: route('dashboard.host.edit'),
            name: "dashboard.host.edit",
            meta: {
                layout: 'dashboard'
            },
            component: () => import('./views/Accesses/Host/HostEdit')
        },
        { // Таблица доступов: Сайты
            path: route('dashboard.site'),
            name: "dashboard.site",
            meta: {
                layout: 'dashboard'
            },
            component: () => import('./views/Accesses/AccessesHosts')
        },
        { // Таблица доступов: Другое
            path: route('dashboard.other'),
            name: "dashboard.other",
            meta: {
                layout: 'dashboard'
            },
            component: () => import('./views/Accesses/AccessesHosts')
        },
        { // Отчеты
            path: route('dashboard.report'),
            name: "dashboard.report",
            meta: {
                layout: 'dashboard'
            },
            component: () => import('./views/Accesses/AccessesHosts')
        }
    ],
    mode: 'history'
});
