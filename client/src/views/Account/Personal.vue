<template>
  <div class="container-fluid container_access w-100">
    <vue-headful
      title="Управление персоналом"
    />
    <div class="panel_line">
      <h3>Персонал</h3>
      <div class="right ml-auto">
        <search @input="str => this.search = str"></search>
        <a id="add_new_host" class="button-1 ml-30" href="/home"
           @click.prevent="isVisibilityFormAddPersonal = !isVisibilityFormAddPersonal"
        >Добавить</a>
      </div>
    </div>
    <personal-table :search="search" ref="table"></personal-table>
    <form-add-personal-modal :isVisibility="isVisibilityFormAddPersonal"
                         @close="isVisibilityFormAddPersonal = false"></form-add-personal-modal>
  </div>
</template>

<script>
import VueHeadful from 'vue-headful'
import PersonalTable from '@/components/Tables/Personal/PersonalTable'
import Search from '@/components/Search'
import FormAddPersonalModal from '@/components/Modals/FormAddPersonal'

export default {
  name: 'SiteIndex',
  data: function () {
    return {
      search: '',
      isVisibilityFormAddPersonal: false,
      host: '',
      options: ['jino', 'nic', 'reg'],
      selectLabel: ''
    }
  },
  components: {
    PersonalTable, Search, VueHeadful, FormAddPersonalModal
  },
  methods: {
  }
}
</script>

<style scoped>

</style>
