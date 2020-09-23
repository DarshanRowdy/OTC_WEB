<template>
    <div>
        <MasterHeader/>
        <div class="main main-dashboard">
            <div class="container1">
                <div class="dashboard-wrp d-flex align-items-top d-flex-none-mob">
                    <div class="dashboard-left">
                        <div class="left-wrp">
                            <ScriptLists/>
                        </div>
                    </div>
                    <div class="dashboard-right">
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

export default {
    name: "MasterApp",
    data() {
        return {}
    },
    components: {
        MasterHeader,
        ScriptLists
    },
    methods: {}
}
</script>

<style scoped>

</style>
