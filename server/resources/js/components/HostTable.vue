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
                <row v-for="(row, id) in accessesDataTable" :row="row" :id="id" @update="getDataTable" @confirm="handleConfirm" :confirmStatus="confirmStatus"></row>
                </tbody>
            </table>

        </div>

        <confirm-form :isVisibility="isVisibilityConfirmForm" @close="handleCloseFormConfirmation" @confirm="handleConfirmResponse(true)" @refute="handleConfirmResponse(false)"></confirm-form>
    </div>
</template>

<script>
    import route from "@/router/route";
    import Row from "./Table/Row";
    import ConfirmForm from "./Modals/ConfirmForm";

    export default {
        name: "HostTable",
        data: function() {
            return {
                dataTableHosts: [],       // Данные из таблицы
                activeCell: null,       // DOM активного поля
                activeCellIndex: null,   // Индекс активного поля
                cellHoverIndex: null,     // Индекс поля, на котором указатель
                isVisibilityConfirmForm: false,
                confirmStatus: null,
                confirmID: null
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
            Destroy(id) {
                this.axios.delete(route('host.destroy', id))
                    .then(response => {
                        this.getDataTable();
                    })
                    .catch(error => {
                        console.log('bad');
                    });

                this.$emit('update');
            },
            handleConfirmResponse(status) {
                this.isVisibilityConfirmForm = false;
                if (status) {
                    this.Destroy(this.confirmID);
                }
                this.confirmStatus = null;
                this.confirmID = null;
            },
            handleCloseFormConfirmation() {
                this.isVisibilityConfirmForm = false;
            },
            handleConfirm(id) {
                this.confirmStatus = null;
                this.confirmID = id;
                this.isVisibilityConfirmForm = true;
            },
            getDataTable() {
                this.axios.get(route('host.index'))
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
            ConfirmForm, Row
        }
    }
</script>

<style scoped>

</style>
