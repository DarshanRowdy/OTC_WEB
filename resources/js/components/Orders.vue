<template>
    <div>
        <MasterHeader/>
        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </div>
        <div class="main main-dashboard">
            <div class="container1">
                <div class="dashboard-wrp d-flex align-items-top d-flex-none-mob">
                    <div class="dashboard-left">
                        <ScriptLists/>
                    </div>
                    <div class="dashboard-right">


                        <div class="open-order-section margin-bottom-50">
                            <div class="section-header">
                                <h2>Orders</h2>
                                <p>All Matched &amp; Open orders</p>
                            </div>
                            <table class="table table-hover order-custom-table" id="example1">
                                <thead>
                                <tr>
                                    <th align='center'></th>
                                    <th align='center' width="5px">Modify</th>
                                    <th align='center'>Symbol</th>
                                    <th align='center'>Type</th>
                                    <th align='center'>Price</th>
                                    <th align='center'>Qty (Matched/Total)</th>
                                    <th align='center'>Lot</th>
                                    <th align='center'>Avg Price</th>
                                    <th align='center'>Delivered Qty</th>
                                    <th align='center'>Order No</th>
                                    <th align='center'>Time</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd gradeX">
                                    <td align='center'></td>
                                    <td align='center'><span style="float:center;"><a href="#modify-popup"><i
                                        class="las la-edit la-2x"></i></a></span></td>
                                    <td align='center'>BIRA91</td>
                                    <td align='center'>SELL</td>
                                    <td align='right'>10000</td>
                                    <td align='right'>1000/1000</td>
                                    <td align='right'>1000</td>
                                    <td align='right'>10000</td>
                                    <td align='right'>10000</td>
                                    <td align='center'>2000014512A</td>
                                    <td align='center'>21/07/2020 14:02:02</td>

                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="completed-order-section">
                            <div class="section-header">
                                <h2>Past Orders</h2>
                                <p>All Completed &amp; Cancelled orders (Last 1 month)</p>
                            </div>

                            <table class="table table-hover order-custom-table" id="example2">
                                <thead>
                                <tr>
                                    <th align='center'>Symbol</th>
                                    <th align='center'>Type</th>
                                    <th align='right'>Average Price</th>
                                    <th align='right'>Delivered Qty</th>
                                    <th align='center'>Order No</th>
                                    <th align='center'>Time</th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr class="odd gradeX">
                                    <td align='center'>BIRA91</td>
                                    <td align='center'>BUY</td>
                                    <td align='right'>10000</td>
                                    <td align='right'>1000</td>
                                    <td align='center'>2000014512A</td>
                                    <td align='center'>21/07/2020 14:02:02</td>
                                </tr>


                                </tbody>
                            </table>


                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- Market Depth popup start -->

        <div class="overlay" id="market-depth">
            <div class="popup text-center">
                <a class="close" href="">×</a>
                <div class="content">
                    <p>HDB FINANCIAL</p>
                    <div class="depth-table">
                        <div class="row">
                            <table class="col-sm-6 buy table-toggle-wrp">
                                <thead>
                                <tr>
                                    <th class="order-price"><span>Bid</span>
                                    </th>
                                    <th class="orders">Orders</th>
                                    <th class="text-right quantity">Qty.</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="rate">1364.00</td>
                                    <td class="orders">11</td>
                                    <td class="text-right quantity">
                                        3098
                                    </td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.00</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">1</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.90</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">1</td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.85</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">1</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.80</td>
                                    <td class="orders">2</td>
                                    <td class="text-right quantity">101</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.85</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">1</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.80</td>
                                    <td class="orders">200</td>
                                    <td class="text-right quantity">10</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.85</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">1</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.80</td>
                                    <td class="orders">2</td>
                                    <td class="text-right quantity">101</td>
                                </tr>
                                <tr>
                                    <td class="rate">1363.80</td>
                                    <td class="orders">2</td>
                                    <td class="text-right quantity">101</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-right" colspan="2">1,94,169</td>
                                </tr>
                                </tfoot>
                            </table>
                            <table class="col-sm-6 sell table-toggle-wrp">
                                <thead>
                                <tr>
                                    <th class="order-price">
                                        <span>Offer</span></th>
                                    <th class="orders">Orders</th>
                                    <th class="text-right quantity">Qty.</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="rate">1364.05</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">22</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.15</td>
                                    <td class="orders">3</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.20</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.25</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.55</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.25</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.55</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.25</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.55</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                <tr>
                                    <td class="rate">1364.55</td>
                                    <td class="orders">1</td>
                                    <td class="text-right quantity">33</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>Total</td>

                                    <td class="text-right" colspan="2">10,27,680</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="buy-sell-btn d-flex align-items-center margin-top-20 margin-bottom-20">
                            <div class="buy-btn-wrp"><a class="buy-btn get-started-btn3" href="#buy-popup">BUY</a></div>
                            <div class="sell-btn-wrp"><a class="sell-btn get-started-btn3" href="#sell-popup">SELL</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Market Depth popup end -->

        <!-- Modify popup start  -->

        <div class="overlay buy-popup sell-popup" id="modify-popup">
            <div class="popup text-center">
                <a class="close" href="">×</a>
                <div class="content">
                    <div class="popup-header">
                        <div class="row">
                            <div class="col-sm-6 col-6 popup-header-left text-left">
                                <span>HDB Financial</span>
                            </div>
                            <!-- <div class="col-sm-4 col-4 popup-header-center">
                              <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                              </label>
                            </div> -->
                            <div class="col-sm-6 col-6 popup-header-right text-right">
                                <span>ISIN1554842345</span>
                            </div>
                        </div>
                    </div>
                    <div class="circuit-section margin-top-10">
                        <div class="row">
                            <div class="col-lg-4 col-6"><span>Lower Circuit: <label>60</label></span></div>
                            <div class="col-lg-4 col-6"><span>Upper Circuit: <label>140</label></span></div>
                            <div class="col-lg-4 col-6"><span>Order type: <label>SELL</label></span></div>
                        </div>
                    </div>
                    <div class="form-field-section margin-top-30 padding-bottom-10">
                        <div class="row">
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="buy-price">Price</label>
                                    <input class="form-control" id="buy-price" min="1" step="1" type="number">
                                </form>
                            </div>
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="qty-price">Qty.</label>
                                    <input class="form-control" id="qty-price" min="1" step="1" type="number">
                                </form>
                            </div>
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="lot-qty-price">Your Lot Qty</label>
                                    <input class="form-control" id="lot-qty-price" min="1" step="1" type="number">
                                </form>
                                <div class="info-tool-tip-wrp">
                                    <a class="info-tool-tip" data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit." data-toggle="popover"
                                       href="javascript:void(0)"><i
                                        class="las la-info-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sc-last margin-top-20">
                        <div class="row">
                            <div class="col-sm-8 col-8">
                                <dl class="d-flex align-items-center">
                                    <dd>Available in:</dd>
                                    <dt>NSDL and CDSL <a class="info-tool-tip" data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                                         data-toggle="popover"
                                                         href="javascript:void(0)"><i
                                        class="las la-info-circle"></i></a></dt>
                                </dl>
                            </div>
                            <div class="col-sm-4 col-4">
                                <dl class="d-flex align-items-center">
                                    <dd>Min Lot:</dd>
                                    <dt>1 <a class="info-tool-tip" data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit." data-toggle="popover"
                                             href="javascript:void(0)"><i
                                        class="las la-info-circle"></i></a></dt>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                        <div class="buy-btn-wrp"><a class="confirm-btn get-started-btn3" href="#sell-popup2">CONFIRM</a>
                        </div>
                        <div class="sell-btn-wrp"><a class="confirm-btn get-started-btn3" href="#sell-popup2">CANCEL
                            ORDER</a></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modify popup end  -->
    </div>
</template>

<script>

import ScriptLists from "../layouts/ScriptLists";
import MasterHeader from "../layouts/MasterHeader";

export default {
    name: "Orders",
    components: {
        ScriptLists,
        MasterHeader
    },
    data() {
        return {
            errors: []
        }
    },
    mounted() {
       /* $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
        });*/
    }
}
</script>

<style scoped>

</style>
