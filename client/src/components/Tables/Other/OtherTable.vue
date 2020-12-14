<template>
  <div>
    <div class="table_access">
      <table>
        <thead>
          <th>Наименование</th>
          <th>E-mail</th>
          <th>Логин</th>
          <th>Пароль</th>
          <th>Телефон</th>
          <th>Комментарий</th>
          <th></th>
        </thead>
        <tbody>
          <row v-for="(row, id) in accessesDataTable" :key="id" :row="row" :id="id"></row>
          <tr>
            <loader v-if="GET_IS_LOAD_OTHERS"></loader>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Loader from '@/components/Tables/Loader'
import Row from '@/components/Tables/Other/OtherRow'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'OtherTable',
  data: function () {
    return {
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
  async mounted () {
    // Получение данных для таблицы
    this.GET_ALL_OTHERS_FROM_API()
  },
  methods: {
    ...mapActions(['GET_ALL_OTHERS_FROM_API']),
    handleConfirmResponse (status) {
      this.isVisibilityConfirmForm = false
      if (status) {
        this.destroyOther({
          component: this,
          id: this.confirmID
        })
      }
      this.confirmStatus = null
      this.confirmID = null
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
      'GET_ALL_OTHERS',
      'GET_IS_LOAD_OTHERS'
    ]),
    accessesDataTable: function () {
      const newArray = []

      const searchQ = this.search.toLowerCase()
      this.GET_ALL_OTHERS.filter((item) => {
        const currentRow = item

        if ((currentRow.title && currentRow.title.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.email && currentRow.email.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.login && currentRow.login.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.comment && currentRow.comment.toLowerCase().indexOf(searchQ) !== -1) ||
            (currentRow.phone && currentRow.phone.toLowerCase().indexOf(searchQ) !== -1)) {
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
