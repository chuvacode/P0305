<template>
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
                <tr v-for="(row, indexRow) in accessesDataTable">
                    <td v-for="(cell, indexCell) in row"
                        @mouseover="setCurrentCellHover(indexRow, indexCell)"
                        @mouseleave="cellHoverIndex = null"
                        @click="actionCopy($event, cell, indexRow, indexCell)"
                        ref="cells[indexRow, indexCell]"
                    ><div class="content_cell">
                        <span style="margin-right: 40px;">{{ indexCell.indexOf('password') > -1 ? '●'.repeat(cell.length) : cell }}</span>
                        <div class="actions_cell">
                            <transition name="icon-copy">
                                <i v-if="isCurrentCellHover(indexRow, indexCell)" class="action_cell action_cell-copy" :class="{active: isCurrentCellActive(indexRow, indexCell)}">
                                    <svg class="icon-copy" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8297 6.25H8.07968C7.25125 6.25 6.57968 6.92157 6.57968 7.75V14.5C6.57968 15.3284 7.25125 16 8.07968 16H14.8297C15.6581 16 16.3297 15.3284 16.3297 14.5V7.75C16.3297 6.92157 15.6581 6.25 14.8297 6.25Z" stroke="#A8A8A8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.57968 10.75H2.82968C2.43186 10.75 2.05033 10.592 1.76902 10.3107C1.48772 10.0294 1.32968 9.64782 1.32968 9.25V2.5C1.32968 2.10218 1.48772 1.72064 1.76902 1.43934C2.05033 1.15804 2.43186 1 2.82968 1H9.57968C9.97751 1 10.359 1.15804 10.6403 1.43934C10.9216 1.72064 11.0797 2.10218 11.0797 2.5V3.25" stroke="#A8A8A8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </i>
                            </transition>
                        </div>
                        </div>
                    </td>
                    <td @mouseover="setCurrentCellHover(indexRow, indexCell)" @mouseleave="cellHoverIndex = null" ></td>
                </tr>
<!--            <tr v-for="(itemAccess, index) in accessesDataTable">-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['name'], index)" ref="cells[index]">-->
<!--                    <div class="content_cell">-->
<!--                        {{ itemAccess['name'] }}-->
<!--                        <div class="actions_cell">-->
<!--                            <i v-if="activeCellIndex === index" class="action_cell action_cell-copy" :class="{active: activeCellIndex === index}">-->
<!--                                <svg class="icon-copy" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                    <path d="M14.8297 6.25H8.07968C7.25125 6.25 6.57968 6.92157 6.57968 7.75V14.5C6.57968 15.3284 7.25125 16 8.07968 16H14.8297C15.6581 16 16.3297 15.3284 16.3297 14.5V7.75C16.3297 6.92157 15.6581 6.25 14.8297 6.25Z" stroke="#A8A8A8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                    <path d="M3.57968 10.75H2.82968C2.43186 10.75 2.05033 10.592 1.76902 10.3107C1.48772 10.0294 1.32968 9.64782 1.32968 9.25V2.5C1.32968 2.10218 1.48772 1.72064 1.76902 1.43934C2.05033 1.15804 2.43186 1 2.82968 1H9.57968C9.97751 1 10.359 1.15804 10.6403 1.43934C10.9216 1.72064 11.0797 2.10218 11.0797 2.5V3.25" stroke="#A8A8A8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['host_login'])">{{ itemAccess['host_login'] }}</td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['host_password'])">{{ itemAccess['host_password'] }}</td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['ftp_server'])">{{ itemAccess['ftp_server'] }}</td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['ftp_login'])">{{ itemAccess['ftp_login'] }}</td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['ftp_password'])">{{ itemAccess['ftp_password'] }}</td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" @click="actionCopy($event, itemAccess['comment'])">{{ itemAccess['comment'] }}</td>-->
<!--                <td @mouseover="cellHoverIndex = index" @mouseleave="cellHoverIndex = null" ></td>-->
<!--            </tr>-->
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "HostTable",
        data: function() {
          return {
              activeCell: null,       // DOM активного поля
              activeCellIndex: null,   // Индекс активного поля
              cellHoverIndex: null     // Индекс поля, на котором указатель
          }
        },
        props: [
            'accesses',
            'search'
        ],
        mounted() {
            //this.table
            // document.querySelector('.dd').addEventListener("click", function (e) {
            //     e.stopPropagation();
            //     console.log(e.target);
            //     console.log(this);
            // });
        },
        methods: {
            setCurrentCellHover(row, column) {
                this.cellHoverIndex = [row, column];
            },
            isCurrentCellHover(row, column) {
                return this.cellHoverIndex != null && this.cellHoverIndex[0] == row && this.cellHoverIndex[1] == column ? true : false;
            },
            isCurrentCellActive(row, column) {
                return this.cellActiveIndex != null && this.cellActiveIndex[0] == row && this.cellActiveIndex[1] == column ? true : false;
            },
            actionCopy(e, data, row, column) {


                this.activeCell = e.currentTarget;
                this.cellActiveIndex = [row, column];

                navigator.clipboard.writeText(data)
                    .then(() => {
                        // Получилось!
                    })
                    .catch(err => {
                        console.log('Something went wrong', err);
                    });
            },
        },
        computed: {
            accessesDataTable: function() {

                let data = this.accesses;
                let newArray = [];
                const searchQ = this.search.toLowerCase();

                data.filter((item) => {
                    let currentRow = item;
                    let searchString = currentRow.name + currentRow.ftp_server + currentRow.host_login + currentRow.comment + currentRow.ftp_login;

                    if (currentRow.name.toLowerCase().indexOf(searchQ) != -1 ||
                        currentRow.ftp_server.toLowerCase().indexOf(searchQ) != -1 ||
                        currentRow.host_login.toLowerCase().indexOf(searchQ) != -1 ||
                        currentRow.comment.toLowerCase().indexOf(searchQ) != -1 ||
                        currentRow.ftp_login.toLowerCase().indexOf(searchQ) != -1) {
                        newArray.push(currentRow);
                    }
                });

                return newArray;
            }
        }
    }
</script>

<style scoped>

</style>
