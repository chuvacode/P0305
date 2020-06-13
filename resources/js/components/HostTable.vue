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
                <row v-for="(row, id) in accessesDataTable" :row="row" :id="id"></row>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
    import route from "../route";
    import Row from "./Table/Row";

    export default {
        name: "HostTable",
        data: function() {
          return {
              dataTableHosts: [],       // Данные из таблицы
              activeCell: null,       // DOM активного поля
              activeCellIndex: null,   // Индекс активного поля
              cellHoverIndex: null     // Индекс поля, на котором указатель
          }
        },
        props: [
            'search'
        ],
        mounted() {
            // Получение данных для таблицы
            this.getDataTable();
        },
        methods: {
            getDataTable() {
                this.axios.get(route('hosts.index'))
                    .then(response => {
                        this.dataTableHosts = response.data.availables;
                    });
            },
            isCurrentCellHover(row, column) {
                return this.cellHoverIndex != null && this.cellHoverIndex[0] == row && this.cellHoverIndex[1] == column ? true : false;
            },
            isCurrentCellActive(row, column) {
                return this.cellActiveIndex != null && this.cellActiveIndex[0] == row && this.cellActiveIndex[1] == column ? true : false;
            }
        },
        computed: {

            accessesDataTable: function() {

                let newArray = [];

                const searchQ = this.search.toLowerCase();

                this.dataTableHosts.filter((item) => {

                    let currentRow = item;
                    let searchString = currentRow.name + currentRow.ftp_server + currentRow.host_login + currentRow.comment + currentRow.ftp_login;

                    if ((currentRow.title && currentRow.title.toLowerCase().indexOf(searchQ) != -1) ||
                        (currentRow.ftp_server && currentRow.ftp_server.toLowerCase().indexOf(searchQ) != -1) ||
                        (currentRow.host_login && currentRow.host_login.toLowerCase().indexOf(searchQ) != -1) ||
                        (currentRow.comment && currentRow.comment.toLowerCase().indexOf(searchQ) != -1) ||
                        (currentRow.ftp_login && currentRow.ftp_login.toLowerCase().indexOf(searchQ) != -1)) {
                        newArray.push(currentRow);
                    }
                });

                return newArray;
            }
        },
        components: {
            Row
        }
    }
</script>

<style scoped>

</style>
