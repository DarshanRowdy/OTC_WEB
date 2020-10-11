<template>
    <div>
        <p v-if="errors" class="text-danger">{{ errors }}</p>
        <section id="info">
            <h1><b>{{ scriptDetail.script_name }}</b></h1>
            <div class="row">
                <div class="col-lg-6">
                    <P>SECTOR:{{ scriptDetail.script_sector }}</p>
                </div>
                <div class="col-lg-6">
                    <p>ISIN:{{scriptDetail.script_isin_number}}</p>
                </div>
            </div>
            <p>{{scriptDetail.script_description}}</p>
            <div class="buysell">
                <div class="row">
                    <div class="buy-btn-wrp">
                        <a href="javascript:void(0)" class="buy-btn get-started-btn3" @click="showOrder(scriptDetail, 'Buy')">BUY</a>
                    </div>
                    <div class="sell-btn-wrp">
                        <a href="javascript:void(0)" class="sell-btn get-started-btn3" @click="showOrder(scriptDetail, 'Sell')">SELL</a>
                    </div>
                    <div class="sell-btn-wrp">
                        <router-link class="mkt-btn get-started-btn3" v-bind:to="`/market-depth/${scriptDetail.script_id}`">
                           Market Depth
                        </router-link>
                    </div>
                </div>
            </div>
            <Order :values="scriptValue" :orderType="orderType" v-show="isOrder" @close="closeOrder"/>
            <OrderConfirm :values="scriptValue" :dataValue="dataValue" v-show="isOrderConfirm" @close="closeOrderConfirm"/>

        </section>

        <section id="fact">

            <hr>
            <div class="row counters">
                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ marketCap }}</span>
                    <p>Market Cap(₹ Cr.)</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ p_e }}</span>
                    <p>P/E</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ p_b }}</span>
                    <p>P/B</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ eps }}</span>
                    <p>EPS</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ netWork }}</span>
                    <p>Net Worth(₹ Cr.)</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ roe }}</span>
                    <p>ROE</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ promoter }}</span>
                    <p>Promoter Holding</p>
                </div>

                <div class="col-lg-3 col-6 text-left">
                    <span data-toggle="counter-up">{{ faceValue }}</span>
                    <p>Face Value(₹)</p>
                </div>
            </div>
            <br>
            <h1>(As on: 31MAR{{ fin_year }}) | Consideration Price: {{ scriptDetail.script_ltp }}</h1>
            <hr>

        </section>

        <!-- ======= features Section ======= -->
        <section class="features section-bg" id="features">
            <div class="section-header">
                <h2>PEERS</h2>
            </div>

            <div class="row">
                <div class="col-lg-4" v-if="scriptDetail.script_peer_1">
                    <div class="icon-box">
                        <div class="icon"><i class="las la-building" style="color: #15D295;"></i></div>
                        <h4 class="title">{{scriptDetail.script_peer_1}}</h4>
                    </div>
                </div>
                <div class="col-lg-4" v-if="scriptDetail.script_peer_2">
                    <div class="icon-box">
                        <div class="icon"><i class="las la-building" style="color: #15D295;"></i></div>
                        <h4 class="title">{{scriptDetail.script_peer_2}}</h4>
                    </div>
                </div>
                <div class="col-lg-4" v-if="scriptDetail.script_peer_3">
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
                                <th v-for="financialsDetails in scriptDetail.script_financials" style="text-align: right;">FY{{financialsDetails.fin_year}}</th>
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
import Order from "../views/Scripts/Order";
import OrderConfirm from "../views/Scripts/OrderConfirm";

export default {
    name: "Info",
    data() {
        return {
            id: this.$route.params.id,
            errors: '',
            scriptDetail: {},
            orderType: '',
            scriptValue: {},
            dataValue: {},
            scriptFinancials: {},
            isOrder: false,
            isOrderConfirm: false,
            marketCap: '',
            p_e: '',
            p_b: '',
            eps: '',
            netWork: '',
            roe: '',
            promoter: '',
            faceValue: '',
            fin_year: ''
        }
    },
    components: {
        Order,
        OrderConfirm,
    },
    methods: {
        getScripts(){
            axios.get('/api/scripts/'+this.id).then(response => {
                if(response.data.responseCode === 200){
                    this.scriptDetail = response.data.data.script;
                    this.calculateFinancialYear();
                    window.scrollTo(0,0);
                } else {
                    this.$router.push('/404');
                }
            }).catch(error => {
                this.$router.push('/404');
            });
        },
        calculateFinancialYear(){
            let mCap = (this.scriptDetail.script_ltp * this.scriptDetail.last_year_script_financial.script_issued) / 10000000;
            this.marketCap = mCap !== null ? mCap.toFixed(2) : '-';

            if(this.scriptDetail.last_year_script_financial.script_eps < 0) {
                this.p_e = '-';
            } else {
                let pe = (this.scriptDetail.script_ltp / this.scriptDetail.last_year_script_financial.script_eps);
                this.p_e = pe !== null ? pe.toFixed(2) : '-';
            }

            if(this.scriptDetail.last_year_script_financial.script_book_value < 0){
                this.netWork = '-';
            } else {
                this.netWork = this.scriptDetail.last_year_script_financial.script_book_value;
            }

            if(this.netWork < 0 || this.netWork === '-'){
                this.p_b = '-';
            } else {
                let pb = this.marketCap / this.netWork;
                this.p_b = pb !== null ? pb.toFixed(2) : '-';
            }


            let EPS = this.scriptDetail.last_year_script_financial.script_eps;
            this.eps = EPS !== null ? EPS : '-';

            if((this.eps < 0 || this.eps === '-') && (this.netWork < 0 || this.netWork === '-')){
                this.roe = '-';
            } else {
                let ROE = (this.scriptDetail.last_year_script_financial.script_profit / this.netWork) * 100;
                this.roe = ROE !== null ? ROE.toFixed(2)+'%' : '-';
            }

            let Promo = this.scriptDetail.last_year_script_financial.script_promoter_holding
            this.promoter = Promo !== null ? Promo+'%' : '-';

            let FaceVal = this.scriptDetail.script_face_val
            this.faceValue = FaceVal !== null ? FaceVal : '-';

            let FineYear = this.scriptDetail.last_year_script_financial.fin_year;
            this.fin_year = FineYear !== null ? FineYear : '-';
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
    watch: {
        '$route' (to, from) {
            this.id = this.$route.params.id;
            this.getScripts();
        }
    },
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'master-app');
        this.getScripts();
    }
}
</script>

<style scoped>

</style>
