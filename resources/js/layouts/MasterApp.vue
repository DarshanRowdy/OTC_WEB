<template>
    <v-app>
        <v-content>
            <MasterHeader/>
            <div class="main main-dashboard">
                <div class="container1">
                    <div class="dashboard-wrp d-flex align-items-top d-flex-none-mob">
                        <div class="dashboard-left">
                            <ScriptLists />
                        </div>
                        <div class="dashboard-right">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </v-content>
    </v-app>
</template>

<script>
import MasterHeader from "./MasterHeader.vue";
import ScriptLists from "./ScriptLists.vue";

export default {
    name: "MasterApp",
    data() {
        return {
        }
    },
    components: {
        MasterHeader,
        ScriptLists
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
