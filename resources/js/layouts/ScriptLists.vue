<template>
    <div>
        <div class="left-wrp">
            <div class="search-section">
                <form action="">
                    <input v-model="search" placeholder="Search" v-on:keyup="searchScript" type="text">
                </form>
            </div>
            <div class="circuit-list">
                <ul id="scripts-listing">
                    <li v-for="value in scripts">
                        <div class="list-name">
                            <a> {{ value.script_display_name }}</a>
                        </div>
                        <div class="list-icons">
                            <ul>
                                <li class="icon-buy">
                                    <a data-toggle="popover" href="javascript:void(0)" @click="showOrder(value, 'Buy')">B</a>
                                </li>
                                <li class="icon-sell">
                                    <a data-toggle="popover" href="javascript:void(0)" @click="showOrder(value, 'Sell')">S</a>
                                </li>
                                <li class="icon-market-depth icon-bg-blank" data-content="Market Depth"
                                    data-toggle="popover">
                                    <router-link v-bind:to="`/market-depth/${value.script_id}`"> <i
                                        class="las la-bars"></i> </router-link></li>
                                <li class="icon-more icon-bg-blank">
                                    <router-link v-bind:to="`/info/${value.script_id}`">
                                        <i class="las la-ellipsis-v"></i>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <Order :values="scriptValue" :orderType="orderType" v-show="isOrder" @close="closeOrder"/>

        <OrderConfirm :values="scriptValue" :dataValue="dataValue" v-show="isOrderConfirm" @close="closeOrderConfirm"/>
    </div>
</template>

<script>
import Order from "../views/Scripts/Order.vue";
import OrderConfirm from "../views/Scripts/OrderConfirm.vue";

export default {
    name: "ScriptLists",
    data() {
        return {
            scripts: [],
            search: '',
            errors: [],
            scriptValue: {},
            orderType: '',
            dataValue: {},
            isOrder: false,
            isOrderConfirm: false
        }
    },
    components: {
        Order,
        OrderConfirm
    },
    methods: {
        showOrder(value, type) {
            this.scriptValue = value;
            this.orderType = type;
            this.isOrder = true;
        },
        closeOrder() {
            this.isOrder = false;
        },
        closeOrderConfirm() {
            this.isOrderConfirm = false;
        },
        showOrderConfirm(value, dataValue) {
            this.isOrder = false;
            this.isOrderConfirm = true;
            this.scriptValue = value;
            this.dataValue = dataValue;
        },
        getUnits() {
            axios.get('/api/scripts').then(response => {
                this.scripts = response.data.data.scripts;
            }).catch(error => {
                this.errors.push(error.response.data.message)
            });
        },
        searchScript(event) {
            const data = {
                search: this.search,
            };
            axios.post('/api/scripts', data).then(response => {
                this.scripts = response.data.data.scripts;
            }).catch(error => {
                this.errors.push(error.response.data.message)
            });
        }
    },
    beforeMount() {
        this.getUnits();
    }
}
</script>

<style scoped>
@media screen and (max-width: 1020px) {
    .left-wrp {
        margin-top: 0;
    }
}
</style>
