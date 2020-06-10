<template>

    <div class="container-fluid container_access w-100">
        <div class="panel_line">
            <h3>Сайты</h3>
            <div class="right ml-auto">
                <div class="search">
                    <input v-model="search" type="text">
                    <a href="#"></a>
                </div>
                <a id="add_new_host" class="button-1 ml-30" href="/home">Добавить</a>
            </div>
        </div>

        <accesses-host :search="search"></accesses-host>
    </div>
</template>

<script>
    export default {
        name: "AccesseSites",
        data: function () {
            return {
                'search': ""
            };
        },
        components: {}
    }
</script>

<style scoped>

</style>
