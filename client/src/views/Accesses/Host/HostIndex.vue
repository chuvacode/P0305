<template>
  <div class="container-fluid container_access w-100">
    <vue-headful
      title="Перечень: Хостинг"
    />
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
import VueHeadful from 'vue-headful'
import HostTable from '@/components/Tables/Host/HostTable'
import Search from '@/components/Search'
import FormAddHostModal from '@/components/Modals/FormAddHost'
import { mapActions } from 'vuex'

export default {
  name: 'HostIndex',
  data: function () {
    return {
      search: '',
      isVisibilityFormAddHost: false
    }
  },
  components: {
    HostTable, Search, FormAddHostModal, VueHeadful
  },
  methods: {
    ...mapActions(['getAllHosts']),
    handleTableUpdate () {
      this.getAllHosts()
    }
  }
}
</script>

<style scoped>

</style>
