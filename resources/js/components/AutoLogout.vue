<template>
</template>

<script>
export default {
    name: "AutoLogout",
    data: function () {
        return {
            events: ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],
            warningTimer: null,
            logoutTimer: null
        }
    },
    mounted() {
        this.events.forEach(function (event){
            window.addEventListener(event, this.reserTimer);
        }, this);

        this.setTimers();
    },
    methods: {
        setTimers: function (){
            this.logoutTimer = setTimeout(this.logoutUser, 5 * 60 * 60 * 1000);
        },
        logoutUser: function () {
            let userObj = JSON.parse(localStorage.getItem('userObj'));
            if(userObj){
                let logoutUserObj = localStorage.removeItem('userObj');
                if(logoutUserObj === undefined || logoutUserObj === null){
                    alert('Please login again');
                    this.$router.go(this.$router.currentRoute);
                }
            }
        },
        reserTimer: function () {
            clearTimeout(this.warningTimer);
            this.setTimers();
        }
    }
}
</script>

<style scoped>

</style>
