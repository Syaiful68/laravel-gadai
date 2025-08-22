<script setup>
import _ from "lodash";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import Pagination from "../../../components/paginationView.vue";
const props = defineProps({
    data: Object,
});

const SearchTerm = ref("");

const emits = defineEmits(["SearchTerm"]);

watch(
    SearchTerm,
    _.debounce(function (value) {
        emits("SearchTerm", value);
    }, 1500)
);

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}

function editPinjaman(id) {
    router.get("/pinjaman/" + id);
}
function notePinjaman(id) {
    window.open("/file/" + id + "/draft", "_blank");
}
</script>
<template>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            aria-label="Search invoice"
                            v-model="SearchTerm"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table
                class="table table-selectable card-table table-vcenter text-nowrap datatable"
            >
                <thead>
                    <tr>
                        <th>Code Pinjam</th>
                        <th>Nasabah</th>
                        <th>Pinjaman</th>
                        <th>Persentase</th>
                        <th>status</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data.total === 0">
                        <td class="text-center" colspan="6">Data not Found</td>
                    </tr>
                    <tr v-for="(item, index) in data.data" :key="index">
                        <td>{{ item.code_pinjam }}</td>
                        <td>{{ item.nasabah.name }}</td>
                        <td>Rp. {{ fcurrency(item.pinjaman) }}</td>
                        <td>{{ item.persentages }}%</td>
                        <td>
                            <!-- {{ item.status }} -->
                            <span
                                v-if="item.status === 'complete'"
                                class="badge bg-green text-green-fg"
                                >Lunas</span
                            >
                            <span
                                v-if="item.status === 'incomplete'"
                                class="badge bg-orange text-orange-fg"
                                >Angsur</span
                            >
                            <span
                                v-if="item.status === 'lelang'"
                                class="badge bg-red text-red-fg"
                                >Lelang</span
                            >
                        </td>
                        <td>
                            <a
                                :href="
                                    'http://api.whatsapp.com/send?phone=+62' +
                                    item.nasabah.contact +
                                    '&text=mohon untuk segera membayarkan uang angsuran sebesar Rp. ' +
                                    item.pinjaman +
                                    '%20 sebelum tanggal ' +
                                    item.term_date
                                "
                                target="_blank"
                                class="btn btn-success btn-icon me-2"
                            >
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <button
                                type="button"
                                class="btn btn-icon btn-light me-2"
                                @click="notePinjaman(item.code_pinjam)"
                                :disabled="item.status === 'lelang'"
                            >
                                <i class="fa-solid fa-download"></i>
                            </button>

                            <button
                                @click="editPinjaman(item.code_pinjam)"
                                type="button"
                                class="btn btn-icon"
                            >
                                <i class="fa-solid fa-info"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div
                class="row g-2 justify-content-center justify-content-sm-between"
            >
                <div class="col-auto d-flex align-items-center">
                    <p class="m-0 text-secondary">
                        Showing
                        <strong>{{ data.from }} to {{ data.to }}</strong> of
                        <strong>{{ data.total }} entries</strong>
                    </p>
                </div>
                <Pagination :data="data.links"></Pagination>
            </div>
        </div>
    </div>
</template>
