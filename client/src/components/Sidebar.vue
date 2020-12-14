<template>
    <nav class="nav_sidebar" @click="checkCurrentPage" :class="{hide:!GET_SIDEBAR_IS_VISIBILITY}">
        <div class="nav_sidebar_menu">
            <ul>
                  <item-menu v-for="(body, title) in getMenuItems()" :key="title" :title="title" :body="body" :menu="menu"></item-menu>
            </ul>
        </div>
    </nav>
</template>

<script>
import route from '@/router/route'
import ItemMenu from './ItemMenu'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Sidebar',
  data () {
    return {
      activeMenuItem: null,
      menu: null
    }
  },
  mounted () {
  },
  created () {
    this.menu = {
      Доступы: {
        type: 'category',
        open: 'true',
        children: ['Хостинги', 'Сайты', 'Другое'],
        url: '#'
      },
      Хостинги: {
        type: 'child',
        url: route('dashboard.host')
      },
      Сайты: {
        type: 'child',
        url: route('dashboard.site')
      },
      Другое: {
        type: 'child',
        url: route('dashboard.other')
      },
      'Управление персоналом': {
        type: 'page',
        url: route('dashboard.personal')
      }
      // Отчеты: {
      //   type: 'page',
      //   url: route('dashboard.report')
      // }
    }
  },
  computed: {
    ...mapGetters([
      'GET_SIDEBAR_IS_VISIBILITY'
    ])
  },
  methods: {
    ...mapActions([
      'TOGGLE_SIDEBAR'
    ]),
    getMenuItems () {
      const items = {}
      for (const title in this.menu) {
        if (this.menu[title].type !== 'child') {
          items[title] = this.menu[title]
        }
      }
      return items
    },
    setActiveMenuItem (key) {
      this.activeMenuItem = key
    },
    isChilds (data) {
      return data.childs != null
    },
    isActiveMenuItem (key) {
      return this.activeMenuItem === key
    },
    checkCurrentPage (url, childs = []) {
      if (childs !== []) {
        for (const key in childs) {
          if (window.location.href === childs[key].url) return true
        }
      }
      return window.location.href === url
    },
    toggleMenuItem (key) {
      this.menu[key].open = !this.menu[key].open
    }
  },
  components: {
    ItemMenu
  }
}
</script>

<style scoped>

</style>
