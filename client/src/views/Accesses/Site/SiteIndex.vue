<template>
  <div class="container-fluid container_access w-100">
    <div class="panel_line">
      <h3>Сайты</h3>
      <div class="right ml-auto">
        <search @input="str => this.search = str"></search>
        <a id="add_new_host" class="button-1 ml-30" href="/home"
           @click.prevent="isVisibilityFormAddSite = !isVisibilityFormAddSite"
        >Добавить</a>
      </div>
    </div>
    <site-table :search="search" ref="table"></site-table>
    <form-add-site-modal :isVisibility="isVisibilityFormAddSite"
                         @close="isVisibilityFormAddSite = false"
                         @update="handleTableUpdate"></form-add-site-modal>
  </div>
</template>

<script>
import SiteTable from '@/components/SiteTable'
import Search from '@/components/Search'
import FormAddSiteModal from '@/components/Modals/FormAddSite'

export default {
  name: 'SiteIndex',
  data: function () {
    return {
      search: '',
      isVisibilityFormAddSite: false
    }
  },
  components: {
    SiteTable, Search, FormAddSiteModal
  },
  methods: {
    handleTableUpdate () {
      this.$refs.table.getDataTable()
    }
  }
}
</script>

<style scoped>

</style>
