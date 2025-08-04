<script setup>
import { computed, reactive, ref } from "vue";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import { router } from "@inertiajs/vue3";
import VueNumberFormat from "vue-number-format";

defineProps({
    errors: Object,
    data: Object,
});

const title = "Pinjaman";
const subtitle = "New Pinjaman";

const nasabah = ref("");
const nominal = ref("");
const date = ref("");
const term = ref("");
const jaminan = ref("");
const persentage = ref("");

const commision = computed(() => {
    return (nominal.value * persentage.value) / 100;
});

function submitNasabah() {
    let formData = new FormData();

    formData.append("nasabah", nasabah.value);
    formData.append("pinjaman", nominal.value);
    formData.append("date", date.value);
    formData.append("term", term.value);
    formData.append("jaminan", jaminan.value);
    formData.append("persentage", persentage.value);
    formData.append("comisi", commision.value);

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
                                            v-model="nasabah"
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
                                        <!-- <input
                                            type="text"
                                            class="form-control"
                                            :value="formatAmount"
                                            @input="updatedAmount"
                                            :class="{
                                                'is-invalid': errors.nominal,
                                            }"
                                        /> -->
                                        <VueNumberFormat
                                            v-model:value="nominal"
                                            :options="{
                                                precision: 0,
                                                prefix: 'Rp. ',
                                                isInteger: true,
                                            }"
                                            class="form-control"
                                        >
                                        </VueNumberFormat>
                                        <!-- <input
                                            type="text"
                                            class="form-control"
                                            v-model="nominal"
                                            :class="{
                                                'is-invalid': errors.pinjaman,
                                            }"
                                        /> -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Tanggal Pinjam</label
                                        >
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="date"
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
                                            v-model="term"
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
                                            v-model="jaminan"
                                            :class="{
                                                'is-invalid': errors.jaminan,
                                            }"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Komisi</label>
                                        <VueNumberFormat
                                            v-model:value="persentage"
                                            :options="{
                                                precision: 0,
                                                prefix: '',
                                                suffix: ' %',
                                                acceptNegative: false,
                                            }"
                                            class="form-control"
                                        >
                                        </VueNumberFormat>
                                        <!-- <input
                                            type="text"
                                            class="form-control"
                                            v-model="persentage"
                                            :class="{
                                                'is-invalid': errors.persentage,
                                            }"
                                        /> -->
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
