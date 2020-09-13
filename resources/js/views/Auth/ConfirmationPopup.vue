<template>
    <!-- OTP Popup start -->
    <div>
        <transition name="Confirmation-model">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="otc-heading">OTC<span>STOX</span></h2>
                                <button type="button" class="btn-close" @click="close"> x</button>
                            </div>
                            <div class="modal-body text-center">
                                <h2 class="">Congratulations!</h2>
                                <p v-if="from_where = 'login'"><strong>Password Reset Successfully</strong></p>
                                <p v-else class="no-margin">OTP Verified Successfully</p>
                                <p class="resend-link margin-bottom-30 display-inline-block">Please Login to Trade</p>
                                <router-link class="btn btn-block login-btn" to="/login">Login</router-link>
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
    name: "ConfirmationPopup",
    props: ['from_where'],
    methods: {
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
