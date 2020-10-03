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
            </vue-bootstrap4-table>
        </div>
    </div>
</template>

<script>
import VueBootstrap4Table from 'vue-bootstrap4-table'

export default {
    name: "Orders",
    data() {
        return {
            errors: [],
            rows: [],
            columns: [
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
                    name: "order_qty_original",
                    sort: true,
                },
                {
                    label: "Lot",
                    name: "lot_size",
                    sort: true,
                },
                {
                    label: "Avg Price",
                    name: "order_price",
                    sort: true,
                },
                {
                    label: "Delivered Qty",
                    name: "order_qty_original",
                    sort: true,
                },
                {
                    label: "Order No",
                    name: "order_num",
                    sort: true,
                },
                {
                    label: "Time",
                    name: "created_at",
                    sort: true,
                }],
            classes: {
            },
            config: {
                card_mode: false,
                pagination: true, // default true
                pagination_info: false, // default true
                per_page: 5, // default 10,
                selected_rows_info: true,
                // multi_column_sort: true,
                global_search: {
                    placeholder: "Search",
                    visibility: true,
                    case_sensitive: false,
                    showClearButton: true,
                },
                server_mode: true,
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
        }
    },
    methods: {
        onChangeQuery(queryParams) {
            this.queryParams = queryParams;
            this.fetchData();
        },
        fetchData() {
            let self = this;
            const data = {
                queryParams: this.queryParams,
                page: this.queryParams.page
            };
            axios.post('/api/order-list', data).then(response => {
                    self.rows = response.data.data.orders.data;
                    self.total_rows = response.data.data.orders.total;
                })
                .catch(error => {
                    this.errors.push(error.response.data.message)
                });
        }
    },
    components: {
        VueBootstrap4Table
    },
    mounted() {
    },
    beforeMount() {
        this.fetchData();
        this.$store.commit('SET_LAYOUT', 'master-app');
    }
}
</script>

<style scoped>

</style>
