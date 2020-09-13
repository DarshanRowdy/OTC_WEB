import "./bootstrap"
import Vue from "vue"
import vuetify from '@/js/plugins/vuetify'

//Route Information from Vue Router
import Route from '@/js/routes.js'

// Component File
import App from '@/js/views/App'

Vue.component('spinner', require('vue-simple-spinner'));

const app = new Vue({
    el: "#app",
    vuetify,
    router: Route,
    render: h => h(App)
});

export default app;
