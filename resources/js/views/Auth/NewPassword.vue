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
                                <button type="button" class="btn-close" @click="close"> x</button>
                            </div>
                            <div class="modal-body">
                                <h2 class="">Enter Password</h2>
                                <div class="alert alert-danger" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </div>
                                <form v-on:submit.prevent="sendNewPassword" class="popup-form">
                                    <input type="text" v-model="password" class="form-control"
                                           placeholder="Enter New Password">
                                    <input type="text" v-model="confirm_password" class="form-control"
                                           placeholder="Confirm Password">
                                    <button type="submit" class="btn btn-block login-btn">Reset</button>
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
            errors: []
        }
    },
    methods: {
        sendNewPassword() {
            // this.$parent.showConfirmation();
            if (!this.password) {
                this.errors.push('Password is required.');
            }
            if (!this.confirm_password) {
                this.errors.push('Confirm Password is required.');
            }
            if (!this.mobile) {
                this.errors.push('Mobile Password is required.');
            }

            if (!this.errors.length) {
                const data = {
                    mobile: this.mobile,
                    password: this.password
                };
                axios.post('api/change-password', data).then(response => {
                    this.$parent.showConfirmationModal();
                }).catch(error => {
                    this.errors.push(error.response.data.message)
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
