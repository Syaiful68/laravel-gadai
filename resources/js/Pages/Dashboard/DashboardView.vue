<script setup>
import Layout from "../Layout/app.vue";
import AngsuranChart from "./partials/angsuranChart.vue";
import profitChart from "./partials/profitChart.vue";

const props = defineProps({
    angsuran: Object,
    profit: Object,
    cost_out: String,
    cost_in: String,
    nasabah: Number,
    incomplete: Number,
});

function fcurrency(value) {
    return Intl.NumberFormat().format(value);
}
</script>

<template>
    <Layout>
        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Dashboard</div>
                        <h2 class="page-title">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <!--  -->
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-secondary text-white avatar"
                                                    ><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                    <i
                                                        class="fa-solid fa-hand-holding-dollar"
                                                    ></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Pinjaman Uang
                                                </div>
                                                <div class="text-secondary">
                                                    Rp.
                                                    {{ fcurrency(cost_out) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-success text-white avatar"
                                                    ><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                    <i
                                                        class="fa-solid fa-sack-dollar"
                                                    ></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Profit Pinjaman
                                                </div>
                                                <div class="text-secondary">
                                                    Rp. {{ fcurrency(cost_in) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"
                                                    ><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                    <i
                                                        class="fa-solid fa-users"
                                                    ></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Nasabah
                                                </div>
                                                <div class="text-secondary">
                                                    {{ nasabah }} Orang
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-warning text-white avatar"
                                                    ><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                    <i
                                                        class="fa-solid fa-question"
                                                    ></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Belum Lunas
                                                </div>
                                                <div class="text-secondary">
                                                    {{ incomplete }} Orang
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <AngsuranChart :data="props.angsuran"></AngsuranChart>
                    </div>
                    <div class="col-12">
                        <profitChart :data="props.profit"></profitChart>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
