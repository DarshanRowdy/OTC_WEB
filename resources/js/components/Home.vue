<template>
    <div>

        <h3 class="user-info">Hi, {{userObj.user_name}}</h3>
        <hr>
        <section id="notice">
            <div class="section-header">
                <h2>Announcements</h2></div>
            <ul>
                <li v-for="announcement in announcements">
                    <i class="las la-bullhorn"></i>
                    {{ announcement.announcement_list }}
                </li>
            </ul>
            <hr>

        </section>


        <!-- ======= dashcard Section ======= -->
        <section id="dashcard">


            <div class="row">

                <div class="col-lg-4">
                    <div class="stages">
                        <h3>
                            Market Hours
                        </h3>
                        <div class="icon"><i class="las la-clock"></i></div>
                        <div class="data">
                            <h4>Mon-Sat</h4>
                            <h4>9:00 AM to 6:00 PM</h4></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <h3>
                            Active Scripts
                        </h3>
                        <div class="icon"><i class="las la-bars"></i></div>
                        <div class="data">
                            <h4>{{ active_script_count }}</h4></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <h3>
                            Lot Size
                        </h3>
                        <div class="icon"><i class="las la-bars"></i></div>
                        <div class="data">
                            <h4>No minimum lot size from our side</h4></div>
                    </div>
                </div>


            </div>
            <!--  </div>-->

        </section><!-- End How it works Section -->


        <!-- ======= How it Works Section ======= -->
        <section id="howitworks">

            <div class="section-header">
                <h2>HOW IT WORKS</h2>
            </div>
            <!-- <div class="owl-carousel testimonials-carousel">-->
            <div class="row">

                <div class="col-lg-4">
                    <div class="stages">
                        <p>
                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                            1) Place Buy or Sell order during Market Hours
                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                        </p>
                        <div class="icon"><i class="las la-shopping-cart" style="color: #15D295;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <p>
                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                            2) Once your order is matched, we will confirm the deal from both parties
                            over the phone before initiating the settlement process.
                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                        </p>
                        <div class="icon"><i class="las la-handshake" style="color: #15D295;"></i></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <p>
                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                            3) Once the deal is locked, we will send the invoice to buyer. Buyer will
                            have to make payment to company’s account as per the invoice to initiate the
                            settlement.
                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                        </p>
                        <div class="icon"><i class="las la-credit-card" style="color: #15D295;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <p>
                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                            4) Once we receive the payment from buyer, We will intimate the seller to
                            transfer the shares into company’s account as per deal agreement.
                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                        </p>
                        <div class="icon"><i class="las la-rupee-sign" style="color: #15D295;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <p>
                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                            5) Once seller transfers the agreed quantity of shares.

                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                        </p>
                        <div class="icon"><i class="las la-file-alt" style="color: #15D295;"></i></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stages">
                        <p>
                            <img alt="" class="quote-sign-left" src="assets/img/quote-sign-left.png">
                            6) <b> We will settle the trade.</b> (By transferring shares to buyer and
                            funds to seller.)

                            <img alt="" class="quote-sign-right" src="assets/img/quote-sign-right.png">
                        </p>
                        <div class="icon"><i class="las la-exchange-alt" style="color: #15D295;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--  </div>-->

        </section><!-- End How it works Section -->


        <hr>
        <section id="notice">
            <div class="section-header">
                <h2>Notes</h2></div>
            <ul>
                <li><i class="las la-question-circle"></i>We want to make settlement process faster, How
                    can we do that?
                </li>
                <li><i class="las la-hand-point-right"></i>Please add our Bank and Demat account as
                    Beneficiary / Trusted account for faster transaction from your side.
                </li>
            </ul>
            <hr>
            <h4 style="color:#46454d"><b>Bank A/C Details</b></h4>
            <section id="fact1" style="margin-top: -40px;">
                <div class="row counters">
                    <div class="col-lg-12 col-12 text-left">
                        <span data-toggle="counter-up">OTC Capital Services Private Limited</span>
                        <p>Beneficiary Name</p>
                    </div>

                    <div class="col-lg-12 col-12 text-left">
                        <span data-toggle="counter-up">HDFC Bank Ltd</span>
                        <p>Bank Name</p>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">50200049544149</span>
                        <p>A/C Number</p>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">HDFC0000146</span>
                        <p>IFSC Code</p>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">Current A/C</span>
                        <p>A/C Type</p>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">AADCO2190H</span>
                        <p>PAN</p>
                    </div>

                </div>
                <hr>

            </section>


            <h4 style="color:#46454d; margin-top: -40px;"><b>Demat A/C Details</b></h4>

            <section id="fact1" style="margin-top: -40px;">
                <div class="row counters">
                    <div class="col-lg-12 col-12 text-left">
                        <span data-toggle="counter-up">OTC Capital Services Private Limited</span>
                        <p>Client Name</p>
                    </div>

                    <div class="col-lg-12 col-12 text-left">
                        <span data-toggle="counter-up">Stockholding Corporation of India Limited</span>
                        <p>DP Name</p>
                    </div>

                    <div class="col-lg-12 col-12 text-left">
                        <span data-toggle="counter-up" style="text-decoration: underline;">NSDL</span>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">IN301330</span>
                        <p>DP ID</p>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">40369677</span>
                        <p>Client ID</p>
                    </div>

                    <div class="col-lg-12 col-12 text-left">
                        <span data-toggle="counter-up" style="text-decoration: underline;">CDSL</span>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">16010100</span>
                        <p>DP ID</p>
                    </div>

                    <div class="col-lg-6 col-6 text-left">
                        <span data-toggle="counter-up">00468547</span>
                        <p>Client ID</p>
                    </div>
                </div>
                <hr>
            </section>
        </section>
    </div>
</template>

<script>

export default {
    name: "Home",
    components: {
    },
    data() {
        return {
            errors: '',
            announcements: [],
            userObj : {},
            active_script_count : 0,
            config : {}
        }
    },
    methods: {
        getAnnouncement() {
            axios.get('/api/announcements', this.config).then(response => {
                this.announcements = response.data.data.announcements;
                window.scrollTo(0,0);
            }).catch(error => {
                if(error.response.data.responseCode === 401){
                    this.$session.set('auth_error', error.response.data.message);
                    localStorage.removeItem('userObj');
                    this.$router.push("/login").catch(()=>{});
                } else {
                    this.errors = error.response.data.message;
                }
            });
        },
        getScript(){
            axios.get('/api/scripts?is_active_count=true', this.config).then(response => {
                this.active_script_count = response.data.data.scripts;
            }).catch(error => {
                if(error.response.data.responseCode === 401){
                    localStorage.removeItem('userObj');
                    this.$session.set('auth_error', error.response.data.message);
                    this.$router.push("/login").catch(()=>{});
                } else {
                    this.errors = error.response.data.message;
                }
            });
        }
    },
    created() {
        this.userObj = JSON.parse(localStorage.getItem('userObj'));
        this.config = {
            headers: {
                AUTH_TOKEN : this.userObj.auth_token
            }
        }
    },
    beforeMount() {
        this.getAnnouncement();
        this.getScript();
        this.$store.commit('SET_LAYOUT', 'master-app');
    }
}
</script>

<style scoped>
.user-info{
    font-family: 'Open Sans';
    color: #45464d;
    size: 20px;
}
</style>
