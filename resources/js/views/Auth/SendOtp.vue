<template>
    <!-- OTP Popup start -->
    <div>
        <transition name="send-otp-model">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="otc-heading">OTC<span>STOX</span></h2>
                                <a href="javascript:void(0)" class="close" @click="close">x</a>
                            </div>
                            <div class="modal-body">
                                <p v-if="errors" class="text-danger">{{ errors }}</p>
                                <h2 class="login-title">OTP Verification</h2>
                                <p>We will send an SMS with confirmation code to (+91) {{ mobile }} <span
                                    class="phone-number"></span>
                                </p>
<!--                                <form class="popup-form">-->
                                    <button @click="sendVerifyOtp" class="btn btn-block login-btn">Continue</button>
<!--                                </form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <!-- OTP Popup end -->

    <!-- OTP Confirmation popup start  -->
<!--    <VerifyOtp v-show="isSendVerifyOtp" @close="closeSendVerifyOtp" />-->
    <!-- OTP Confirmation popup end  -->
</template>

<script>
export default {
    name: "SendOtp",
    props: ['mobile'],
    data() {
        return {
            errors: ''
        }
    },
    methods: {
        sendVerifyOtp() {
            const data = {
                mobile: this.mobile,
            };
            axios.post('/api/send-otp', data).then(response => {
                this.$parent.sendVerifyOtp();
            }).catch(error => {
                this.errors = error.response.data.message;
            });
        },
        close() {
            this.$emit('close');
        },

    },
};
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
