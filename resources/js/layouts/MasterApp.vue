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
import $ from "jquery";

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
    watch:{
        $route (to, from){
            if(to.name === 'ScriptLists'){
                $(".dashboard-left").attr("hidden",true);
                $(".dashboard-right").css('padding',0);
            } else {
                $(".dashboard-left").attr("hidden",false);
                $(".dashboard-right").css('padding','15px');
            }
        }
    },
    methods: {}
}
</script>

<style scoped>

</style>
