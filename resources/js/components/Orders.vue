<template>
    <div>
        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </div>
        <div class="open-order-section margin-bottom-50">
            <div class="section-header">
                <h2>Orders</h2>
                <p>All Matched &amp; Open orders</p>
            </div>
            <vue-bootstrap4-table :rows="rows"
                                  :columns="columns"
                                  :classes="classes"
                                  :config="config"
                                  @on-change-query="onChangeQuery"
                                  :totalRows="total_rows"
            >
                <template slot="sort-asc-icon">
                    <i class="fa fa-sort-asc"></i>
                </template>
                <template slot="sort-desc-icon">
                    <i class="fa fa-sort-desc"></i>
                </template>
                <template slot="no-sort-icon">
                    <i class="fa fa-sort"></i>
                </template>
                <template slot="action" slot-scope="props">
                    <span><a href="javascript:void(0)" @click="editOrder(props.cell_value)"><i
                        class="las la-edit la-2x"></i></a></span>
                </template>
            </vue-bootstrap4-table>
        </div>

        <div class="completed-order-section">
            <div class="section-header">
                <h2>Past Orders</h2>
                <p>All Completed &amp; Cancelled orders (Last 1 month)</p>
            </div>

            <vue-bootstrap4-table :rows="rowsPast"
                                  :columns="columnsPast"
                                  :classes="classes"
                                  :config="config"
                                  @on-change-query="onChangeQuery"
                                  :totalRows="total_rows"
            >
                <template slot="sort-asc-icon">
                    <i class="fa fa-sort-asc"></i>
                </template>
                <template slot="sort-desc-icon">
                    <i class="fa fa-sort-desc"></i>
                </template>
                <template slot="no-sort-icon">
                    <i class="fa fa-sort"></i>
                </template>

            </vue-bootstrap4-table>
        </div>

        <Order :values="scriptValue" :orderData="EditOrder" :orderType="orderType" v-show="isOrder" @close="closeOrder"/>
        <OrderConfirm :values="scriptValue" :dataValue="dataValue" v-show="isOrderConfirm" @close="closeOrderConfirm"/>
        <OrderCancel :values="scriptValue" :dataValue="dataValue" v-show="isOrderCancel" @close="closeOrderConfirm"/>
    </div>
</template>

<script>
import VueBootstrap4Table from 'vue-bootstrap4-table'
import Order from "../views/Scripts/Order";
import OrderConfirm from "../views/Scripts/OrderConfirm";
import OrderCancel from "../views/Scripts/OrderCancel";
import $ from "jquery";
export default {
    name: "Orders",
    data() {
        return {
            errors: [],
            rows: [],
            columns: [
                {
                    label: "Modify",
                    name: "order_id",
                    slot_name: "action"
                },
                {
                    label: "Symbol",
                    name: "script_display_name",
                    sort: true,
                },
                {
                    label: "Type",
                    name: "order_type",
                    sort: true,
                },
                {
                    label: "Price",
                    name: "order_price",
                    sort: true,
                },
                {
                    label: "Qty (Matched/Total)",
                    name: "qty",
                    sort: true,
                },
                {
                    label: "Lot",
                    name: "lot_size",
                    sort: true,
                },
                {
                    label: "Avg Price",
                    name: "average_price",
                    sort: true,
                },
                {
                    label: "Delivered Qty",
                    name: "delivered_qty",
                    sort: true,
                },
                {
                    label: "Order No",
                    name: "order_num",
                    sort: true,
                },
                {
                    label: "Time",
                    name: "time",
                    sort: true,
                }
            ],
            rowsPast: [],
            columnsPast: [
                {
                    label: "Symbol",
                    name: "script_display_name",
                    sort: true,
                },
                {
                    label: "Type",
                    name: "order_type",
                    sort: true,
                },
                {
                    label: "Avg Price",
                    name: "average_price",
                    sort: true,
                },
                {
                    label: "Delivered Qty",
                    name: "delivered_qty",
                    sort: true,
                },
                {
                    label: "Order No",
                    name: "order_num",
                    sort: true,
                },
                {
                    label: "Time",
                    name: "time",
                    sort: true,
                }],
            classes: {
                table : {
                    "order-custom-table" : true,
                },
                cell : {}
            },
            config: {
                card_mode: false,
                pagination: true, // default true
                pagination_info: false, // default true
                per_page: 5, // default 10,
                selected_rows_info: false,
                // multi_column_sort: true,
                global_search: {
                    placeholder: "Search",
                    visibility: true,
                    case_sensitive: false,
                    showClearButton: true,
                },
                server_mode: false,
                show_refresh_button: false,
                show_reset_button: false
            },
            queryParams: {
                sort: [],
                filters: [],
                global_search: "",
                per_page: 5,
                page: 1,
            },
            total_rows: 0,
            isOrder: false,
            isOrderConfirm: false,
            isOrderCancel: false,
            scriptValue: {},
            orderType: '',
            dataValue: {},
            EditOrder: {},
        }
    },
    methods: {
        onChangeQuery(queryParams) {
            // this.queryParams = queryParams;
            // this.fetchData();
        },
        fetchOpenData() {
            let self = this;
            let userObj = JSON.parse(localStorage.getItem('userObj'));
            const data = {
                // queryParams: this.queryParams,
                // page: this.queryParams.page
                cust_id: userObj.user_id
            };
            axios.post('/api/order-list', data).then(response => {
                self.rows = response.data.data.orders;
                window.scrollTo(0,0);
                // self.total_rows = response.data.data.orders.total;
            })
            .catch(error => {
                this.errors.push(error.response.data.message)
            });
        },
        fetchPastData() {
            let self = this;
            let userObj = JSON.parse(localStorage.getItem('userObj'));
            const data = {
                // queryParams: this.queryParams,
                // page: this.queryParams.page
                cust_id: userObj.user_id
            };
            axios.post('/api/order-list-past', data).then(response => {
                self.rowsPast = response.data.data.orders;
                // self.total_rows = response.data.data.orders.total;
            })
                .catch(error => {
                    this.errors.push(error.response.data.message)
                });
        },
        editOrder(order_id, page = null) {
            this.isOrderCancel = false;
            if(page === 'order_reload'){
                this.fetchOpenData();
                this.fetchPastData();
            } else {
                axios.get('/api/order-show/'+order_id).then(response => {
                    this.EditOrder = response.data.data.order;
                    this.scriptValue = this.EditOrder.script;
                    this.showOrder(this.EditOrder.order_type);
                })
                .catch(error => {
                    this.errors.push(error.response.data.message)
                });
            }
        },
        showOrder(type) {
            this.orderType = type;
            this.isOrder = true;
        },
        showOrderCancel(value, dataValue){
            this.isOrder = false;
            this.isOrderCancel = true;
            this.scriptValue = value;
            this.dataValue = dataValue;
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
        close() {
            this.$emit('close');
        }
    },
    components: {
        VueBootstrap4Table,
        Order,
        OrderConfirm,
        OrderCancel
    },
    mounted() {
    },
    watch: {
        rows: {
            handler: function(newValue) {
                $(".vbt-per-page-dropdown").removeClass("show");
                $(".vbt-per-page-dropdown").attr("hidden",true);
                $(".col-sm-2").attr("hidden",true);
            },
            deep: true
        }
    },
    beforeMount() {
        this.fetchOpenData();
        this.fetchPastData();
        this.$store.commit('SET_LAYOUT', 'master-app');
    },
}
</script>

<style scoped>

</style>
