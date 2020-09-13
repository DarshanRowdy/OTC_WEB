<template>
    <!-- OTP Popup start -->
    <div>
        <transition name="verify-otp-model">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="otc-heading">OTC<span>STOX</span></h2>
                                <button type="button" class="btn-close" @click="close"> x </button>
                            </div>
                            <div class="modal-body">
                                <h2 class="">Enter 4 digit code</h2>
                                <div class="alert alert-danger" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </div>
                                <p>We send an SMS with confirmation code to {{mobile}}</p>
                                <a v-if="from_where === 'register'" @click="resendOtp" class="resend-link margin-bottom-30 display-inline-block">Resend Code</a>
                                <form v-on:submit.prevent="sendConfirmation" class="popup-form">
                                    <input type="text" v-model="otp" class="form-control" placeholder="Enter OTP">
                                    <button type="submit" class="btn btn-block login-btn">Verify</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <!-- OTP Popup end -->
</template>

<script>
export default {
    name: "VerifyOtp",
    props: ['mobile', 'from_where'],
    data() {
        return {
            otp: '',
            errors: []
        }
    },
    methods: {
        sendConfirmation() {
            // this.$parent.showConfirmation();
            if (!this.otp) {
                this.errors.push('OTP is required.');
            }

            var is_login_with_otp = 0;
            if(this.from_where === 'login_from_otp'){
                is_login_with_otp = 1;
            }

            const data = {
                mobile: this.mobile,
                otp: this.otp,
                is_login_with_otp: is_login_with_otp
            };
            axios.post('api/verify-otp', data).then(response => {
                if(this.from_where === 'login'){
                    this.$parent.showNewPasswordModal(this.mobile);
                } else if(this.from_were === 'register') {
                    this.$parent.showConfirmation();
                } else if(this.from_where === 'login_with_otp') {
                    alert('login with OTP success');
                }
            }).catch(error => {
                this.errors.push(error.response.data.message)
            });
        },
        resendOtp() {
            const data = {
                mobile: this.mobile,
            };
            axios.post('api/send-otp', data).then(response => {
                alert('OTP Re-send successfully');
            }).catch(error => {
                this.errors.push(error.response.data.message)
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
