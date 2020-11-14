<template>
  <div class="container-fluid container_access w-100">
    <vue-headful
      title="Перечень: Другое"
    />
    <div class="panel_line">
      <h3>Другое</h3>
      <div class="right ml-auto">
        <search @input="str => this.search = str"></search>
        <a id="add_new_other" class="button-1 ml-30" href="/home"
           @click.prevent="isVisibilityFormAddOther = !isVisibilityFormAddOther"
        >Добавить</a>
      </div>
    </div>
    <other-table :search="search" ref="table"></other-table>
    <form-add-other-modal :isVisibility="isVisibilityFormAddOther"
                         @close="isVisibilityFormAddOther = false"
                         @update="handleTableUpdate"></form-add-other-modal>
  </div>
</template>

<script>
import VueHeadful from 'vue-headful'
import OtherTable from '@/components/Tables/Other/OtherTable'
import Search from '@/components/Search'
import FormAddOtherModal from '@/components/Modals/FormAddOther'
import { mapActions } from 'vuex'

export default {
  name: 'OtherIndex',
  data: function () {
    return {
      search: '',
      isVisibilityFormAddOther: false
    }
  },
  components: {
    OtherTable, Search, FormAddOtherModal, VueHeadful
  },
  methods: {
    ...mapActions(['getAllOthers']),
    handleTableUpdate () {
      this.getAllOthers()
    }
  }
}
</script>

<style scoped>

</style>
