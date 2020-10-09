<template>
    <div>
        <transition name="forgot-password">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="otc-heading">OTC<span>STOX</span></h2>
                                <a href="javascript:void(0)" class="btn-close" @click="close"> x</a>
                            </div>
                            <div class="modal-body">
                                <h2 class="login-title" v-if="from_where !== 'login_with_otp'">FORGOT PASSWORD?</h2>
                                <h2 class="login-title" v-else>LOG IN WITH OTP</h2>
                                <p class="text-danger" v-if="errors">{{ errors }}</p>
                                <form v-on:submit.prevent="sendVerifyOtp" class="popup-form">
                                    <input v-model="mobile" type="text" class="form-control" placeholder="Enter 10 Digit Mobile Number">
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

export default {
    name: "ForgotPassword",
    props: ['from_where'],
    data() {
        return {
            mobile: '',
            errors: ''
        }
    },
    methods: {
        sendVerifyOtp() {
            this.errors = '';

            if (!this.mobile) {
                this.errors = 'Mobile is required.';
                return false;
            }

            if (this.mobile.length > 10 || this.mobile.length < 10) {
                this.errors = 'Enter 10 digit mobile number.';
                return false;
            }

            if(this.errors === ''){
                const data = {
                    mobile: this.mobile,
                };
                axios.post('/api/send-otp', data).then(response => {
                    this.$parent.showVerifyOtpModal(this.mobile, this.from_where);
                }).catch(error => {
                    this.errors = error.response.data.message;
                });
            }
        },
        close() {
            this.$emit('close');
        },
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
