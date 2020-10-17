import "./bootstrap"
import Vue from "vue"
import Vuelidate from "vuelidate";
import { store } from "./stores";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import VueSession from 'vue-session';
import $ from 'jquery';

Vue.use(BootstrapVue)
Vue.use(Vuelidate);
Vue.use(VueSession)


//Route Information from Vue Router
import Route from '@/js/routes.js'

// Component File
import App from '@/js/views/App'

Vue.component('spinner', require('vue-simple-spinner'));

const app = new Vue({
    el: "#app",
    BootstrapVue,
    router: Route,
    store,
    render: h => h(App)
});

export default app;
