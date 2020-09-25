<template>
    <div>
        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </div>

        <section id="info">
            <h1><b>{{ scriptDetail.script_name }}</b></h1>
            <div class="row">
                <div class="col-lg-6">
                    <P>{{ scriptDetail.script_sector }}</p>
                </div>
                <div class="col-lg-6"><p>{{scriptDetail.script_isin_number}}</p></div>
            </div>
            <p>{{scriptDetail.script_description}}</p>
            <div class="buysell">
                <div class="row">
                    <div class="buy-btn-wrp">
                        <a class="buy-btn get-started-btn3" @click="showOrder(scriptDetail, 'Buy')">BUY</a>
                    </div>
                    <div class="sell-btn-wrp">
                        <a class="sell-btn get-started-btn3" @click="showOrder(scriptDetail, 'Sell')">SELL</a>
                    </div>
                    <!--
                                             <div class="mkt-btn-wrp"><a href="#market-depth" class="cancel-btn get-started-btn3">Market Depth</a></div>
                    -->
                    <div class="sell-btn-wrp"><a class="mkt-btn get-started-btn3" href="#market-depth">Market
                        Depth</a></div>
                </div>
            </div>
            <Order :values="scriptValue" :orderType="orderType" v-show="isOrder" @close="closeOrder"/>
            <OrderConfirm :values="scriptValue" :dataValue="dataValue" v-show="isOrderConfirm" @close="closeOrderConfirm"/>

        </section>

        <section id="fact">

            <hr>
            <div class="row counters">
                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">2,74,054</span>
                    <p>Market Cap(₹ Cr.)</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">421</span>
                    <p>P/E</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">10.6</span>
                    <p>P/B</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">15000</span>
                    <p>EPS</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">2,74,054</span>
                    <p>Net Worth(₹ Cr.)</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">34.04%</span>
                    <p>ROE</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">18.05%</span>
                    <p>Promoter Holding</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">10</span>
                    <p>Face Value(₹)</p>
                </div>
            </div>
            <br>
            <h1>(As on: FY2019) | Consideration Price: 765</h1>
            <hr>

        </section>

        <!-- ======= features Section ======= -->
        <section class="features section-bg" id="features">
            <div class="section-header">
                <h2>PEERS</h2>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="icon-box">
                        <div class="icon"><i class="las la-building" style="color: #15D295;"></i></div>
                        <h4 class="title">{{scriptDetail.script_peer_1}}</h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon-box">
                        <div class="icon"><i class="las la-building" style="color: #15D295;"></i></div>
                        <h4 class="title">{{scriptDetail.script_peer_2}}</h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon-box">
                        <div class="icon"><i class="las la-building" style="color: #15D295;"></i></div>
                        <h4 class="title">{{scriptDetail.script_peer_3}}</h4>
                    </div>
                </div>

            </div>

        </section><!-- End features Section -->

        <section class="content">
            <div class="section-header">
                <h2>Financials </h2>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card-header">
                        <h6 class="card-title">₹ Cr.</h6>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Annual</th>
                                <th v-for="financialsDetails in scriptDetail.script_financials" style="text-align: right;">{{financialsDetails.fin_year}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Revenue</td>
                                <td style="text-align: right;" v-for="financialsDetails in scriptDetail.script_financials"> {{financialsDetails.script_revenue}}</td>
                            </tr>

                            <tr>
                                <td>PAT</td>
                                <td style="text-align: right;" v-for="financialsDetails in scriptDetail.script_financials"> {{financialsDetails.script_profit}}</td>
                            </tr>

                            <tr>
                                <td>EPS</td>
                                <td style="text-align: right;" v-for="financialsDetails in scriptDetail.script_financials"> {{financialsDetails.script_eps}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>
        <!-- /.card -->
        <section id="notice">
            <div class="section-header">
                <h2>Useful Links / News</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 content">
                    <ul>
                        <li v-for="scriptLink in scriptDetail.script_news_links"><i class="las la-link"></i><b><a target="_blank" v-bind:href="'//'+scriptLink.script_news_link">{{scriptLink.script_link_header}}</a></b></li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="notice1">
            <div class="section-header">
                <h2>Annual Reports</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 content">
                    <ul>
                        <li v-for="scriptReport in scriptDetail.script_reports">
                            <i class="las la-file-pdf"></i>
                            <b>
                                <a target="_blank" v-bind:href="'//'+scriptReport.script_report_link">{{scriptReport.script_report_header}}</a>
                            </b>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import MasterHeader from "../layouts/MasterHeader";
import ScriptLists from "../layouts/ScriptLists";
import Order from "../views/Scripts/Order";
import OrderConfirm from "../views/Scripts/OrderConfirm";

export default {
    name: "Info",
    data() {
        return {
            id: this.$route.params.id,
            errors: [],
            scriptDetail: {},
            orderType: '',
            scriptValue: {},
            dataValue: {},
            scriptFinancials: {},
            isOrder: false,

            isOrderConfirm: false
        }
    },
    components: {
        Order,
        OrderConfirm,
        MasterHeader,
        ScriptLists
    },
    methods: {
        getScripts(){
            axios.get('/api/scripts/'+this.id).then(response => {
                this.scriptDetail = response.data.data.script;
            }).catch(error => {
                this.errors.push(error.response.data.message)
            });
        },
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
    },
    mounted() {
        this.getScripts();
    },
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'master-app');
    }
}
</script>

<style scoped>

</style>
