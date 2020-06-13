<template>
    <router-link tag="li" :to="body.url">
        <template v-if="body['type'] === 'category'">
            <span class="item_menu"><a href="#">{{ title }}</a></span>
            <ul v-if="isOpen">
                <item-menu v-for="(child_body, child_title) in getChildren(body.children)"  :title="child_title" :body="child_body" :menu="menu"></item-menu>
            </ul>
        </template>
        <template v-else>
            <span class="item_menu"><a :href="body.url">{{ title }}</a></span>
        </template>
    </router-link>



<!--    <li>-->
<!--        <template v-if="body['type'] === 'category'">-->
<!--            <span class="item_menu"><a href="#">{{ title }}</a></span>-->
<!--            <ul v-if="isOpen">-->
<!--                <item-menu v-for="(child_body, child_title) in getChildren(body.children)"  :title="child_title" :body="child_body" :menu="menu"></item-menu>-->
<!--            </ul>-->
<!--        </template>-->
<!--        <template v-else>-->
<!--            <span class="item_menu"><a :href="body.url">{{ title }}</a></span>-->
<!--        </template>-->
<!--    </li>-->




<!--    <li :class="{item_menu_dropdown:isChilds(item),-->
<!--                         active:checkCurrentPage(item.url, item.childs),-->
<!--                         'item-open':isChilds(item) && item.open,-->
<!--                         'item-close':isChilds(item) && !item.open}"-->
<!--    >-->
<!--        &lt;!&ndash;Если с дочерними элементами&ndash;&gt;-->
<!--        <template v-if="isChilds(item)">-->
<!--            <span class="item_menu" @click="toggleMenuItem(key)"><span>{{ key }}</span><i v-if="isChilds(item)" class="ml-auto icon_dropdown"></i></span>-->
<!--            <ul v-if="item.open">-->
<!--                <li v-for="(itemChild, keyChild) in item.childs" :class="{active:checkCurrentPage(itemChild.url)}">-->
<!--                    <span class="item_menu"><span><a :href="itemChild.url">{{ keyChild }}</a></span></span>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </template>-->

<!--        &lt;!&ndash;Одиночный элемент&ndash;&gt;-->
<!--        <template v-else="">-->
<!--            <span class="item_menu"><a :href="item.url">{{ key }}</a></span>-->
<!--        </template>-->
<!--    </li>-->
</template>

<script>
    import ItemMenu from './ItemMenu';

    export default {
        name: "ItemMenu",
        data: () => ({
            isOpen: true
        }),
        props: [
            'title', 'body', 'menu'
        ],
        methods: {
            getChildren(list) {
                let children = {};
                list.map(key => children[key] = this.menu[key]);
                return children;
            },
        },
        components: {
            ItemMenu
        }
    }
</script>

<style scoped>

</style>
