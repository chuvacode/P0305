<template>
    <component :is="layout"></component>
</template>

<script>
    import DashboardLayout from "../layouts/DashboardLayout";
    import EmptyLayout from "../layouts/EmptyLayout";

    // var DashboardLayout = require('../layouts/DashboardLayout').default;
    // var EmptyLayout = require('../layouts/EmptyLayout').default;

    export default {
        computed: {
            layout() {
                return (this.$route.meta.layout || 'empty') + '-layout';
            }
        },
        components: {
            DashboardLayout, EmptyLayout
        }
    }
</script>

<style scoped>

</style>
