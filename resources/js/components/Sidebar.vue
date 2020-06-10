<template>
    <nav class="nav_sidebar" @click="checkCurrentPage" :class="{hide:!sideBarVisibility}">
<!--        {-->
<!--            "Доступы": {-->
<!--                "type": "category",-->
<!--                "open": "true",-->
<!--                "views": ["Хостинги", "Сайты", "Другое"]-->
<!--            },-->
<!--            "Хостинги": {-->
<!--                "url": "http://127.0.0.1:8000/dashboard/host"-->
<!--            },-->
<!--            "Сайты": {-->
<!--                "url": "http://127.0.0.1:8000/dashboard/site"-->
<!--            },-->
<!--            "Другое": {-->
<!--                "url": "http://127.0.0.1:8000/dashboard/other"-->
<!--            },-->
<!--            "Отчеты": {-->
<!--                "url": "http://127.0.0.1:8000/dashboard/report",-->
<!--            }-->
<!--        }-->
        <ul>
            <!--Перебор родительских пунктов меню-->
            <li v-for="(item, key) in menu"
                :class="{item_menu_dropdown:isChilds(item),
                         active:checkCurrentPage(item.url, item.childs),
                         'item-open':isChilds(item) && item.open,
                         'item-close':isChilds(item) && !item.open}"
            >
                <!--Если с дочерними элементами-->
                <template v-if="isChilds(item)">
                    <span class="item_menu" @click="toggleMenuItem(key)"><span>{{ key }}</span><i v-if="isChilds(item)" class="ml-auto icon_dropdown"></i></span>
                    <ul v-if="item.open">
                        <li v-for="(itemChild, keyChild) in item.childs" :class="{active:checkCurrentPage(itemChild.url)}">
                            <span class="item_menu"><span><a :href="itemChild.url">{{ keyChild }}</a></span></span>
                        </li>
                    </ul>
                </template>

                <!--Одиночный элемент-->
                <template v-else="">
                    <span class="item_menu"><a :href="item.url">{{ key }}</a></span>
                </template>
            </li>
        </ul>

        <span class="item_menu close_sidebar" @click="toggleSideBar"><i class="ml-auto" :style="!sideBarVisibility ? 'transform: rotate(90deg);' : ''"></i></span>
    </nav>
</template>

<script>
    import route from "../route";

    const axios = require('axios').default;

    export default {
        name: "Sidebar",
        data() {
            return {
                activeMenuItem: null,
                menu: null,
                sideBarVisibility: true
            };
        },
        mounted() {

            if (localStorage.getItem('menu') == null) {
                console.log(route('get-menu'));
                axios
                    .get(route('get-menu'))
                    .then(response => {
                        this.menu = response.data;
                        localStorage.setItem('menu', JSON.stringify(this.menu));
                    });
            } else {
                this.menu = JSON.parse(localStorage.getItem('menu'));
            }

            // this.menu = {
            //     'Доступы': {
            //         'url': null,
            //         'open': true,
            //         'childs': {
            //             'Хостинги': {
            //                 'url': 'http://127.0.0.1:8000/dashboard/host'
            //             },
            //             'Сайты': {
            //                 'url': 'http://127.0.0.1:8000/dashboard/site'
            //             },
            //             'Другое': {
            //                 'url': 'http://127.0.0.1:8000/dashboard/other'
            //             }
            //         }
            //     },
            //     'Отчеты': {
            //         'url': 'http://127.0.0.1:8000/dashboard/report',
            //         'childs': null
            //     }
            // };
        },
        computed: {
            // menu: function () {
            //     let menu;
            //
            //
            //     console.log(menu);
            //     return menu;
            // }
        },
        methods: {
            setActiveMenuItem(key) {
                this.activeMenuItem = key;
            },
            isChilds(data) {
                return data.childs != null ? true : false;
            },
            isActiveMenuItem(key) {
                return this.activeMenuItem === key ? true : false;
            },
            checkCurrentPage(url, childs = []) {
                if (childs != []) {
                    for (let key in childs) {
                        if (window.location.href === childs[key].url) return true;
                    }
                }

                return window.location.href === url ? true : false;
            },
            toggleMenuItem(key) {
                this.menu[key].open = !this.menu[key].open;
            },
            toggleSideBar() {
                this.sideBarVisibility = !this.sideBarVisibility;
            }
        }
    }
</script>

<style scoped>

</style>
