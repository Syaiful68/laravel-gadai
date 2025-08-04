<script setup>
import _ from "lodash";
import { ref, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
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
    router.get("/file/" + id + "/draft");
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
                                >Complete</span
                            >
                            <span
                                v-if="item.status === 'incomplete'"
                                class="badge bg-orange text-orange-fg"
                                >In Complete</span
                            >
                            <span
                                v-if="item.status === 'lelang'"
                                class="badge bg-red text-red-fg"
                                >Lelang</span
                            >
                        </td>
                        <td>
                            <a
                                :href="'/file/' + item.code_pinjam + '/draft'"
                                target="_blank"
                                rel="noopener noreferrer"
                                type="button"
                                class="btn btn-icon btn-success me-2"
                                v-if="item.status !== 'lelang'"
                            >
                                <i class="fa-solid fa-download"></i>
                            </a>
                            <!-- <button
                                @click="notePinjaman(item.code_pinjam)"
                                type="button"
                                class="btn btn-icon btn-success me-2"
                                v-if="item.status !== 'lelang'"
                            ></button> -->
                            <button
                                @click="editPinjaman(item.code_pinjam)"
                                type="button"
                                class="btn btn-icon"
                                v-if="item.status !== 'lelang'"
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
