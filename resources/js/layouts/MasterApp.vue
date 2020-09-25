<template>
    <div>
        <MasterHeader/>
        <div class="main main-dashboard">
            <div class="container1">
                <div class="dashboard-wrp d-flex align-items-top d-flex-none-mob">
                    <div class="dashboard-left">

                            <ScriptLists/>

                    </div>
                    <div class="dashboard-right">
                        <AutoLogout></AutoLogout>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MasterHeader from "./MasterHeader.vue";
import ScriptLists from "./ScriptLists.vue";
import AutoLogout from "../components/AutoLogout";

export default {
    name: "MasterApp",
    data() {
        return {}
    },
    components: {
        MasterHeader,
        ScriptLists,
        AutoLogout
    },
    methods: {}
}
</script>

<style scoped>

</style>
