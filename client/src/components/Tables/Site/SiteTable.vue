<template>
  <div>
    <div class="table_access">
      <table>
        <thead>
          <th>Наименование</th>
          <th>Логин</th>
          <th>Пароль</th>
          <th>FTP сервер</th>
          <th>Логин</th>
          <th>Пароль</th>
          <th>Комментарий</th>
          <th></th>
        </thead>
        <tbody>
          <row v-for="(row, id) in accessesDataTable" :key="id" :row="row" :id="id"></row>
          <tr>
            <loader v-if="GET_IS_LOAD_SITES"></loader>
          </tr>
        </tbody>
      </table>
      <div class="table_access__empty" v-if="!GET_IS_LOAD_SITES && GET_ALL_SITES.length === 0">Записи в таблице отсутствуют.</div>
    </div>
  </div>
</template>

<script>
import Loader from '@/components/Tables/Loader'
import Row from '@/components/Tables/Site/SiteRow'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'SiteTable',
  data: function () {
    return {
      dataTableSites: [], // Данные из таблицы
      activeCell: null, // DOM активного поля
      activeCellIndex: null, // Индекс активного поля
      cellHoverIndex: null, // Индекс поля, на котором указатель
      isVisibilityConfirmForm: false,
      confirmStatus: null,
      confirmID: null
    }
  },
  props: [
    'search'
  ],
  mounted () {
    // Получение данных для таблицы
    this.GET_ALL_SITES_FROM_API()
  },
  methods: {
    ...mapActions([
      'GET_ALL_SITES_FROM_API'
    ]),
    handleConfirmResponse (status) {
      this.isVisibilityConfirmForm = false
      if (status) {
        this.Destroy(this.confirmID)
      }
      this.confirmStatus = null
      this.confirmID = null
    },
    handleConfirm (id) {
      this.confirmStatus = null
      this.confirmID = id
      this.isVisibilityConfirmForm = true
    },
    isCurrentCellHover (row, column) {
      return !!(this.cellHoverIndex !== null && this.cellHoverIndex[0] === row && this.cellHoverIndex[1] === column)
    },
    isCurrentCellActive (row, column) {
      return !!(this.cellActiveIndex !== null && this.cellActiveIndex[0] === row && this.cellActiveIndex[1] === column)
    }
  },
  computed: {
    ...mapGetters([
      'GET_ALL_SITES',
      'GET_IS_LOAD_SITES'
    ]),
    accessesDataTable: function () {
      const newArray = []

      const searchQ = this.search.toLowerCase()
      this.GET_ALL_SITES.filter((item) => {
        const currentRow = item
        // const searchString = currentRow.name + currentRow.ftp_server + currentRow.host_login + currentRow.comment + currentRow.ftp_login

        if ((currentRow.title && currentRow.title.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.ftp_server && currentRow.ftp_server.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.admin_panel_login && currentRow.admin_panel_login.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.comment && currentRow.comment.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.ftp_login && currentRow.ftp_login.toLowerCase().indexOf(searchQ) !== -1)) {
          newArray.push(currentRow)
        }
      })

      return newArray
    }
  },
  components: {
    Row, Loader
  }
}
</script>

<style scoped>

</style>
