<script setup>
import { reactive } from "vue";
import Layout from "./Layout/app.vue";

const formData = reactive({
    from: null,
    to: null,
    type: "pinjaman",
});

function exportData() {
    return (window.location.href =
        "/export?from=" +
        formData.from +
        "&to=" +
        formData.to +
        "&type=" +
        formData.type);
}
</script>

<template>
    <Layout>
        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Report</div>
                        <h2 class="page-title">Export Report</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-sm-12 col-lg-12">
                        <!--  -->
                        <div class="card">
                            <form @submit.prevent="exportData">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm">
                                            <label class="form-label"
                                                >From Date</label
                                            >
                                            <input
                                                type="date"
                                                class="form-control"
                                                name="example-text-input"
                                                v-model="formData.from"
                                            />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm">
                                            <label class="form-label"
                                                >To Date</label
                                            >
                                            <input
                                                type="date"
                                                class="form-control"
                                                name="example-text-input"
                                                v-model="formData.to"
                                            />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm">
                                            <label class="form-label"
                                                >Type</label
                                            >
                                            <div class="row g-2">
                                                <div class="col">
                                                    <select
                                                        class="form-control"
                                                        v-model="formData.type"
                                                    >
                                                        <option
                                                            value="pinjaman"
                                                        >
                                                            Pinjaman
                                                        </option>
                                                        <option value="lelang">
                                                            Lelang
                                                        </option>
                                                        <option value="user">
                                                            User
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <button
                                                        class="btn btn-icon btn-success"
                                                        type="submit"
                                                        aria-label="Button"
                                                    >
                                                        <i
                                                            class="fa-solid fa-download"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
