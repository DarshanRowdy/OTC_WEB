<template>
    <div>
        <transition name="order-confirm">
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
                                <h3>Are you sure you want to {{ dataValue.order_type }}?</h3>
                                <div class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                                    <div class="buy-btn-wrp">
                                        <button @click="submitOrder" class="buy-btn get-started-btn3">CONFIRM</button>
                                    </div>
                                    <div class="sell-btn-wrp"><a class="cancel-btn get-started-btn3" @click="close">CANCEL</a>
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
            this.$emit('close');
        },
        submitOrder() {
            if (this.dataValue !== null || this.dataValue !== undefined) {
                axios.post('/api/order', this.dataValue).then(response => {
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
