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
                        <div class="alert alert-danger" v-if="errors.length">
                            <ul class="mb-0">
                                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="number" v-model="mobile" name="mobile" id="mobile" class="form-control">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" v-model="password" name="password" id="password"
                                   class="form-control">
                            <a @click="showForgotPasswordModal" class="forgot-password-link">Forgot password?</a>
                        </div>
                        <button class="login-page-btn btn btn-block login-btn">Login</button>
                        <hr/>
                        <div class="popup-box">
                            <a @click="LoginWithOtp" class="button btn btn-block login-btn2">Login with OTP</a>
                        </div>
                        <!-- <input name="login" id="login" class="btn btn-block login-btn2" type="button" onclick="openForm()" value="Login with OTP"> -->
                    </form>
                    <p class="login-wrapper-footer-text">New User?
                        <router-link to="/register" class="text-reset1">Register</router-link>
                    </p>
                    <ForgotPassword :from_where="login" v-show="isForgotPasswordVisible"
                                    @close="closeForgotPasswordModal"/>

                    <VerifyOtp :mobile="mobile" :from_where="login" v-show="isVerifyOtpVisible"
                               @close="closeVerifyOtpModal"/>

                    <NewPassword :mobile="mobile" v-show="isNewPasswordVisible" @close="closeNewPasswordModal"/>

                    <ConfirmationPopup :from_where="login" v-show="isConfirmationVisible"
                                       @close="closeConfirmationModal"/>

                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="assets/img/logingif.gif" alt="login image" class="login-img">
            </div>
        </div>
    </div>
</template>

<script>
import ForgotPassword from "./ForgotPassword.vue";
import VerifyOtp from "./VerifyOtp.vue";
import NewPassword from "./NewPassword.vue";
import ConfirmationPopup from "./ConfirmationPopup.vue";
import { required } from "vuelidate/lib/validators";

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
            errors: [],
        }
    },
    validations: {
        mobile: { required },
        password: { required }
    },
    watch: {
        'errors': function (val) {
            if(val.length){
                setTimeout(function (){

                }, 500);
            }
        }
    },
    methods: {
        showForgotPasswordModal() {
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
            this.errors = [];
            if (!this.mobile) {
                this.errors.push('Mobile is required.');
            }
            if (!this.password) {
                this.errors.push('Password is required.');
            }

            if (!this.errors.length) {
                const data = {
                    mobile: this.mobile,
                    password: this.password
                };

                axios.post('api/login', data).then(response => {
                    if(response.data.responseCode === 200 && 'auth_token' in response.data.data.user){
                        // this.$session.start()
                        // this.$session.set('auth_token', response.data.data.user.auth_token);
                        let userObj = JSON.stringify(response.data.data.user)
                        localStorage.setItem('userObj', userObj);
                        this.$router.push('/');
                    } else {
                        this.$router.go(this.$router.currentRoute);
                    }
                }).catch(error => {
                    this.errors.push(error.response.data.message)
                });
            }
        }
    }
}
</script>

<style scoped>
#visa {
    margin: 20px auto;
    max-width: 700px;
    margin-bottom: 28px;
}

label {
    display: block;
    margin: 20px 0 10px;
}

span {
    padding-top: 0px;
    margin-top: 0px;
    font-size: 12px;
    color: red;
}

input {
    font-size: 30px;
    border: 1px double rgb(102, 97, 96);
    border-radius: 4px;
}
</style>
