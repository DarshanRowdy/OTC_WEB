<template>
    <!-- OTP Popup start -->
    <div>
        <transition name="new-model">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="otc-heading">OTC<span>STOX</span></h2>
                                <a class="btn-close" href="javascript:void(0)" @click="close"> x</a>
                            </div>
                            <div class="modal-body">
                                <p v-if="errors" class="text-danger">{{ errors }}</p>
                                <h2 class="">Enter Password</h2>
                                <form class="popup-form" v-on:submit.prevent="sendNewPassword">
                                    <input v-model="password" class="form-control" placeholder="Enter New Password"
                                           type="password">
                                    <input v-model="confirm_password" class="form-control"
                                           placeholder="Confirm Password"
                                           type="password">
                                    <button class="btn btn-block login-btn" type="submit">Reset</button>
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
    name: "NewPassword",
    props: ['mobile'],
    data() {
        return {
            password: '',
            confirm_password: '',
            errors: ''
        }
    },
    methods: {
        sendNewPassword() {
            this.errors = '';
            if (!this.password) {
                this.errors = 'Password is required.';
                return false;
            }

            if (this.password.length < 6) {
                this.errors = 'Password must be at least 6 character.';
                return false;
            }

            if (this.confirm_password !== this.password) {
                this.errors = 'Confirm Password not matched.';
                return false;
            }

            if (!this.confirm_password) {
                this.errors = 'Confirm Password is required.';
                return false;
            }

            if (!this.mobile) {
                this.errors = 'Mobile is required.';
                return false;
            }

            if (this.errors === '') {
                const data = {
                    mobile: this.mobile,
                    password: this.password
                };
                axios.post('/api/change-password', data).then(response => {
                    this.$parent.showConfirmationModal();
                }).catch(error => {
                    this.errors = error.response.data.message;
                });
            }
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
