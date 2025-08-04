<script setup>
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
});

const commisionData = props.data.map(function (i) {
    return i.total_angsuran;
});

const labelCommision = props.data.map(function (m) {
    return m.month;
});

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
    <div class="card">
        <div class="card-body" style="height: 300px">
            <Line
                id="my-chart-id"
                :options="chartOptions"
                :data="chartData"
            ></Line>
        </div>
    </div>
</template>
