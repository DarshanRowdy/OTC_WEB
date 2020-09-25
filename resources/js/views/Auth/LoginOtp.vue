<template>
    <div>
        <transition name="login-with-otp">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="otc-heading">OTC<span>STOX</span></h2>
                                <button type="button" class="btn-close" @click="closeSendOtpModal"> x</button>
                            </div>
                            <div class="modal-body">
                                <h2 class="login-title">LOG IN With OTP</h2>
                                <div class="alert alert-danger" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </div>
                                <form v-on:submit.prevent="sendVerifyOtp" class="popup-form">
                                    <input v-model="mobile" type="text" class="form-control"
                                           placeholder="Enter 10 Digit Mobile Number">
                                    <button class="btn btn-block login-btn" type="submit">Continue</button>
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
import VerifyOtp from "./VerifyOtp.vue";

export default {
    name: "LoginOtp",
    props: ['app'],
    components: {
        VerifyOtp
    },
    data() {
        return {
            mobile: '',
            login_otp: 'login_otp',
            isSendOtpVisible: true,
            isVerifyOtpVisible: false,
            errors: []
        }
    },
    methods: {
        showSendOtpModal() {
            this.isSendOtpVisible = true;
        },
        closeSendOtpModal() {
            this.isSendOtpVisible = false;
        },
        showVerifyOtpModal() {
            this.isVerifyOtpVisible = true;
        },
        closeVerifyOtpModal() {
            this.isVerifyOtpVisible = false;
        },
        sendVerifyOtp() {
            this.errors = [];
            if (!this.mobile) {
                this.errors.push('Mobile is required.');
            }

            if (!this.errors.length) {
                const data = {
                    mobile: this.mobile
                };

                axios.post('/api/send-otp', data).then(response => {
                    alert(response.data.message);
                }).catch(error => {
                    this.errors.push(error.response.data.message)
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
