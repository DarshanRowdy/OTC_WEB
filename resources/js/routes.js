import Vue from 'vue';
import VueRouter from "vue-router";

import auth from './middlewares/auth.js';
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
            component: Home,
            meta: {
                middleware: auth,
            }

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
        },
        {
            path: '/logout',
            beforeEnter(to, from, next) {
                let userObj = localStorage.removeItem('userObj');
                if(userObj === undefined || userObj === null){
                    next('/login');
                } else {
                    next();
                }
            },
        }
    ]
});

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;
    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({...context, next: nextMiddleware});
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({...context, next: nextMiddleware});
    }
    return next();
});

export default router;
