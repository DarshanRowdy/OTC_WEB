import "./bootstrap"
import Vue from "vue"
// import Vuex from "vuex"
// import vuetify from '@/js/plugins/vuetify'
import Vuelidate from "vuelidate";
import { store } from "./stores";
import VueSession from 'vue-session'

Vue.use(Vuelidate);
Vue.use(VueSession)
// Vue.use(Vuex);

//Route Information from Vue Router
import Route from '@/js/routes.js'

// Component File
import App from '@/js/views/App'

Vue.component('spinner', require('vue-simple-spinner'));
Vue.component('auto-logout', require('./components/AutoLogout.vue').default);

const app = new Vue({
    el: "#app",
    // vuetify,
    router: Route,
    store,
    render: h => h(App)
});

export default app;
