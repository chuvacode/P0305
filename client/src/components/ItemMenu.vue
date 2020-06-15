<template>
    <router-link tag="li" :to="getUrl()" :class="{ category: this.body.type === 'category'}">
        <template v-if="body['type'] === 'category'">
            <span class="item_menu" @click="isOpen = !isOpen">{{ title }}
              <div class="arrow-4" :class="{open: isOpen}">
                <span class="arrow-4-left"></span>
                <span class="arrow-4-right"></span>
              </div>
            </span>
            <ul v-if="isOpen">
                <item-menu v-for="(child_body, child_title) in getChildren(body.children)" :key="child_title" :title="child_title" :body="child_body" :menu="menu"></item-menu>
            </ul>
        </template>
        <template v-else-if="body['type'] === 'page'">
            <a class="item_menu"><a :href="body.url">{{ title }}</a></a>
        </template>
      <template v-else-if="body['type'] === 'child'">
        <a class="item_menu"><span :href="body.url">{{ title }}</span></a>
      </template>
    </router-link>
</template>

<script>
import ItemMenu from './ItemMenu'

export default {
  name: 'ItemMenu',
  data: () => ({
    isOpen: true
  }),
  props: [
    'title', 'body', 'menu'
  ],
  methods: {
    getUrl () {
      if (this.body.type === 'category') {
        return this.$route
      }
      return this.body.url
    },
    getChildren (list) {
      const children = {}
      // eslint-disable-next-line no-return-assign
      list.map(key => children[key] = this.menu[key])
      return children
    }
  },
  components: {
    ItemMenu
  }
}
</script>

<style scoped>

</style>
