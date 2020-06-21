<template>
    <nav class="nav_sidebar" @click="checkCurrentPage" :class="{hide:!sideBarVisibility}">
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

export default {
  name: 'Sidebar',
  data () {
    return {
      activeMenuItem: null,
      menu: null,
      sideBarVisibility: localStorage.isOpenSidebar === 'open'
    }
  },
  mounted () {
  },
  created () {
    // if (localStorage.getItem('menu') == null) {
    //     this.axios
    //         .get(route('get-menu'))
    //         .then(response => {
    //             this.menu = response.data;
    //             localStorage.setItem('menu', JSON.stringify(this.menu));
    //         });
    // } else {
    //     this.menu = JSON.parse(localStorage.getItem('menu'));
    // }
    this.menu = {
      Доступы: {
        type: 'category',
        open: 'true',
        children: ['Хостинги', 'Сайты'],
        url: '#'
      },
      Хостинги: {
        type: 'child',
        url: route('dashboard.host')
      },
      Сайты: {
        type: 'child',
        url: route('dashboard.site')
      }

      // },
      // Другое: {
      //   type: 'child',
      //   url: route('dashboard.other')
      // }
      // },
      // Отчеты: {
      //   type: 'page',
      //   url: route('dashboard.report')
      // }
    }
  },
  computed: { },
  methods: {
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
    },
    toggleSidebar () {
      this.sideBarVisibility = !this.sideBarVisibility
      this.$emit('close', this.sideBarVisibility ? 280 : 80)
    }
  },
  components: {
    ItemMenu
  }
}
</script>

<style scoped>

</style>
