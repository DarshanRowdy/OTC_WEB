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
                                    <a href="javascript:void(0)" class="close" @click="close"> x</a>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p>You are about to cancel {{dataValue.open_qty}} open quantity, Ary you sure you want to cancel this order?</p>
                                <div class="buy-sell-btn d-flex align-items-center margin-top-30 margin-bottom-20">
                                    <div v-if="dataValue.order_type === 'BUY'" class="buy-btn-wrp">
                                        <VueLoadingButton
                                            aria-label="Cancel"
                                            @click.native="cancelOrder"
                                            class="buy-btn get-started-btn3"
                                            :loading="isLoading"
                                            style="font-size: 100%;"
                                        >Yes, cancel it</VueLoadingButton>
                                    <!--<button @click="cancelOrder" class="sell-btn get-started-btn3">Yes, cancel it</button>-->
                                    </div>
                                    <div v-else class="buy-btn-wrp">
                                        <VueLoadingButton
                                            aria-label="Cancel"
                                            @click.native="cancelOrder"
                                            class="sell-btn get-started-btn3"
                                            type="submit"
                                            style="font-size: 100%;"
                                            :loading="isLoading"
                                        >Yes, cancel it</VueLoadingButton>
<!--                                        <button @click="cancelOrder" class="sell-btn get-started-btn3">Yes, cancel it</button>-->
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
import VueLoadingButton from "vue-loading-button";
export default {
    name: "OrderConfirm",
    props: ['values', 'dataValue'],
    components: {
        VueLoadingButton
    },
    data() {
        return {
            errors: [],
            isLoading: false,
        }
    },
    methods: {
        close() {
            this.$parent.editOrder(this.dataValue.order_id, 'order_reload');
        },
        cancelOrder() {
            this.isLoading = true;
            if (this.dataValue !== null || this.dataValue !== undefined) {
                const data = this.dataValue;
                data['is_cancel_order'] = true;
                let userObj = JSON.parse(localStorage.getItem('userObj'));
                let config = {
                    headers: {
                        AUTH_TOKEN : userObj.auth_token
                    }
                }
                axios.post('/api/order', data, config).then(response => {
                    this.isLoading = false;
                    this.close();
                }).catch(error => {
                    this.isLoading = false;
                    if(error.response.data.responseCode === 401){
                        localStorage.removeItem('userObj');
                        this.$session.set('auth_error', error.response.data.message);
                        this.$router.push("/login").catch(()=>{});
                    } else {
                        this.errors = error.response.data.message;
                    }
                });
            }
        }
    }
}
</script>

<style scoped>
button {
    font-size: 100%;
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
