<script setup>
import { reactive, ref } from "vue";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import { router, usePage } from "@inertiajs/vue3";
import VueNumberFormat from "vue-number-format";

const props = defineProps({
    errors: Object,
    data: Object,
});

const pages = usePage();

const statusLelang = ref(props.data.status);
// const nominalValue = props.data.pinjam.pinjaman;
const formData = reactive({
    _token: pages.props.auth.csrf,
    nominal: props.data.nominal,
    status: props.data.status,
});

const title = "Lelang";
const subtitle = "Item Lelang";

function updateLelang() {
    router.patch("/lelang/" + props.data.code_lelang, formData, {
        onSuccess: () => {
            Swal.fire({
                position: "top-end",
                toast: true,
                icon: "success",
                title: "Lelang Has been Updated",
                showConfirmButton: false,
                timer: 1500,
            });
        },
        onError: () => {
            console.log(errors);
        },
    });
}
</script>

<template>
    <Layout>
        <Headers :title="title" :subtitle="subtitle"></Headers>
        <div class="page-body">
            <div class="container-xl">
                <form @submit.prevent="updateLelang">
                    <div class="row row-deck row-cards">
                        <div class="col-sm-12 col-lg-6">
                            <!--  -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Code Lelang</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="props.data.code_lelang"
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Item Lelang</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="props.data.pinjam.jaminan"
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Minimal Pembelian</label
                                        >
                                        <VueNumberFormat
                                            v-model:value="
                                                props.data.pinjam.total
                                            "
                                            :options="{
                                                precision: 0,
                                                prefix: 'Rp. ',
                                                isInteger: true,
                                            }"
                                            class="form-control"
                                        >
                                        </VueNumberFormat>
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
                                            >Nominal Lelang</label
                                        >
                                        <VueNumberFormat
                                            v-model:value="formData.nominal"
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
                                        <label class="form-label">Status</label>
                                        <select
                                            v-model="formData.status"
                                            class="form-control"
                                            :disabled="
                                                statusLelang !== 'incomplete'
                                            "
                                        >
                                            <option value="">Choise</option>
                                            <option value="incomplete">
                                                Lelang
                                            </option>
                                            <option value="complete">
                                                Done
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="statusLelang === 'complete'"
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
