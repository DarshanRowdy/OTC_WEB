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
                    <p v-if="errors" class="text-danger">{{ errors }}</p>
                    <form v-on:submit.prevent="onSubmit">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" v-model="name" @keypress="isLetter($event)" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="number" name="mobile" v-model="mobile" id="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" v-model="email" id="email" class="form-control">
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
                        <div class="form-group mb-4">
                            <input type="checkbox" name="is_accepted" v-model="is_accepted"
                            id="is_accepted">
                            <label for="is_accepted">I accept the
                                <a target="_blank" href="https://www.otccapital.in/terms-and-conditions"
                                   class="text-reset1">Terms and Conditions</a>
                            </label>
                        </div>
                        <div class="popup-box">
<!--                            <button class="button btn btn-block login-btn" type="submit">Sign Up</button>-->
                            <VueLoadingButton
                                aria-label="Register"
                                class="button btn btn-block login-btn"
                                type="submit"
                                :loading="isLoading"
                                style="line-height: 1.5"
                            >Sign Up</VueLoadingButton>
                        </div>
                    </form>
                        <!-- OTP Popup start -->
                        <SendOtp :mobile="mobile" v-show="isSendOtpVisible" @close="closeSendOtpModal" />
                        <!-- OTP Popup end -->

                        <VerifyOtp :mobile="mobile" :from_where="register" v-show="isSendVerifyOtp" @close="closeSendVerifyOtp" />

                        <ConfirmationPopup v-show="isConfirmation" :from_where="register" @close="closeConfirmation" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SendOtp from "./SendOtp.vue";
import VerifyOtp from "./VerifyOtp.vue";
import ConfirmationPopup from "./ConfirmationPopup.vue";
import VueLoadingButton from "vue-loading-button";

export default {
    name: "Register",
    components: {
        SendOtp,
        VerifyOtp,
        ConfirmationPopup,
        VueLoadingButton
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
            errors: '',
            isLoading: false,
            reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            isSendOtpVisible: false,
            isSendVerifyOtp: false,
            isConfirmation: false,
            is_accepted: false
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
        isLetter(e) {
            let char = String.fromCharCode(e.keyCode);
            if (/^[A-Za-z ]+$/.test(char)) return true;
            else e.preventDefault();
        },
        onSubmit() {
            this.isLoading = true;
            this.errors = '';
            if (!this.name) {
                this.errors = 'Name is required.';
                this.isLoading = false;
                return false;
            }
            if (!this.mobile) {
                this.errors = 'Mobile is required.';
                this.isLoading = false;
                return false;
            }
            if (this.mobile.length > 10 || this.mobile.length < 10) {
                this.errors = 'Enter 10 digit mobile number.';
                this.isLoading = false;
                return false;
            }
            if (!this.email) {
                this.errors = 'Email is required.';
                this.isLoading = false;
                return false;
            }
            if (!this.reg.test(this.email)) {
                this.errors = 'Please enter valid Email.';
                this.isLoading = false;
                return false;
            }
            if (!this.password) {
                this.errors = 'Password is required.';
                this.isLoading = false;
                return false;
            }
            if (this.password.length < 6) {
                this.errors = 'Password must be at least 6 character.';
                this.isLoading = false;
                return false;
            }
            if (!this.confirm_password) {
                this.errors = 'Confirm Password is required.';
                this.isLoading = false;
                return false;
            }
            if (this.password !== this.confirm_password) {
                this.errors = 'Confirm Password not matched.';
                this.isLoading = false;
                return false;
            }
            if(this.is_accepted === false){
                this.errors = 'Kindly read and accept the Terms and Conditions.';
                this.isLoading = false;
                return false;
            }

            if (this.errors === '') {
                const data = {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    password: this.password,
                    is_accepted: this.is_accepted
                };

                axios.post('/api/registration', data).then(response => {
                    this.isLoading = false;
                    this.isSendOtpVisible = true;
                }).catch(error => {
                    this.isLoading = false;
                    this.errors = error.response.data.message;
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
