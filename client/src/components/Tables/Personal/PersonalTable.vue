<template>
  <div>
<!--    <vue-custom-scrollbar class="scroll-area table_access"  :settings="settings" @ps-scroll-y="scrollHanle">-->
      <div class="table_access">
        <table>
          <thead>
            <th>Имя пользователя</th>
            <th>Почта</th>
            <th>Привелегия</th>
            <th></th>
          </thead>
          <tbody>
            <row v-for="(row, id) in accessesDataTable" :key="id" :row="row" :id="id"></row>
            <tr>
              <loader v-if="GET_IS_LOAD_PERSONAL"></loader>
            </tr>
          </tbody>
        </table>
        <div class="table_access__empty" v-if="!GET_IS_LOAD_PERSONAL && GET_ALL_PERSONAL.length === 0">Записи в таблице отсутствуют.</div>
      </div>
<!--    </vue-custom-scrollbar>-->
  </div>
</template>

<script>
import Row from '@/components/Tables/Personal/PersonalRow'
import Loader from '@/components/Tables/Loader'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'PersonalTable',
  data: function () {
    return {
      dataTablePersonal: [], // Данные из таблицы
      activeCell: null, // DOM активного поля
      activeCellIndex: null, // Индекс активного поля
      cellHoverIndex: null, // Индекс поля, на котором указатель
      isVisibilityConfirmForm: false,
      confirmStatus: null,
      confirmID: null
      // settings: {
      //   suppressScrollY: false,
      //   suppressScrollX: false,
      //   wheelPropagation: false,
      //   swicher: true
      // }
    }
  },
  props: [
    'search'
  ],
  mounted () {
    // Получение данных для таблицы
    this.GET_ALL_PERSONAL_FROM_API()
  },
  methods: {
    ...mapActions([
      'GET_ALL_PERSONAL_FROM_API'
    ]),
    scrollHanle (evt) {
      console.log(evt)
    },
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
      'GET_ALL_PERSONAL',
      'GET_IS_LOAD_PERSONAL'
    ]),
    accessesDataTable: function () {
      const newArray = []

      const searchQ = this.search.toLowerCase()
      this.GET_ALL_PERSONAL.filter((item) => {
        const currentRow = item
        // const searchString = currentRow.name + currentRow.ftp_server + currentRow.host_login + currentRow.comment + currentRow.ftp_login

        if ((currentRow.name && currentRow.name.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.email && currentRow.email.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.privilege && currentRow.privilege.toLowerCase().indexOf(searchQ) !== -1)) {
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
