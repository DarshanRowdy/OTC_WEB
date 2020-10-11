<template>
    <div>
        <header class="header-dashboard" id="header">
            <div class="container container-dash-header">
                <div class="header-dashboard-wrp">
                    <div class="justify-content-center">
                        <div class="d-flex align-items-center">

                            <div class="header-logo mr-auto">
                                <h1 class="logo"><a href="https://www.otccapital.in">OTC<span>STOX</span></a></h1>
                                <!-- Uncomment below if you prefer to use an image logo -->
                                <!-- <a href="index.html" class="logo mr-auto"><img src="https://media.glassdoor.com/lst2x/519241/hdb-financial-services-office.jpg" alt="" class="img-fluid"></a>-->
                            </div>

                            <div class="header-nav-list mr-auto">
                                <nav class="nav-menu d-none d-lg-block">
                                    <ul>

                                        <li>
                                            <router-link to="/desk">Desk</router-link>
                                        </li>
                                        <li>
                                            <router-link to="/orders">Orders</router-link>
                                        </li>

                                    </ul>
                                </nav><!-- .nav-menu -->
                            </div>

                            <div class="header-right">
                                <a href="https://www.otccapital.in"><i class='las la-home'></i> <span>Home</span></a>
                                <router-link class="margin-left-20" to="/logout">
                                    <i class='las la-sign-out-alt'></i> <span>Log out</span></router-link>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="header-dash-mobile">
            <div class="justify-content-center">
                <div class="d-flex align-items-center">
                    <div class="dash-mob-navlist mr-auto">
                        <ul class="d-flex align-items-center">
                            <li>
                                <router-link to="/list"><i class='las la-bars'></i></router-link>
                            </li>
                            <li>
                                <router-link to="/desk"><i class='lab la-hornbill'></i></router-link>
                            </li>
                            <li>
                                <router-link to="/orders"><i class='las la-book-open'></i></router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="header-right">
                        <a href="https://www.otccapital.in"><i class='las la-home'></i></a>
                        <router-link class="margin-left-10" to="/logout"><i
                            class='las la-sign-out-alt'></i></router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MasterHeader"
}
</script>

<style scoped>
@media screen and (max-width: 1023px) {
    .dashboard-right {
        padding: 0;
    }
}
</style>
