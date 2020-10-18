<template>
    <div>
        <transition name="order">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-sm-5 col-5 popup-header-left text-left">
                                    <span>{{ values.script_display_name }}</span>
                                </div>
                                <div class="col-sm-5 col-5 popup-header-right text-right">
                                    <span>{{ values.script_isin_number }}</span>
                                </div>
                                <div class="col-sm-1 col-1 popup-header-right text-left">
                                    <a href="javascript:void(0)" class="close" @click="close"> x</a>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p v-if="errors" class="text-danger">{{ errors }}</p>
                                <form v-on:submit.prevent="orderCreate">
                                    <div class="circuit-section margin-top-10">
                                        <div class="row">
                                            <div class="col-sm-4 col-4"><span>Lower Circuit:
                                                <label> {{ values.lower }} </label></span></div>
                                            <div class="col-sm-4 col-4"><span>Upper Circuit:
                                                <label>{{ values.upper }}</label></span></div>
                                            <div v-if="orderData" class="col-sm-4 col-4"><span>Order type:
                                                <label>{{ orderType }}</label></span></div>
                                        </div>
                                    </div>
                                    <div class="form-field-section margin-top-30 padding-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4 col-4 field-common">
                                                <label for="buy-price">Price</label>
                                                <input class="form-control" v-model="order_price" id="buy-price" @keypress="isNumber($event)"
                                                       type="number">
                                            </div>
                                            <div class="col-sm-4 col-4 field-common">
                                                <label for="buy-qty-price">Qty.</label>
                                                <input class="form-control" v-model="order_qty" id="buy-qty-price" @keypress="isNumber($event)"
                                                       type="number">
                                            </div>
                                            <div class="col-sm-4 col-4 field-common">
                                                <label for="buy-lot-qty-price">Your Lot Qty</label>
                                                <input class="form-control" v-model="lot_size" id="buy-lot-qty-price" @keypress="isNumber($event)"
                                                       min="1" step="1"
                                                       type="number">
                                                <div class="info-tool-tip-wrp">
                                                    <a title="In this multiple of Lot you are comfortable to transact shares/amount to complete the whole Qty of this order. Keep both same if you want only single transaction."
                                                       class="info-tool-tip"
                                                       href="javascript:void(0)">
                                                        <i class="las la-info-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc-last margin-top-20">
                                        <div class="row">
                                            <div class="col-sm-8 col-8">
                                                <dl class="d-flex align-items-center">
                                                    <dd>Available in:</dd>
                                                    <dt>{{ values.script_availability }}
                                                        <a class="info-tool-tip"
                                                            href="javascript:void(0)"
                                                           title="In the mentioned Depository/ies, Shares of this company are available to trade"
                                                        >
                                                        <i class="las la-info-circle"></i></a>
                                                    </dt>
                                                </dl>
                                            </div>
                                            <div class="col-sm-4 col-4">
                                                <dl class="d-flex align-items-center">
                                                    <dd>Min Lot:</dd>
                                                    <dt>{{ values.script_min_lot }}
                                                        <a class="info-tool-tip"
                                                           href="javascript:void(0)"
                                                           title="Minimum lot size to trade in this stock.">
                                                            <i class="las la-info-circle"></i>
                                                        </a>
                                                    </dt>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="order_id" class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                                        <div class="buy-btn-wrp"><button type="submit" class="confirm-btn get-started-btn3">MODIFY</button></div>
                                        <div class="sell-btn-wrp"><a href="javascript:void(0)" @click="cancelOrder" class="confirm-btn get-started-btn3">CANCEL ORDER</a></div>
                                    </div>
                                    <div v-else class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                                        <div class="buy-btn-wrp">
                                            <button v-if="orderType === 'BUY'" type="submit"
                                                    class="buy-btn get-started-btn3">BUY
                                            </button>
                                            <button v-else type="submit" class="sell-btn get-started-btn3">SELL</button>
                                        </div>
                                        <div class="sell-btn-wrp"><a href="javascript:void(0)" class="cancel-btn get-started-btn3" @click="close">CANCEL</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "Order",
    props: ['values', 'orderType', 'orderData'],
    data() {
        return {
            order_no: '',
            order_id: '',
            script_id: '',
            order_price: '',
            order_qty: '',
            lot_size: '',
            open_qty: '',
            dataVal: {},
            errors: '',
            min_order_qty: '',
            min_lot_qty: ''
        }
    },
    components: {
    },
    methods: {
        close() {
            this.order_id = '';
            this.order_price = '';
            this.order_qty = '';
            this.lot_size = '';
            this.errors = '';
            this.$emit('close');
        },
        isNumber(e) {
            let num = String.fromCharCode(e.keyCode);
            if (/^[0-9]+$/.test(num)) return true;
            else e.preventDefault();
        },
        orderCreate() {
            this.errors = '';
            if (!this.order_price) {
                this.errors = 'Price is required.';
                return false;
            }
            if (!this.order_qty) {
                this.errors = 'Qty is required.';
                return false;
            }
            if (!this.lot_size) {
                this.errors= 'Lot Qty is required.';
                return false;
            }

            if (this.order_price < this.values.lower || this.order_price > this.values.upper) {
                this.errors = 'Your order price is not within the range, please enter order price in the range from ' + this.values.lower + ' to ' + this.values.upper;
                return false;
            }

            if ((this.order_price * this.order_qty) > 5000000) {
                this.errors = 'Order value grater than 50 Lakhs. Please call us for placing this order.';
                return false;
            }

            if(this.order_id !== '' && parseInt(this.order_qty) < this.min_order_qty) {
                this.errors = 'Open Quantity is '+ this.open_qty +', Quantity reduction below the open quantity is not allowed.';
                return false;
            }

            if (parseInt(this.lot_size) > parseInt(this.order_qty)) {
                this.errors = 'Your Lot Qty must be less than or equal to Order Qty.';
                return false;
            }

            if (this.order_qty % this.values.script_min_lot !== 0 || this.lot_size % this.values.script_min_lot !== 0) {
                this.errors = 'Qty and Lot Qty is must be multiplication of ' + this.values.script_min_lot;
                return false;
            }

            if (!this.errors.length) {
                let userObj = JSON.parse(localStorage.getItem('userObj'));
                const data = {
                    order_id: this.order_id,
                    order_no: this.order_no,
                    cust_id: userObj.user_id,
                    script_id: this.values.script_id,
                    order_type: this.orderType,
                    order_price: this.order_price,
                    order_qty: this.order_qty,
                    lot_size: this.lot_size,
                    open_qty: this.open_qty,
                    min_order_qty: this.min_order_qty
                };
                this.order_price = '';
                this.order_qty = '';
                this.lot_size = '';
                this.order_id = '';
                this.$parent.showOrderConfirm(this.values, data);
            }
        },
        cancelOrder(){
            let userObj = JSON.parse(localStorage.getItem('userObj'));
            const data = {
                order_id: this.order_id,
                order_no: this.order_no,
                cust_id: userObj.user_id,
                script_id: this.values.script_id,
                order_type: this.orderType,
                order_price: this.order_price,
                order_qty: this.order_qty,
                lot_size: this.lot_size,
                open_qty: this.open_qty
            };
            this.order_price = '';
            this.order_qty = '';
            this.lot_size = '';
            this.order_id = '';
            this.$parent.showOrderCancel(this.values, data);
        }
    },
    watch: {
        orderData: function(newVal, oldVal) { // watch it
            // console.log('Prop changed: ', newVal, ' | was: ', oldVal)
            this.order_id = newVal.order_id;
            this.order_no = newVal.order_num;
            this.order_price = newVal.order_price;
            this.order_qty = newVal.order_qty_original;
            this.lot_size = newVal.lot_size;
            this.open_qty = newVal.qty;
            this.min_order_qty = parseInt(this.order_qty) - parseInt(this.open_qty);
        },
        /*order_qty: function (newVal, oldVal) {
            // console.log('Prop changed: ', newVal, ' | was: ', oldVal)
            let new_open = parseInt(newVal) - parseInt(this.min_order_qty);
            this.lot_size = this.lot_size > new_open && new_open > 0 ? new_open : this.lot_size;
        }*/
    }
}
</script>

<style scoped>
span {
    position: relative;
}

span:active:after {
    content:attr(title);
    padding:5px;
    border:1px solid #ccc;
    top:5px;
    right:10%;
    background: #bada55;
}

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

@media screen and (max-width: 1023px)
{
    .get-started-btn3 {
        margin-left: 6px;
        margin-right: 6px;
    }
    .col-sm-4{
        padding-right: 10px;
        padding-left: 10px;
    }
    .col-sm-5{
        padding-right: 10px;
        padding-left: 10px;
    }
    .modal-header {
        padding: 0;
    }
    .modal-dialog {
        margin: .2rem;
    }
    .modal-body{
        padding: 0.5rem;
    }
}
@media screen and (max-width: 300px)
{
    .get-started-btn3 {
        margin-left: 2px;
        margin-right: 2px;
    }
    .col-sm-4{
        padding-right: 5px;
        padding-left: 10px;
    }
    .col-sm-5{
        padding-right: 5px;
        padding-left: 5px;
    }
    .modal-header {
        padding: 0;
    }
    .modal-dialog {
        margin: .2rem;
    }
    .modal-body{
        padding: 0.5rem;
    }
    .form-control{
        width: 90%;
        margin: 3px;
    }
}
</style>
