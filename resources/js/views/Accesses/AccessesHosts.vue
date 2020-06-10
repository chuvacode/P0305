<template>

    <div class="container-fluid container_access w-100">
        <div class="panel_line">
            <h3>Хостинги</h3>
            <div class="right ml-auto">
                <div class="search">
                    <input v-model="search" type="text">
                    <a href="#"></a>
                </div>
                <a id="add_new_host" class="button-1 ml-30" href="/home">Добавить</a>
            </div>
        </div>

        <host-table :search="search"></host-table>
    </div>
</template>

<script>
    import HostTable from "../../components/HostTable";

    export default {
        name: "AccessesHosts",
        data: function () {
            return {
                'search': ""
            };
        },
        components: {
            HostTable
        }
    }
</script>

<style scoped>

</style>
