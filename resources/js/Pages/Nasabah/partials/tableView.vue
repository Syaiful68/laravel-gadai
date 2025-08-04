<script setup>
import _ from "lodash";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import Pagination from "../../../components/paginationView.vue";

const props = defineProps({
    data: Object,
});

const Search = ref("");

const emits = defineEmits(["SearchTerm"]);

watch(
    Search,
    _.debounce(function (value) {
        emits("SearchTerm", value);
    }, 1500)
);

function editNasabah(id) {
    router.get("/nasabah/" + id);
}
function exportData() {
    return (window.location.href = "/export?type=nasabah");
}
</script>
<template>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="">
                    <button
                        type="button"
                        @click="exportData"
                        class="btn btn-success"
                    >
                        <i class="fa-solid fa-download me-2"></i>
                        Download
                    </button>
                </div>
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            aria-label="Search invoice"
                            v-model="Search"
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
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data.total === 0">
                        <td class="text-center" colspan="4">Data not found</td>
                    </tr>
                    <tr v-for="(item, index) in data.data" :key="index">
                        <td>{{ item.name }}</td>
                        <td>
                            <span v-if="item.gender === 'L'">Pria</span>
                            <span v-if="item.gender === 'P'">Wanita</span>
                            <!-- {{ item.gender }} -->
                        </td>
                        <td>
                            <!-- {{ item.status }} -->
                            <span
                                v-if="item.status === 'active'"
                                class="badge bg-green text-green-fg"
                                >Active</span
                            >
                            <span
                                v-if="item.status === 'inactive'"
                                class="badge bg-orange text-orange-fg"
                                >InActive</span
                            >
                            <span
                                v-if="item.status === 'blacklist'"
                                class="badge bg-red text-red-fg"
                                >BlackList</span
                            >
                        </td>
                        <td>
                            <button
                                @click="editNasabah(item.id)"
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
