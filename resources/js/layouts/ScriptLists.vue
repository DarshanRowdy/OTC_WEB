<template>
    <div>
        <div class="left-wrp">
            <div class="search-section">
                <input v-model="search" placeholder="Search" type="text">
            </div>
            <div class="circuit-list">
                <ul id="scripts-listing">
                    <li v-for="(value, index) in scripts">
                        <div class="list-name">
                            <a> {{ value.script_display_name }}</a>
                        </div>
                        <div class="list-icons">
                            <ul>
                                <li class="icon-buy">
                                    <a href="javascript:void(0)" title="Buy" @click="showOrder(value, 'BUY')">B</a>
                                </li>
                                <li class="icon-sell">
                                    <a href="javascript:void(0)" title="Sell" @click="showOrder(value, 'SELL')">S</a>
                                </li>
                                <li class="icon-market-depth icon-bg-blank">
                                    <router-link title="Market Depth" v-bind:to="`/market-depth/${value.slot_url}`"> <i
                                        class="las la-bars"></i> </router-link>
                                </li>
                                <li class="icon-more icon-bg-blank">
                                    <router-link title="Info" v-bind:to="`/info/${value.slot_url}`">
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
import $ from "jquery";

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
            isOrderConfirm: false,
            config : {}
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
            axios.get('/api/scripts', this.config).then(response => {
                this.scripts = response.data.data.scripts;
            }).catch(error => {
                if(error.response.data.responseCode === 401){
                    this.$session.set('auth_error', error.response.data.message);
                    localStorage.removeItem('userObj');
                    this.$router.push("/login").catch(()=>{});
                } else {
                    this.errors = error.response.data.message;
                }
            });
        },
        searchScript(newValue) {
            const data = {
                search: newValue,
            };
            axios.post('/api/scripts', data, this.config).then(response => {
                this.scripts = response.data.data.scripts;
            }).catch(error => {
                if(error.response.data.responseCode === 401){
                    localStorage.removeItem('userObj');
                    this.$session.set('auth_error', error.response.data.message);
                    this.$router.push("/login").catch(()=>{});
                } else {
                    this.errors = error.response.data.message;
                }
            });
        },
        handler: function handler(event) {
            this.$router.push('/desk').catch(()=>{});
        }
    },
    beforeMount() {
        this.getUnits();
    },
    watch: {
        search: {
            handler: function(newValue) {
                this.searchScript(newValue);
            },
            deep: true
        }
    },
    created() {
        let userObj = JSON.parse(localStorage.getItem('userObj'));
        this.config = {
            headers: {
                AUTH_TOKEN : userObj.auth_token
            }
        }
        if(this.$route.name === 'ScriptLists'){
            window.addEventListener('load', this.handler);
        }
    },
}
</script>

<style scoped>
@media screen and (max-width: 1020px) {
    .left-wrp {
        margin-top: 0;
    }
}
</style>
