<template>
  <div class="container-fluid container_access w-100">
    <div class="panel_line">
      <h3>Хостинги</h3>
      <div class="right ml-auto">
        <search @input="str => this.search = str"></search>
        <a id="add_new_host" class="button-1 ml-30" href="/home"
           @click.prevent="isVisibilityFormAddHost = !isVisibilityFormAddHost"
        >Добавить</a>
      </div>
    </div>
    <host-table :search="search" ref="table"></host-table>
    <form-add-host-modal :isVisibility="isVisibilityFormAddHost"
                         @close="isVisibilityFormAddHost = false"
                         @update="handleTableUpdate"></form-add-host-modal>
  </div>
</template>

<script>
import HostTable from '@/components/HostTable'
import Search from '@/components/Search'
import FormAddHostModal from '@/components/Modals/FormAddHost'

export default {
  name: 'HostIndex',
  data: function () {
    return {
      search: '',
      isVisibilityFormAddHost: false
    }
  },
  components: {
    HostTable, Search, FormAddHostModal
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
