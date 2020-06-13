<template>
    <tr>
        <cell v-for="(value, name) in filteredCells(row)" :value="value" :name="name"></cell>
        <td style="position:relative;" @mouseover="handelOverActionCell" @mouseleave="handelLeaveActionCell">
            <div v-if="isContextVisibility" class="context_menu" @mouseover="isContextVisibility = true" @mouseleave="isContextVisibility = false">
                <a href="#">Подробнее</a>
                <a href="#">Изменить</a>
                <a :href="route('')">Удалить</a>
            </div>
        </td>
    </tr>
</template>

<script>
    import Cell from './Cell';
    import route from "../../route";

    export default {
        name: "Row",
        data: () => ({
            isContextVisibility: false
        }),
        props: [
            'row', 'id'
        ],
        methods: {
            handelOverActionCell() {
                this.isContextVisibility = true;
            },
            handelLeaveActionCell() {
                this.isContextVisibility = false;
            },
            filteredCells(row) {
                let filtered = [];
                return {
                    name: row['title'],
                    host_login: row['host_login'],
                    host_password: row['host_password'],
                    ftp_server: row['ftp_server'],
                    ftp_login: row['ftp_login'],
                    ftp_password: row['ftp_password'],
                    comment: row['comment']
                };
            },
            setCurrentCellHover(row, column) {
                this.cellHoverIndex = [row, column];
            },
        },
        components: {
            Cell
        }
    }
</script>

<style scoped>

</style>
