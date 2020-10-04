<template>
    <div>
        <transition name="order-cancel">
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
                                <p>You are about to cancel {{dataValue.order_qty}} open quantity, Ary you sure you want to cancel this order?</p>
                                <div class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                                    <div v-if="dataValue.order_type === 'Buy'" class="buy-btn-wrp">
                                        <button @click="cancelOrder" class="buy-btn get-started-btn3">Yes, cancel it</button>
                                    </div>
                                    <div v-else class="buy-btn-wrp">
                                        <button @click="cancelOrder" class="sell-btn get-started-btn3">Yes, cancel it</button>
                                    </div>
                                    <div class="sell-btn-wrp"><a href="javascript:void(0)" class="cancel-btn get-started-btn3" @click="close">NO</a>
                                    </div>
                                </div>
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
    name: "OrderConfirm",
    props: ['values', 'dataValue'],
    methods: {
        close() {
            this.$parent.editOrder(this.dataValue.order_id);
        },
        cancelOrder() {
            if (this.dataValue !== null || this.dataValue !== undefined) {
                const data = this.dataValue;
                data['is_cancel_order'] = true;
                axios.post('/api/order', data).then(response => {
                    this.close();
                }).catch(error => {
                    this.errors.push(error.response.data.message)
                });
            }
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
