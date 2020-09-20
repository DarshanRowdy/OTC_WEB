<template>
    <div>
        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </div>

        <section id="info">
            <h1><b>Anheuser Inbev India Limited</b></h1>
            <div class="row">
                <div class="col-lg-6">
                    <P>SECTOR: Breweries &amp; Distilleries</p>
                </div>
                <div class="col-lg-6"><p> ISIN: INE038G01019</p></div>
            </div>
            <p>Unlisted Company HDB Financial has lines of business include – Lending and BPO
                Services.</p>
            <div class="buysell">
                <div class="row">

                    <div class="buy-btn-wrp"><a class="buy-btn get-started-btn3"
                                                href="#buy-popup">BUY</a>
                    </div>
                    <div class="sell-btn-wrp"><a class="sell-btn get-started-btn3"
                                                 href="#sell-popup">SELL</a></div>
                    <!--
                                             <div class="mkt-btn-wrp"><a href="#market-depth" class="cancel-btn get-started-btn3">Market Depth</a></div>
                    -->
                    <div class="sell-btn-wrp"><a class="mkt-btn get-started-btn3" href="#market-depth">Market
                        Depth</a></div>


                </div>
            </div>

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
                        <h4 class="title">United Breweries</h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon-box">
                        <div class="icon"><i class="las la-building" style="color: #15D295;"></i></div>
                        <h4 class="title">B9 Beverages</h4>
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
                                <th style="text-align: right;">FY2019</th>
                                <th style="text-align: right;">FY2018</th>
                                <th style="text-align: right;">FY2017</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Revenue</td>
                                <td style="text-align: right;"> 3,193.74</td>
                                <td style="text-align: right;"> 3,279.85</td>
                                <td style="text-align: right;"> -9.46</td>
                            </tr>

                            <tr>
                                <td>PAT</td>
                                <td style="text-align: right;"> -101.71</td>
                                <td style="text-align: right;"> -386.70</td>
                                <td style="text-align: right;"> -9.46</td>
                            </tr>


                            <tr>
                                <td>EPS</td>
                                <td style="text-align: right;"> -2.49</td>
                                <td style="text-align: right;"> -9.46</td>
                                <td style="text-align: right;"> -9.46</td>
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
                        <li><i class="las la-link"></i> <b><a href="">Link</a></b></li>
                        <li><i class="las la-link"></i> <b><a href="">Link</a></b></li>
                        <li><i class="las la-link"></i> <b><a href="">Link</a></b></li>
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
                        <li><i class="las la-file-pdf"></i> <b><a
                            href="annual-report/INE038G01019-2019.pdf">FY2019: AB-INBEV
                            SABMILLER</a></b>
                        </li>
                        <li><i class="las la-file-pdf"></i> <b><a
                            href="annual-report/INE038G01019-2018.pdf">FY2018: AB-INBEV
                            SABMILLER</a></b>
                        </li>
                        <li><i class="las la-file-pdf"></i> <b><a
                            href="annual-report/INE038G01019-2017.pdf">FY2017: AB-INBEV
                            SABMILLER</a></b>
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

export default {
    name: "Info",
    data() {
        return {
            errors: []
        }
    },
    components: {
        MasterHeader,
        ScriptLists
    },
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'master-app');
    }
}
</script>

<style scoped>

</style>
