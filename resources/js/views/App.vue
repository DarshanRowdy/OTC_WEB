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
    },
    methods: {
    },
    mounted() {
        window.onbeforeunload = function (e) {
            window.localStorage.unloadTime = JSON.stringify(new Date());
        };

        window.onload = function () {
            let loadTime = new Date();
            let unloadTime = new Date(JSON.parse(window.localStorage.unloadTime));
            let refreshTime = loadTime.getTime() - unloadTime.getTime();

            if(refreshTime>3000)//3000 milliseconds
            {
                var storage = window.localStorage;
                storage.clear()
            }
        };
    }
}
</script>

<style scoped>

</style>
