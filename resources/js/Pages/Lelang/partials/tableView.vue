<script setup>
import _ from "lodash";
import { ref, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import Pagination from "../../../components/paginationView.vue";

defineProps({
    data: Object,
});

const Search = ref("");
const pages = usePage();
const emits = defineEmits(["SearchTerm"]);
watch(
    Search,
    _.debounce(function (value) {
        emits("SearchTerm", value);
    }, 1500)
);

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}

function SoldOut(id) {
    router.get("/lelang/" + id, {
        _token: pages.props.csrf_token,
    });
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
                        <th>Code Lelang</th>
                        <th>Nama Lelang</th>
                        <th>Nominal Pinjaman</th>
                        <th>Status</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data.total === 0">
                        <td colspan="5" class="text-center">Data not found</td>
                    </tr>
                    <tr v-for="(item, index) in data.data" :key="index">
                        <td>{{ item.code_lelang }}</td>
                        <td>{{ item.pinjam.jaminan }}</td>
                        <td>Rp. {{ fcurrency(item.pinjam.pinjaman) }}</td>
                        <td>
                            <!-- {{ item.status }} -->
                            <span
                                v-if="item.status === 'complete'"
                                class="badge bg-green text-green-fg"
                                >Sold Out</span
                            >
                            <span
                                v-if="item.status === 'incomplete'"
                                class="badge bg-orange text-orange-fg"
                                >Lelang</span
                            >
                        </td>
                        <td>
                            <button
                                @click="SoldOut(item.code_lelang)"
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
