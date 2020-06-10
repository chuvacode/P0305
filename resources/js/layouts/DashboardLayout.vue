<template>
    <div>
        <header>
            <div class="container-fluid d-flex align-items-center px-5">
                <div class="cabinet d-flex align-items-center">
                    <div class="avatar" style="background-image: url('/fortest/avatar.png');"></div>

                    <span class="user_name">Чуваков Алексей</span>
                </div>
            </div>
        </header>

        <main class="d-flex">
            <sidebar></sidebar>
            <router-view />
        </main>

        <footer>

        </footer>
    </div>
</template>

<script>
    import Sidebar from "../components/Sidebar";

    export default {
        name: "Dashboard",
        components: {
            Sidebar
        }
    }
</script>

<style scoped>

</style>
