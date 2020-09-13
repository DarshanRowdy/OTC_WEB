<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="assets/img/signupgif.gif" alt="login image" class="login-img">
            </div>
            <div class="col-sm-6 login-section-wrapper">
                <div class="brand-wrapper">
                    <h2 class="otc-heading">OTC<span>STOX</span></h2>
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title">WELCOME</h1>
                    <form v-on:submit.prevent="onSubmit">
                        <div class="alert alert-danger" v-if="errors.length">
                            <ul class="mb-0">
                                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" v-model="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="number" name="mobile" v-model="mobile" id="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" v-model="email" id="email" class="form-control">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" v-model="password" id="password"
                                   class="form-control">
                        </div>
                        <div class="form-group mb-4">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm_password" v-model="confirm_password"
                                   id="confirm-password" class="form-control">
                        </div>
                        <div class="popup-box">
                            <button class="button btn btn-block login-btn" type="submit">Sign Up</button>
                        </div>
                    </form>
                        <!-- OTP Popup start -->
                        <SendOtp :mobile="mobile" v-show="isSendOtpVisible" @close="closeSendOtpModal" />
                        <!-- OTP Popup end -->

                        <VerifyOtp :mobile="mobile" :from_were="register" v-show="isSendVerifyOtp" @close="closeSendVerifyOtp" />

                        <ConfirmationPopup v-show="isConfirmation" @close="closeConfirmation" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SendOtp from "./SendOtp.vue";
import VerifyOtp from "./VerifyOtp.vue";
import ConfirmationPopup from "./ConfirmationPopup.vue";

export default {
    name: "Register",
    components: {
        SendOtp,
        VerifyOtp,
        ConfirmationPopup
    },
    props: {
        app
    },
    data() {
        return {
            register: 'register',
            name: '',
            email: '',
            mobile: '',
            password: '',
            confirm_password: '',
            errors: [],
            isSendOtpVisible: false,
            isSendVerifyOtp: false,
            isConfirmation: false
        }
    },
    methods: {
        showSendOtpModal() {
            this.isSendOtpVisible = true;
        },
        closeSendOtpModal() {
            this.isSendOtpVisible = false;
        },
        sendVerifyOtp(){
            this.isSendOtpVisible = false;
            this.isSendVerifyOtp = true;
        },
        closeSendVerifyOtp() {
            this.isSendVerifyOtp = false;
        },
        showConfirmation(){
            this.isSendVerifyOtp = false;
            this.isConfirmation = true;
        },
        closeConfirmation() {
            this.isConfirmation = false;
        },
        onSubmit() {
            this.errors = [];
            if (!this.name) {
                this.errors.push('Name is required.');
            }
            if (!this.email) {
                this.errors.push('Email is required.');
            }
            if (!this.mobile) {
                this.errors.push('Mobile is required.');
            }
            if (!this.password) {
                this.errors.push('Password is required.');
            }
            if (!this.confirm_password) {
                this.errors.push('Confirm Password is required.');
            }
            if (this.password !== this.confirm_password) {
                this.errors.push('Password do not match.')
            }

            if (!this.errors.length) {
                const data = {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    password: this.password
                };

                axios.post('api/registration', data).then(response => {
                    this.isSendOtpVisible = true;
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
