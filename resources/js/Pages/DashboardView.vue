<script setup>
//
import Layout from "../Pages/Layout/app.vue";
import { Line } from "vue-chartjs";

import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    TimeScale,
} from "chart.js";
import "chartjs-adapter-moment";
ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    TimeScale
);

const props = defineProps({
    data: Object,
    cost_out: String,
    cost_in: String,
    incomplete: Number,
    nasabah: Number,
});

const commisionData = props.data.map(function (i) {
    return i.total_comisi;
});

const labelCommision = props.data.map(function (m) {
    return m.month;
});

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}

const chartData = {
    labels: labelCommision,
    datasets: [
        {
            label: "Transaksi Angsuran",
            data: commisionData,
            backgroundColor: "#1f18ed",
        },
    ],
};
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        x: {
            type: "time",
            time: {
                unit: "month",
                displayFormat: {
                    month: "MMM",
                },
            },
        },
    },
};
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
                        <div class="card">
                            <div class="card-body" style="height: 300px">
                                <Line
                                    id="my-chart-id"
                                    :options="chartOptions"
                                    :data="chartData"
                                ></Line>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
