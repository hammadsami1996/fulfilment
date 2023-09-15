<template>
    <div class="flex flex-col">
        <main-layout/>
    </div>
</template>

<script>
    import MainLayout from "./Layouts/Mainlayout.vue";

    export default {
        name: "app",
        components: {
            MainLayout,
        }
    }
</script>

<style scoped>
    /* Your app component styles here */
</style>
