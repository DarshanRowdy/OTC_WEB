<template>
    <div>

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

                                <li class="icon-more icon-bg-blank">
                                    <router-link to="/info">
                                        <i class="las la-ellipsis-v"></i>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

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
                                    <label for="buy-qty-price">Qty.</label>
                                    <input class="form-control" id="buy-qty-price" min="1" step="1" type="number">
                                </form>
                            </div>
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="buy-lot-qty-price">Your Lot Qty</label>
                                    <input class="form-control" id="buy-lot-qty-price" min="1" step="1" type="number">
                                </form>
                                <div class="info-tool-tip-wrp">
                                    <a class="info-tool-tip"
                                       data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                       data-toggle="popover"
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
                                    <dt>Only NSDL <a class="info-tool-tip"
                                                     data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                                     data-toggle="popover"
                                                     href="javascript:void(0)"><i
                                        class="las la-info-circle"></i></a></dt>
                                </dl>
                            </div>
                            <div class="col-sm-4 col-4">
                                <dl class="d-flex align-items-center">
                                    <dd>Min Lot:</dd>
                                    <dt>1 <a class="info-tool-tip"
                                             data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                             data-toggle="popover"
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
                                    <input class="form-control" id="sell-price" min="1" step="1" type="number">
                                </form>
                            </div>
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="sell-qty-price">Qty.</label>
                                    <input class="form-control" id="sell-qty-price" min="1" step="1" type="number">
                                </form>
                            </div>
                            <div class="col-sm-4 col-4 field-common">
                                <form action="">
                                    <label for="sell-lot-qty-price">Your Lot Qty</label>
                                    <input class="form-control" id="sell-lot-qty-price" min="1" step="1" type="number">
                                </form>
                                <div class="info-tool-tip-wrp">
                                    <a class="info-tool-tip"
                                       data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                       data-toggle="popover"
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
                                    <dt>NSDL and CDSL <a class="info-tool-tip"
                                                         data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                                         data-toggle="popover"
                                                         href="javascript:void(0)"><i
                                        class="las la-info-circle"></i></a></dt>
                                </dl>
                            </div>
                            <div class="col-sm-4 col-4">
                                <dl class="d-flex align-items-center">
                                    <dd>Min Lot:</dd>
                                    <dt>1 <a class="info-tool-tip"
                                             data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                             data-toggle="popover"
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

export default {
    name: "ScriptLists",
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
