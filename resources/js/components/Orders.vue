<template>
    <div>
        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </div>
        <div class="open-order-section margin-bottom-50">
            <div class="section-header">
                <h2>Orders</h2>
                <p>All Matched &amp; Open orders</p>
            </div>
            <table class="table table-hover order-custom-table" id="example1">
                <thead>
                <tr>
                    <th align='center'></th>
                    <th align='center' width="5px">Modify</th>
                    <th align='center'>Symbol</th>
                    <th align='center'>Type</th>
                    <th align='center'>Price</th>
                    <th align='center'>Qty (Matched/Total)</th>
                    <th align='center'>Lot</th>
                    <th align='center'>Avg Price</th>
                    <th align='center'>Delivered Qty</th>
                    <th align='center'>Order No</th>
                    <th align='center'>Time</th>

                </tr>
                </thead>
                <tbody>
                <tr class="odd gradeX">
                    <td align='center'></td>
                    <td align='center'><span style="float:left"><a href="#modify-popup"><i
                        class="las la-edit la-2x"></i></a></span></td>
                    <td align='center'>BIRA91</td>
                    <td align='center'>SELL</td>
                    <td align='right'>10000</td>
                    <td align='right'>1000/1000</td>
                    <td align='right'>1000</td>
                    <td align='right'>10000</td>
                    <td align='right'>10000</td>
                    <td align='center'>2000014512A</td>
                    <td align='center'>21/07/2020 14:02:02</td>

                </tr>

                </tbody>
            </table>
        </div>
        <div class="completed-order-section">
            <div class="section-header">
                <h2>Past Orders</h2>
                <p>All Completed &amp; Cancelled orders (Last 1 month)</p>
            </div>

            <table class="table table-hover order-custom-table" id="example2">
                <thead>
                <tr>
                    <th align='center'>Symbol</th>
                    <th align='center'>Type</th>
                    <th align='right'>Average Price</th>
                    <th align='right'>Delivered Qty</th>
                    <th align='center'>Order No</th>
                    <th align='center'>Time</th>
                </tr>
                </thead>
                <tbody>


                <tr class="odd gradeX">
                    <td align='center'>BIRA91</td>
                    <td align='center'>BUY</td>
                    <td align='right'>10000</td>
                    <td align='right'>1000</td>
                    <td align='center'>2000014512A</td>
                    <td align='center'>21/07/2020 14:02:02</td>
                </tr>


                </tbody>
            </table>


        </div>
    </div>
</template>

<script>

import ScriptLists from "../layouts/ScriptLists";
import MasterHeader from "../layouts/MasterHeader";
import $ from 'jquery'

export default {
    name: "Orders",
    components: {
        ScriptLists,
        MasterHeader
    },
    data() {
        return {
            errors: [],
            dataTable:null
        }
    },
    mounted() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    },
    beforeMount() {
        this.$store.commit('SET_LAYOUT', 'master-app');
    }
}
</script>

<style scoped>

</style>
