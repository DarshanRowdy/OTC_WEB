<template>
    <component v-bind:is="layout"></component>
</template>

<script>

import MasterApp from "../layouts/MasterApp";
import SimpleLayout from "../layouts/SimpleLayout";

export default {
    name: "App",
    computed: {
        layout () {
            return this.$store.getters.layout
        }
    },
    components: {
        'master-app': MasterApp,
        'simple-layout': SimpleLayout
    }
}
</script>

<style scoped>

</style>
