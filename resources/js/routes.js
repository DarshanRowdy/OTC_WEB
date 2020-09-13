import Vue from 'vue';
import VueRouter from "vue-router";

import Home from "@/js/views/Home";
import About from "@/js/views/About";
import Login from "@/js/views/Auth/Login";
import Register from "@/js/views/Auth/Register";
import LoginOtp from "./views/Auth/LoginOtp";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/about',
            name: 'About',
            component: About
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/register',
            component: Register,
            name: 'Register'
        },
        {
            path: '/login-with-otp',
            component: LoginOtp,
            name: 'LoginOtp'
        }
    ]
});

export default router;
