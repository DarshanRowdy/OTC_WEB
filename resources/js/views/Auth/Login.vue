<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 login-section-wrapper">
                <div class="brand-wrapper">
                    <h2 class="otc-heading">OTC<span>STOX</span></h2>
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title">LOG IN</h1>
                    <form @submit.prevent="onSubmit">
                        <p v-if="errors" class="text-danger">{{ errors }}</p>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input id="mobile" v-model="mobile" class="form-control" name="mobile" type="number">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input id="password" v-model="password" class="form-control" name="password"
                                   type="password">
                            <a class="forgot-password-link"
                               href="javascript:void(0)" @click="showForgotPasswordModal">Forgot
                                password?</a>
                        </div>
                        <button class="login-page-btn btn btn-block login-btn">Login</button>
                        <hr/>
                        <div class="popup-box">
                            <button class="button btn btn-block login-btn2" type="button" @click="LoginWithOtp">Login
                                with OTP
                            </button>
                        </div>
                        <!-- <input name="login" id="login" class="btn btn-block login-btn2" type="button" onclick="openForm()" value="Login with OTP"> -->
                    </form>
                    <p class="login-wrapper-footer-text">New User?
                        <router-link class="text-reset1" to="/register">Register here</router-link>
                    </p>
                    <ForgotPassword v-show="isForgotPasswordVisible" :from_where="login"
                                    @close="closeForgotPasswordModal"/>

                    <VerifyOtp v-show="isVerifyOtpVisible" :from_where="login" :mobile="mobile"
                               @close="closeVerifyOtpModal"/>

                    <NewPassword v-show="isNewPasswordVisible" :mobile="mobile" @close="closeNewPasswordModal"/>

                    <ConfirmationPopup v-show="isConfirmationVisible" :from_where="login"
                                       @close="closeConfirmationModal"/>

                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img alt="login image" class="login-img" src="assets/img/logingif.gif">
            </div>
        </div>
    </div>
</template>

<script>
import ForgotPassword from "./ForgotPassword.vue";
import VerifyOtp from "./VerifyOtp.vue";
import NewPassword from "./NewPassword.vue";
import ConfirmationPopup from "./ConfirmationPopup.vue";
import {required} from "vuelidate/lib/validators";

export default {
    name: "Login",
    props: ['app'],
    components: {
        ForgotPassword,
        VerifyOtp,
        NewPassword,
        ConfirmationPopup
    },
    data() {
        return {
            mobile: '',
            password: '',
            login: 'login',
            isForgotPasswordVisible: false,
            isVerifyOtpVisible: false,
            isNewPasswordVisible: false,
            isConfirmationVisible: false,
            errors: '',
        }
    },
    validations: {
        mobile: {required},
        password: {required}
    },
    watch: {
        'errors': function (val) {
            if (val.length) {
                setTimeout(function () {

                }, 500);
            }
        }
    },
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'simple-layout');
    },
    methods: {
        showForgotPasswordModal() {
            this.login = 'forgot_password';
            this.isForgotPasswordVisible = true;
        },
        closeForgotPasswordModal() {
            this.isForgotPasswordVisible = false;
        },
        showVerifyOtpModal(mobile, from_where) {
            this.isForgotPasswordVisible = false;
            this.mobile = mobile;
            this.from_where = from_where;
            this.isVerifyOtpVisible = true;
        },
        closeVerifyOtpModal() {
            this.isVerifyOtpVisible = false;
        },
        showNewPasswordModal(mobile) {
            this.isVerifyOtpVisible = false;
            this.mobile = mobile;
            this.isNewPasswordVisible = true;
        },
        closeNewPasswordModal() {
            this.isNewPasswordVisible = false;
        },
        showConfirmationModal() {
            this.isNewPasswordVisible = false;
            this.isConfirmationVisible = true;
        },
        closeConfirmationModal() {
            this.isConfirmationVisible = false;
        },
        LoginWithOtp() {
            this.login = 'login_with_otp';
            this.isForgotPasswordVisible = true;
        },
        onSubmit() {
            this.errors = '';
            if (!this.mobile) {
                this.errors = 'Mobile is required.';
                return false;
            }

            if (this.mobile.length > 10 || this.mobile.length < 10) {
                this.errors = 'Enter 10 digit mobile number.';
                return false
            }

            if (!this.password) {
                this.errors = 'Password is required.';
                return false;
            }

            /*if (this.password.length < 6) {
                this.errors = 'Password must be at least 6 character.';
                return false;
            }*/

            if (this.errors === '') {
                const data = {
                    mobile: this.mobile,
                    password: this.password
                };

                axios.post('/api/login', data).then(response => {
                    if (response.data.responseCode === 200 && 'auth_token' in response.data.data.user) {
                        let userObj = JSON.stringify(response.data.data.user)
                        localStorage.setItem('userObj', userObj);
                        this.$router.push('/desk');
                    } else {
                        this.$router.go(this.$router.currentRoute);
                    }
                }).catch(error => {
                    this.errors = error.response.data.message;
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
