<template>
    <div>
        <header>
            <div class="container-fluid d-flex align-items-center px-5">
                <span class="item_menu close_sidebar" :class="{hide: isOpenSidebar}" @click="handleToggleSidebar"><span></span></span>
                <div class="cabinet d-flex align-items-center">
                    <div class="avatar" style="background-image: url('/fortest/avatar.png');"></div>

                    <span class="user_name">Чуваков Алексей</span>
                </div>
            </div>
        </header>

        <main class="d-flex">
            <sidebar ref="sidebar"></sidebar>
            <router-view ref="main" />
        </main>

        <footer>

        </footer>
    </div>
</template>

<script>
    import Sidebar from "../components/Sidebar";

    export default {
        name: "Dashboard",
        data: () => ({
            isOpenSidebar: true
        }),
        methods: {
            handleToggleSidebar() {
                this.isOpenSidebar = !this.isOpenSidebar;
                // this.$refs.main.$el.style.maxWidth = (window.innerWidth - width) + 'px';
                this.$refs.sidebar.toggleSidebar();
            }
        },
        mounted() {
        },
        components: {
            Sidebar
        }
    }
</script>

<style scoped>

</style>
