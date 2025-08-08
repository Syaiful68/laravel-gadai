<script setup>
import { computed, reactive } from "vue";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import { router, usePage } from "@inertiajs/vue3";
import VueNumberFormat from "vue-number-format";

defineProps({
    errors: Object,
    data: Object,
});

const page = usePage();

const title = "Pinjaman";
const subtitle = "New Pinjaman";

const commision = computed(() => {
    return (formData.pinjaman * formData.persentage) / 100;
});

const formData = reactive({
    _token: page.props.auth.csrf,
    nasabah: "",
    pinjaman: "",
    date: null,
    term: null,
    jaminan: null,
    persentage: "",
    comisi: commision,
});

function submitNasabah() {
    router.post("/pinjaman", formData);
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
                                        <label class="form-label"
                                            >Nasabah</label
                                        >
                                        <select
                                            class="form-control"
                                            v-model="formData.nasabah"
                                            :class="{
                                                'is-invalid': errors.nasabah,
                                            }"
                                        >
                                            <option value="">Choise</option>
                                            <option
                                                v-for="(item, index) in data"
                                                :key="index"
                                                :value="item.id"
                                            >
                                                {{ item.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Pinjaman</label
                                        >
                                        <VueNumberFormat
                                            v-model:value="formData.pinjaman"
                                            :options="{
                                                precision: 0,
                                                prefix: 'Rp. ',
                                                isInteger: true,
                                            }"
                                            class="form-control"
                                        >
                                        </VueNumberFormat>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Tanggal Pinjam</label
                                        >
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="formData.date"
                                            :class="{
                                                'is-invalid': errors.date,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tenor</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.term"
                                            :class="{
                                                'is-invalid': errors.term,
                                            }"
                                        />
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
                                            >Jaminan</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.jaminan"
                                            :class="{
                                                'is-invalid': errors.jaminan,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Komisi</label>
                                        <VueNumberFormat
                                            v-model:value="formData.persentage"
                                            :options="{
                                                precision: 0,
                                                prefix: '',
                                                suffix: ' %',
                                                acceptNegative: false,
                                            }"
                                            class="form-control"
                                        >
                                        </VueNumberFormat>
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
