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
                                <a href="javascript:void(0)" class="close" @click="close"> x</a>
                            </div>
                            <div class="modal-body">
                                <p v-if="errors" class="text-danger">{{ errors }}</p>
                                <p>We have sent an OTP to +91 {{mobile}}</p>
                                <h2 class="">Enter 4 digit OTP</h2>
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
            errors: ''
        }
    },
    methods: {
        sendConfirmation() {
            this.errors = '';
            if (!this.otp) {
                this.errors = 'OTP is required.';
                return false;
            }

            if(this.otp.length < 4 || this.otp.length > 4) {
                this.errors = 'Enter 4 digit OTP.';
                return false;
            }

            var is_login_with_otp = 0;
            if(this.from_where === 'login_with_otp'){
                is_login_with_otp = 1;
            }

            if(this.errors === ''){
                const data = {
                    mobile: this.mobile,
                    otp: this.otp,
                    is_login_with_otp: is_login_with_otp
                };
                axios.post('/api/verify-otp', data).then(response => {
                    if(this.from_where === 'forgot_password'){
                        this.$parent.showNewPasswordModal(this.mobile);
                    } else if(this.from_where === 'register') {
                        this.$parent.showConfirmation();
                    } else if(this.from_where === 'login_with_otp') {
                        let userObj = JSON.stringify(response.data.data.user)
                        localStorage.setItem('userObj', userObj);
                        this.$router.push('/desk');
                    }
                }).catch(error => {
                    this.errors = error.response.data.message;
                });
            }
        },
        resendOtp() {
            this.errors = '';

            const data = {
                mobile: this.mobile,
            };
            axios.post('/api/send-otp', data).then(response => {
                alert('OTP Re-send successfully');
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
