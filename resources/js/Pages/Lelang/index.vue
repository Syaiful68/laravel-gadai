<script setup>
import { router, usePage } from "@inertiajs/vue3";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import { ref, computed } from "vue";
import Swal from "sweetalert2";
import _ from "lodash";
import TableView from "../../components/TableView.vue";

const props = defineProps({
    data: Object,
    total_entries: Number,
});

const title = "Lelang";
const subtitle = "List Lelang";
const pages = usePage();
const SearchTerm = ref("");
const currentPage = ref(1);
const perPage = ref(25);

const dataFiltered = computed(() => {
    if (SearchTerm.value !== "") {
        return props.data.data.filter(
            (item) =>
                item.code.toLowerCase().includes(SearchTerm.value) ||
                item.pinjaman.toLowerCase().includes(SearchTerm.value) ||
                item.nasabah.toLowerCase().includes(SearchTerm.value) ||
                ""
        );
    }
    return props.data.data;
});

const totalPages = computed(() => {
    return Math.ceil(dataFiltered.value.length / perPage.value);
});

const PaginationItems = computed(() => {
    const start = (currentPage.value - 1) * perPage.value;
    const end = start + perPage.value;
    return dataFiltered.value.slice(start, end);
});

function changePage(page) {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
}

// watch(
//     Search,
//     _.debounce(function (key) {
//         router.get("/lelang", { q: key }, { preserveState: true });
//     }, 1500)
// );

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}

function SoldOut(id) {
    router.get("/lelang/" + id, {
        _token: pages.props.csrf_token,
    });
}
function deLelang(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You're delete it!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete("/lelang/" + id, {
                _token: pages.props.csrf_token,
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                    });
                    window.location.reload();
                },
            });
        }
    });
}
</script>

<template>
    <Layout>
        <Headers :title="title" :subtitle="subtitle"></Headers>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-sm-12 col-lg-12">
                        <!--  -->
                        <TableView>
                            <template #headers>
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
                            </template>
                            <template #body>
                                <table
                                    class="table table-selectable card-table table-vcenter text-nowrap datatable"
                                >
                                    <thead>
                                        <tr>
                                            <th>Code Lelang</th>
                                            <th>Code Pinjaman</th>
                                            <th>Nasabah</th>
                                            <th>Nama Lelang</th>
                                            <th>Nominal Pinjaman</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="PaginationItems.length === 0">
                                            <td colspan="6" class="text-center">
                                                Data not found
                                            </td>
                                        </tr>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in PaginationItems"
                                            :key="index"
                                        >
                                            <td>{{ item.code }}</td>
                                            <td>
                                                {{ item.pinjaman }}
                                            </td>
                                            <td>
                                                {{ item.nasabah }}
                                            </td>
                                            <td>{{ item.jaminan }}</td>
                                            <td>
                                                Rp.
                                                {{ fcurrency(item.nominal) }}
                                            </td>
                                            <td>
                                                <span
                                                    v-if="
                                                        item.status ===
                                                        'complete'
                                                    "
                                                    class="badge bg-green text-green-fg"
                                                    >Sold Out</span
                                                >
                                                <span
                                                    v-if="
                                                        item.status ===
                                                        'incomplete'
                                                    "
                                                    class="badge bg-orange text-orange-fg"
                                                    >Lelang</span
                                                >
                                            </td>
                                            <td>
                                                <button
                                                    @click="SoldOut(item.code)"
                                                    type="button"
                                                    class="btn btn-icon me-2"
                                                >
                                                    <i
                                                        class="fa-solid fa-info"
                                                    ></i>
                                                </button>
                                                <button
                                                    @click="deLelang(item.code)"
                                                    type="button"
                                                    class="btn btn-icon"
                                                    :disabled="
                                                        item.status ===
                                                        'complete'
                                                    "
                                                >
                                                    <i
                                                        class="fa-solid fa-trash"
                                                    ></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template #footer>
                                <div
                                    class="row g-2 justify-content-center justify-content-sm-between"
                                >
                                    <div
                                        class="col-auto d-flex align-items-center"
                                    ></div>

                                    <div class="col-auto">
                                        <ul class="pagination m-0 ms-auto">
                                            <button
                                                type="button"
                                                class="page-link"
                                                @click="
                                                    changePage(currentPage - 1)
                                                "
                                                :disabled="currentPage === 1"
                                            >
                                                < Prev
                                            </button>

                                            <button
                                                type="button"
                                                class="page-link"
                                                @click="
                                                    changePage(currentPage + 1)
                                                "
                                                :disabled="
                                                    currentPage === totalPages
                                                "
                                            >
                                                Next >
                                            </button>
                                        </ul>
                                    </div>
                                </div>
                            </template>
                        </TableView>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
