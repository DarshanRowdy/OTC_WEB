<template>
    <h1>404 Page Not found</h1>
</template>

<script>
export default {
    name: "NotFound",
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'master-app');
    }
}
</script>

<style scoped>

</style>
