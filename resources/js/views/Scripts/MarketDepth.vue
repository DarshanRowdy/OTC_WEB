<template>
    <div>
        <transition name="market-depth" v-if="is_market_depth">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-sm-11 col-11 popup-header-left text-left">
                                    <span><strong>{{ scriptValue.script_display_name }}</strong></span>
                                </div>
                                <div class="col-sm-1 col-1 popup-header-right text-left">
                                    <a href="javascript:void(0)" class="close" @click="$router.go(-1)"> x</a>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="content">
                                    <div class="depth-table">
                                        <div class="row">
                                            <table class="col-sm-6 buy table-toggle-wrp">
                                                <thead>
                                                <tr>
                                                    <th class="order-price"><span>Bid</span>
                                                    </th>
                                                    <th class="orders">LOT</th>
                                                    <th class="text-right quantity">Qty.</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="index in 10" :key="index">
                                                    <td class="rate">
                                                        {{ buyData[index - 1] ? buyData[index - 1].order_price : 0 }}
                                                    </td>
                                                    <td class="orders">
                                                        {{ buyData[index - 1] ? buyData[index - 1].lot_size : 0 }}
                                                    </td>
                                                    <td class="text-right quantity">
                                                        {{ buyData[index - 1] ? buyData[index - 1].qty : 0 }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--<tfoot>
                                                <tr>
                                                    <td>Total</td>
                                                    <td colspan="2" class="text-right">{{ buyTotal }}</td>
                                                </tr>
                                                </tfoot>-->
                                            </table>
                                            <table class="col-sm-6 sell table-toggle-wrp">
                                                <thead>
                                                <tr>
                                                    <th class="order-price">
                                                        <span>Offer</span></th>
                                                    <th class="orders">LOT</th>
                                                    <th class="text-right quantity">Qty.</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="index in 10" :key="index">
                                                    <td class="rate">
                                                        {{ sellData[index - 1] ? sellData[index - 1].order_price : 0 }}
                                                    </td>
                                                    <td class="orders">
                                                        {{ sellData[index - 1] ? sellData[index - 1].lot_size : 0 }}
                                                    </td>
                                                    <td class="text-right quantity">
                                                        {{ sellData[index - 1] ? sellData[index - 1].qty : 0 }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--<tfoot>
                                                <tr>
                                                    <td>Total</td>
                                                    <td colspan="2" class="text-right">{{ sellTotal }}</td>
                                                </tr>
                                                </tfoot>-->
                                            </table>
                                        </div>
                                        <div
                                            class="buy-sell-btn d-flex align-items-center margin-top-20 margin-bottom-20">
                                            <div class="buy-btn-wrp"><a href="javascript:void(0)" @click="showOrder('BUY')"
                                                                        class="buy-btn get-started-btn3">BUY</a></div>
                                            <div class="sell-btn-wrp"><a href="javascript:void(0)" @click="showOrder('SELL')"
                                                                         class="sell-btn get-started-btn3">SELL</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

        <Order :values="scriptValue" :orderType="orderType" v-show="isOrder" @close="closeOrder"/>
        <OrderConfirm :values="scriptValue" :dataValue="dataValue" v-show="isOrderConfirm" @close="closeOrderConfirm"/>
    </div>
</template>

<script>
import Order from "./Order.vue";
import OrderConfirm from "./OrderConfirm.vue";

export default {
    name: "MarketDepth",
    data() {
        return {
            script_id: this.$route.params.script_id,
            scriptValue: {},
            buyData: [],
            buyTotal: 0,
            sellData: [],
            sellTotal: 0,
            orderType: '',
            dataValue: {},
            is_market_depth: true,
            isOrder: false,
            isOrderConfirm: false,
            interval: 1000
        }
    },
    components: {
        Order,
        OrderConfirm
    },
    methods: {
        close() {
            this.$emit('close');
        },
        showOrder(type) {
            this.is_market_depth = false;
            this.orderType = type;
            this.isOrder = true;
        },
        closeOrder() {
            this.isOrder = false;
            this.is_market_depth = true;
        },
        showOrderConfirm(value, dataValue) {
            this.isOrder = false;
            this.isOrderConfirm = true;
            this.scriptValue = value;
            this.dataValue = dataValue;
        },
        closeOrderConfirm() {
            this.isOrderConfirm = false;
            this.is_market_depth = true;
        },
        fetchData() {
            axios.get('/api/get-market-depth', {
                params: {
                    script_id: this.script_id
                }
            }).then(response => {
                this.buyData = response.data.data.buy;
                this.buyTotal = response.data.data.buy_total;
                this.sellData = response.data.data.sell;
                this.sellTotal = response.data.data.sell_total;
                this.scriptValue = response.data.data.script;
            }).catch(error => {
                this.errors.push(error.response.data.message)
            });
        }
    },
    watch: {
        '$route'(to, from) {
            this.script_id = this.$route.params.script_id;
            this.fetchData();
        }
    },
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'master-app');
    },
    mounted() {
        this.fetchData();
    },
    created() {
        this.interval = setInterval(() => this.fetchData(), 3 * 1000);
    },
    beforeDestroy : function(){
        clearInterval(this.interval)
    },
}
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

@media screen and (max-width: 1020px) {
    .modal-content{
        max-height: 550px;
        overflow-y: auto;
    }
    .get-started-btn3 {
        margin-left: 6px;
        margin-right: 6px;
    }
}
</style>
