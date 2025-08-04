<script setup>
import { reactive } from "vue";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    errors: Object,
    data: Object,
});

const formData = reactive({
    nik: props.data.nik,
    nama: props.data.name,
    t_lahir: props.data.t_lahir,
    gender: props.data.gender,
    alamat: props.data.alamat,
    contact: props.data.contact,
    job: props.data.jobs,
    status: props.data.status,
});

const title = "Nasabah";
const subtitle = "Nasabah Detail";

function updateNasabah() {
    router.put("/nasabah/" + props.data.id, formData);
}
</script>

<template>
    <Layout>
        <Headers :title="title" :subtitle="subtitle"></Headers>
        <div class="page-body">
            <div class="container-xl">
                <form @submit.prevent="updateNasabah">
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
                                            disabled
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
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Tanggal Lahir</label
                                        >
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="formData.t_lahir"
                                            :class="{
                                                'is-invalid': errors.t_lahir,
                                            }"
                                            disabled
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
                                            disabled
                                        >
                                            <option value="">Choise</option>
                                            <option value="P">Wanita</option>
                                            <option value="L">Pria</option>
                                        </select>
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
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.alamat"
                                            :class="{
                                                'is-invalid': errors.alamat,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select
                                            class="form-control"
                                            v-model="formData.status"
                                            :class="{
                                                'is-invalid': errors.status,
                                            }"
                                        >
                                            <option value="">Choise</option>
                                            <option value="active">
                                                Active
                                            </option>
                                            <option value="inactive">
                                                Inactive
                                            </option>
                                            <option value="blacklist">
                                                Black List
                                            </option>
                                        </select>
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
