<script setup>
import { reactive } from "vue";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import { router, usePage } from "@inertiajs/vue3";
import DatePicker from "@vuepic/vue-datepicker";

defineProps({
    errors: Object,
});

const pages = usePage();

const formData = reactive({
    _token: pages.props.csrf_token,
    nik: null,
    nama: null,
    t_lahir: null,
    gender: "",
    alamat: null,
    contact: null,
    job: null,
});
const title = "Nasabah";
const subtitle = "New Nasabah";

function submitNasabah() {
    router.post("/nasabah", formData);
}
</script>

<template>
    <Layout>
        <Headers :title="title" :subtitle="subtitle"></Headers>
        <div class="page-body">
            <div class="container-xl">
                <form @submit.prevent="submitNasabah">
                    <div class="row row-deck row-cards">
                        <div class="col-sm-12 col-lg-6">
                            <!--  -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.nik"
                                            :class="{
                                                'is-invalid': errors.nik,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.nama"
                                            :class="{
                                                'is-invalid': errors.nama,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Jenis Kelamin</label
                                        >
                                        <select
                                            class="form-control"
                                            v-model="formData.gender"
                                            :class="{
                                                'is-invalid': errors.gender,
                                            }"
                                        >
                                            <option value="">Choise</option>
                                            <option value="P">Wanita</option>
                                            <option value="L">Pria</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Tanggal Lahir</label
                                        >
                                        <DatePicker
                                            v-model="formData.t_lahir"
                                            model-type="yyyy-mm-dd"
                                        ></DatePicker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <!--  -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Contact</label
                                        >
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                +62
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="formData.contact"
                                                placeholder="820xxxxxx"
                                                :class="{
                                                    'is-invalid':
                                                        errors.contact,
                                                }"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Job</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.job"
                                            :class="{
                                                'is-invalid': errors.job,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>

                                        <textarea
                                            type="text"
                                            class="form-control"
                                            v-model="formData.alamat"
                                            :class="{
                                                'is-invalid': errors.alamat,
                                            }"
                                            rows="5"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>
