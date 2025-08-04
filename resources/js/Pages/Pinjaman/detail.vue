<script setup>
import { reactive, ref } from "vue";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import TableAngsur from "./partials/tableAngsur.vue";
import ModalView from "./partials/modalView.vue";
import { router, usePage } from "@inertiajs/vue3";
import VueNumberFormat from "vue-number-format";

const title = "Pinjaman";
const subtitle = "Detail Pinjaman";

const props = defineProps({
    errors: Object,
    data: Object,
    nasabah: Object,
    angsuran: Object,
});
const pages = usePage();
const statusPinjam = ref(props.data.status);

const formData = reactive({
    _token: pages.props.csrf_token,
    nasabahId: props.data.nasabah_id,
    nominal: props.data.pinjaman,
    date: props.data.do_date,
    last_date: "",
    term: props.data.term,
    total: props.data.total,
    status: props.data.status,
    jaminan: props.data.jaminan,
    persentage: props.data.presentage,
    commision: props.data.comisi,
});

const showModal = ref(false);

function toggleModal() {
    return (showModal.value = !showModal.value);
}

function updatePinjaman() {
    router.put("/pinjaman/" + props.data.code_pinjam, formData);
}
</script>

<template>
    <Layout>
        <Headers :title="title" :subtitle="subtitle"></Headers>
        <div class="page-body">
            <div class="container-xl">
                <form @submit.prevent="updatePinjaman">
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
                                            v-model="formData.nasabahId"
                                            :class="{
                                                'is-invalid': errors.nasabah,
                                            }"
                                            disabled
                                        >
                                            <option value="">Choise</option>
                                            <option
                                                v-for="(item, index) in nasabah"
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
                                            @input="
                                                updatedAmount(
                                                    props.data.pinjaman
                                                )
                                            "
                                            :class="{
                                                'is-invalid': errors.pinjaman,
                                            }"
                                            disabled
                                        /> -->
                                        <VueNumberFormat
                                            v-model:value="formData.nominal"
                                            :options="{
                                                prefix: 'Rp. ',
                                                isInteger: true,
                                                precision: 0,
                                            }"
                                            class="form-control"
                                        ></VueNumberFormat>
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
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Perpanjang</label
                                        >
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="formData.last_date"
                                            :class="{
                                                'is-invalid': errors.date,
                                            }"
                                            :disabled="
                                                statusPinjam === 'complete'
                                            "
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
                                            disabled
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
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Total</label>
                                        <VueNumberFormat
                                            v-model:value="formData.total"
                                            :options="{
                                                prefix: 'Rp. ',
                                                isInteger: true,
                                                precision: 0,
                                            }"
                                            class="form-control"
                                        ></VueNumberFormat>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Komisi</label>
                                        <VueNumberFormat
                                            v-model:value="formData.commision"
                                            :options="{
                                                prefix: 'Rp. ',
                                                isInteger: true,
                                                precision: 0,
                                            }"
                                            class="form-control"
                                            :class="{
                                                'is-invalid': errors.commision,
                                            }"
                                        ></VueNumberFormat>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select
                                            class="form-control"
                                            v-model="formData.status"
                                            :class="{
                                                'is-invalid': errors.status,
                                            }"
                                            disabled
                                        >
                                            <option value="">Choise</option>
                                            <option value="complete">
                                                Complete
                                            </option>
                                            <option value="incomplete">
                                                In Complete
                                            </option>
                                            <option value="lelang">
                                                Lelang
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
                <div class="col-12 mt-3">
                    <TableAngsur
                        :angsuran="angsuran"
                        @onToggle="toggleModal"
                    ></TableAngsur>
                </div>
            </div>
        </div>
        <ModalView
            v-show="showModal"
            :errs="errors"
            :code="props.data.code_pinjam"
            @toggle="toggleModal"
        ></ModalView>
    </Layout>
</template>
