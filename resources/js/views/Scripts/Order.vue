<template>
    <div>
        <transition name="order">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-sm-6 col-6 popup-header-left text-left">
                                    <span>{{ values.script_display_name }}</span>
                                </div>
                                <div class="col-sm-5 col-5 popup-header-right text-right">
                                    <span>{{ values.script_isin_number }}</span>
                                </div>
                                <div class="col-sm-1 col-1 popup-header-right text-left">
                                    <button type="button" class="btn-close close float-left" @click="close"> x</button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
                                    </ul>
                                </div>
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
                                                <input class="form-control" v-model="order_price" id="buy-price" min="0"
                                                       step="1"
                                                       type="number">
                                            </div>
                                            <div class="col-sm-4 col-4 field-common">
                                                <label for="buy-qty-price">Qty.</label>
                                                <input class="form-control" v-model="order_qty" id="buy-qty-price"
                                                       min="1" step="1"
                                                       type="number">
                                            </div>
                                            <div class="col-sm-4 col-4 field-common">
                                                <label for="buy-lot-qty-price">Your Lot Qty</label>
                                                <input class="form-control" v-model="lot_size" id="buy-lot-qty-price"
                                                       min="1" step="1"
                                                       type="number">
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
                                                    <dt>{{ values.script_availability }} <a class="info-tool-tip"
                                                                                            data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                                                                            data-toggle="popover"
                                                                                            href="javascript:void(0)"><i
                                                        class="las la-info-circle"></i></a></dt>
                                                </dl>
                                            </div>
                                            <div class="col-sm-4 col-4">
                                                <dl class="d-flex align-items-center">
                                                    <dd>Min Lot:</dd>
                                                    <dt>{{ values.script_min_lot }} <a class="info-tool-tip"
                                                                                       data-content="Lorem, ipsum dolor sit amet consectetur adipisicing elit."
                                                                                       data-toggle="popover"
                                                                                       href="javascript:void(0)"><i
                                                        class="las la-info-circle"></i></a></dt>
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
                                            <button v-if="orderType === 'Buy'" type="submit"
                                                    class="buy-btn get-started-btn3">BUY
                                            </button>
                                            <button v-else type="submit" class="sell-btn get-started-btn3">SELL</button>
                                        </div>
                                        <div class="sell-btn-wrp"><a class="cancel-btn get-started-btn3" @click="close">CANCEL</a>
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
            dataVal: {},
            errors: []
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
            this.errors = [];
            this.$emit('close');
        },
        orderCreate() {
            this.errors = [];
            if (!this.order_price) {
                this.errors.push('Price is required.');
            }
            if (!this.order_qty) {
                this.errors.push('Qty is required.');
            }
            if (!this.lot_size) {
                this.errors.push('Lot Qty is required.');
            }

            if (this.order_price < this.values.lower || this.order_price > this.values.upper) {
                this.errors.push('you have to select price between ' + this.values.lower + ' and ' + this.values.upper);
            }

            if ((this.order_price * this.order_qty) > 5000000) {
                this.errors.push('Total Price will not grater then 50,00,000');
            }

            if(this.order_qty < 0){
                this.errors.push('Open Quantity is '+ this.order_qty+', Quantity reduction below the open quantity is not allowed.');
            }

            if (this.lot_size > this.order_qty) {
                this.errors.push('Lot Qty is must be less or equal to Qty');
            }

            if (this.order_qty % this.values.script_min_lot !== 0 || this.lot_size % this.values.script_min_lot !== 0) {
                this.errors.push('Qty and Lot Qty is must be multiplication of ' + this.values.script_min_lot);
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
                    lot_size: this.lot_size
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
                lot_size: this.lot_size
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
        }
    }
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
</style>
