<script setup>
import { reactive } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import VueNumberFormat from "vue-number-format";
const props = defineProps({
    errs: Object,
    code: String,
});
//

const page = usePage();

const forms = reactive({
    _token: page.props.auth.csrf,
    code_pinjam: props.code,
    nominal: null,
    date: null,
    payment_type: "",
});

function submitAngsuran() {
    router.post("/angsuran", forms, {
        onSuccess: () => {
            window.location.reload();
        },
    });
}
</script>

<template>
    <div class="modal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button
                        type="button"
                        class="btn-close"
                        @click="$emit('toggle')"
                    ></button>
                </div>
                <form @submit.prevent="submitAngsuran">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nominal</label>
                            <VueNumberFormat
                                v-model:value="forms.nominal"
                                :options="{
                                    precision: 0,
                                    prefix: 'Rp. ',
                                    isInteger: true,
                                }"
                                class="form-control"
                                :class="{ 'is-invalid': errs.nominal }"
                            >
                            </VueNumberFormat>
                            <!-- <input
                                type="text"
                                class="form-control"
                                v-model="forms.nominal"
                                :class="{ 'is-invalid': errs.nominal }"
                            /> -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bayar</label>
                            <input
                                type="date"
                                class="form-control"
                                v-model="forms.date"
                                :class="{ 'is-invalid': errs.date }"
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pembayaran</label>
                            <select
                                v-model="forms.payment_type"
                                class="form-control"
                            >
                                <option value="">Pilih</option>
                                <option value="cs">Cash</option>
                                <option value="tf">Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            data-bs-dismiss="modal"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal {
    display: block;
}
</style>
