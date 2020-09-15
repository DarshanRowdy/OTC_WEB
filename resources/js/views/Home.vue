<template>
    <div>
        <!-- ======= Header ======= -->


        <!-- End Header -->

        <MasterHeader/>
        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
            </ul>
        </div>
        <div class="main main-dashboard">
            <div class="container1">
                <div class="dashboard-wrp d-flex align-items-top d-flex-none-mob">
                    <div class="dashboard-left">
                        <div class="left-wrp">
                            <div class="search-section">
                                <form action="">
                                    <input placeholder="Search" type="text">
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
                                                <li class="icon-buy"><a data-content="Buy" data-toggle="popover"
                                                                        href="#buy-popup">B</a></li>
                                                <li class="icon-sell"><a data-content="Sell" data-toggle="popover"
                                                                         href="#sell-popup">S</a></li>
                                                <li class="icon-market-depth icon-bg-blank" data-content="Market Depth"
                                                    data-toggle="popover"><a href="#market-depth"> <i
                                                    class="las la-bars"></i> </a></li>

                                                <li class="icon-more icon-bg-blank"><a data-content="Info"
                                                                                       data-toggle="popover"
                                                                                       href="info.html"> <i
                                                    class="las la-ellipsis-v"></i> </a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--<div class="dashboard-right">


                        <section id="notice">

                            <div class="section-header">
                                <h2>Announcements</h2></div>

                            <ul>
                                <li><i class="las la-bullhorn"></i> Company failed to meet regulatory requirements
                                    (Delisted).
                                </li>
                                <li><i class="las la-bullhorn"></i> Company failed to meet regulatory requirements
                                    (Delisted).
                                </li>
                                <li><i class="las la-bullhorn"></i> Company failed to meet regulatory requirements
                                    (Delisted).
                                </li>
                            </ul>
                            <hr>

                        </section>


                        &lt;!&ndash; ======= dashcard Section ======= &ndash;&gt;
                        <section id="dashcard">


                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="stages">
                                        <h3>
                                            Market Hours
                                        </h3>
                                        <div class="icon"><i class="las la-clock"></i></div>
                                        <div class="data">
                                            <h4>Mon-Sat</h4>
                                            <h4>9:00 AM to 6:00 PM</h4></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <h3>
                                            Active Scripts
                                        </h3>
                                        <div class="icon"><i class="las la-bars"></i></div>
                                        <div class="data">
                                            <h4>40</h4></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <h3>
                                            Lot Size
                                        </h3>
                                        <div class="icon"><i class="las la-bars"></i></div>
                                        <div class="data">
                                            <h4>No minimum lot size from our side</h4></div>
                                    </div>
                                </div>


                            </div>
                            &lt;!&ndash;  </div>&ndash;&gt;

                        </section>&lt;!&ndash; End How it works Section &ndash;&gt;


                        &lt;!&ndash; ======= How it Works Section ======= &ndash;&gt;
                        <section id="howitworks">

                            <div class="section-header">
                                <h2>HOW IT WORKS</h2>
                            </div>
                            &lt;!&ndash; <div class="owl-carousel testimonials-carousel">&ndash;&gt;
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="stages">
                                        <p>
                                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                                            1) Place Buy or Sell order during Market Hours
                                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                                        </p>
                                        <div class="icon"><i class="las la-shopping-cart" style="color: #15D295;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <p>
                                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                                            2) Once your order is matched, we will confirm the deal from both parties
                                            over the phone before initiating the settlement process.
                                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                                        </p>
                                        <div class="icon"><i class="las la-handshake" style="color: #15D295;"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <p>
                                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                                            3) Once the deal is locked, we will send the invoice to buyer. Buyer will
                                            have to make payment to company’s account as per the invoice to initiate the
                                            settlement.
                                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                                        </p>
                                        <div class="icon"><i class="las la-credit-card" style="color: #15D295;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <p>
                                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                                            4) Once we receive the payment from buyer, We will intimate the seller to
                                            transfer the shares into company’s account as per deal agreement.
                                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                                        </p>
                                        <div class="icon"><i class="las la-rupee-sign" style="color: #15D295;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <p>
                                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                                            5) Once seller transfers the agreed quantity of shares.

                                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                                        </p>
                                        <div class="icon"><i class="las la-file-alt" style="color: #15D295;"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="stages">
                                        <p>
                                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                                            6) <b> We will settle the trade.</b> (By transferring shares to buyer and
                                            funds to seller.)

                                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                                        </p>
                                        <div class="icon"><i class="las la-exchange-alt" style="color: #15D295;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &lt;!&ndash;  </div>&ndash;&gt;

                        </section>&lt;!&ndash; End How it works Section &ndash;&gt;


                        <hr>
                        <section id="notes">

                            <div class="section-header">
                                <h2>Notes</h2></div>
                            <ul>
                                <li><i class="las la-question-circle"></i>We want to make settlement process faster, How
                                    can we do that?
                                </li>
                                <li><i class="las la-hand-point-right"></i>Please add our Bank and Demat account as
                                    Beneficiary / Trusted account for faster transaction from your side.
                                </li>
                            </ul>

                            <hr>
                            <h4 style="color:#46454d"><b>Bank A/C Details</b></h4>

                            <section id="fact1" style="margin-top: -40px;">


                                <div class="row counters">
                                    <div class="col-lg-12 col-12 text-left">
                                        <span data-toggle="counter-up">OTC Capital Services Private Limited</span>
                                        <p>Beneficiary Name</p>
                                    </div>

                                    <div class="col-lg-12 col-12 text-left">
                                        <span data-toggle="counter-up">HDFC Bank Ltd</span>
                                        <p>Bank Name</p>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">1211211212121</span>
                                        <p>A/C Number</p>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">HDFC0000146</span>
                                        <p>IFSC Code</p>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">Current A/C</span>
                                        <p>A/C Type</p>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">ABXYZ1234C</span>
                                        <p>PAN</p>
                                    </div>

                                </div>
                                <hr>

                            </section>


                            <h4 style="color:#46454d; margin-top: -40px;"><b>Demat A/C Details</b></h4>

                            <section id="fact1" style="margin-top: -40px;">


                                <div class="row counters">
                                    <div class="col-lg-12 col-12 text-left">
                                        <span data-toggle="counter-up">OTC Capital Services Private Limited</span>
                                        <p>Client Name</p>
                                    </div>

                                    <div class="col-lg-12 col-12 text-left">
                                        <span data-toggle="counter-up">Stockholding Corporation of India Limited</span>
                                        <p>DP Name</p>
                                    </div>

                                    <div class="col-lg-12 col-12 text-left">
                                        <span data-toggle="counter-up" style="text-decoration: underline;">NSDL</span>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">IN123456</span>
                                        <p>DP ID</p>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">12345678</span>
                                        <p>Client ID</p>
                                    </div>

                                    <div class="col-lg-12 col-12 text-left">
                                        <span data-toggle="counter-up" style="text-decoration: underline;">CDSL</span>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">12345678</span>
                                        <p>DP ID</p>
                                    </div>

                                    <div class="col-lg-6 col-6 text-left">
                                        <span data-toggle="counter-up">12345678</span>
                                        <p>Client ID</p>
                                    </div>


                                </div>
                                <hr>

                            </section>


                        </section>
                    </div>-->
                </div>
            </div>
        </div>

        <!-- Market Depth popup start -->

        <!--<div class="overlay" id="market-depth">
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
        </div>-->

        <!-- Market Depth popup end -->

        <!-- Buy popup start  -->

        <div class="overlay buy-popup" id="buy-popup">
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
                                <input type="checkbox">
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

                            <div class="col-sm-4 col-6"><span>Lower Circuit: <label>60</label></span></div>
                            <div class="col-sm-4 col-6"><span>Upper Circuit: <label>140</label></span></div>
                        </div>
                    </div>
                    <div class="form-field-section margin-top-30 padding-bottom-10">
                        <div class="row">
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="buy-price">Price</label>
                                    <input class="form-control" id="buy-price" min="0" step="1" type="number">
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
                                       href="javascript:void(0)"> <i
                                        class="las la-info-circle"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sc-last margin-top-20">
                        <div class="row">
                            <div class="col-sm-8 col-8">
                                <dl class="d-flex align-items-center">
                                    <dd>Available in:</dd>
                                    <dt>Only NSDL <a class="info-tool-tip" data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
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
                        <div class="buy-btn-wrp"><a class="buy-btn get-started-btn3" href="#buy-popup2">BUY</a></div>
                        <div class="sell-btn-wrp"><a class="cancel-btn get-started-btn3" href="#">CANCEL</a></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Buy popup end  -->

        <!-- buy confirmation popup start  -->

        <div class="overlay buy-popup" id="buy-popup2">
            <div class="popup text-center">
                <a class="close" href="">×</a>
                <div class="content">
                    <div class="popup-header">
                        <div class="row">
                            <div class="col-sm-6 col-6 popup-header-left text-left">
                                <span>HDB Financial</span>
                            </div>

                            <div class="col-sm-6 col-6 popup-header-right text-right">
                                <span>ISIN1554842345</span>
                            </div>
                        </div>
                    </div>


                    <br><br><br>
                    <p>Are you loren lorem lorem want to lorem lorem comfirm? </p>

                    <div class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                        <div class="buy-btn-wrp"><a class="buy-btn get-started-btn3" href="#">CONFIRM</a></div>
                        <div class="sell-btn-wrp"><a class="cancel-btn get-started-btn3" href="#">CANCEL</a></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- buy confirmation popup end  -->


        <!-- Sell popup start  -->

        <div class="overlay buy-popup sell-popup" id="sell-popup">
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
                        <div class="buy-btn-wrp"><a class="sell-btn get-started-btn3" href="#sell-popup2">SELL</a></div>
                        <div class="sell-btn-wrp"><a class="cancel-btn get-started-btn3" href="#">CANCEL</a></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Sell popup end  -->

        <!-- sell confirmation popup start  -->

        <div class="overlay buy-popup" id="sell-popup2">
            <div class="popup text-center">
                <a class="close" href="">×</a>
                <div class="content">
                    <div class="popup-header">
                        <div class="row">
                            <div class="col-sm-6 col-6 popup-header-left text-left">
                                <span>HDB Financial</span>
                            </div>

                            <div class="col-sm-6 col-6 popup-header-right text-right">
                                <span>ISIN1554842345</span>
                            </div>
                        </div>
                    </div>


                    <br><br><br>
                    <p>Are you loren lorem lorem want to lorem lorem comfirm? </p>

                    <div class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                        <div class="buy-btn-wrp"><a class="sell-btn get-started-btn3" href="#">CONFIRM</a></div>
                        <div class="sell-btn-wrp"><a class="cancel-btn get-started-btn3" href="#">CANCEL</a></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MasterHeader from "../layouts/MasterHeader";

export default {
    name: "Home",
    components: {MasterHeader},
    data() {
        return {
            scripts: [],
            errors: []
        }
    },
    methods: {
        getUnits() {
            axios.get('api/scripts').then(response => {
                this.scripts = response.data.data.scripts;
            }).catch(error => {
                this.errors.push(error.response.data.message)
            });
        },
    },
    beforeMount() {
        this.getUnits();
    }
}
</script>

<style scoped>

</style>
