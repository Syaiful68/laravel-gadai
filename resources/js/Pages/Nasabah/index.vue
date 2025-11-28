<script setup>
import Layout from "../Layout/app.vue";
import TableView from "../../components/TableView.vue";
import HeadersCard from "../../components/HeadersCard.vue";
import { router, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import _ from "lodash";

const props = defineProps({
    data: Object,
    total_entries: Number,
});
const title = "Nasabah";
const subtitle = "List Nasabah";
const SearchTerm = ref("");
const currentPage = ref(1);
const perPage = ref(25);

const dataFiltered = computed(() => {
    if (SearchTerm.value !== "") {
        return props.data.data.filter(
            (item) => item.name.toLowerCase().includes(SearchTerm.value) || ""
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

function editNasabah(id) {
    router.get("/nasabah/" + id);
}
function exportData() {
    return (window.location.href = "/export?type=nasabah");
}
</script>

<template>
    <Layout>
        <HeadersCard>
            <template #title-pre>
                <div class="page-pretitle">{{ title }}</div>
                <h2 class="page-title">{{ subtitle }}</h2>
            </template>
            <template #link-button>
                <Link
                    href="/nasabah/create"
                    class="btn btn-primary btn-5 d-none d-sm-inline-block"
                >
                    <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-2"
                    >
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    New Nasabah
                </Link>
            </template>
        </HeadersCard>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-sm-12 col-lg-12">
                        <!--  -->
                        <TableView>
                            <template #headers>
                                <div class="d-flex">
                                    <div class="">
                                        <button
                                            type="button"
                                            @click="exportData"
                                            class="btn btn-success"
                                        >
                                            <i
                                                class="fa-solid fa-download me-2"
                                            ></i>
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
                                            <th>Nama</th>
                                            <th>Gender</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="PaginationItems.length === 0">
                                            <td class="text-center" colspan="4">
                                                Data not found
                                            </td>
                                        </tr>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in PaginationItems"
                                            :key="index"
                                        >
                                            <td>{{ item.name }}</td>
                                            <td>
                                                <span v-if="item.gender === 'L'"
                                                    >Pria</span
                                                >
                                                <span v-if="item.gender === 'P'"
                                                    >Wanita</span
                                                >
                                            </td>
                                            <td>{{ item.pekerjaan }}</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        item.status === 'active'
                                                    "
                                                    class="badge bg-green text-green-fg"
                                                    >Active</span
                                                >
                                                <span
                                                    v-if="
                                                        item.status ===
                                                        'inactive'
                                                    "
                                                    class="badge bg-orange text-orange-fg"
                                                    >InActive</span
                                                >
                                                <span
                                                    v-if="
                                                        item.status ===
                                                        'blacklist'
                                                    "
                                                    class="badge bg-red text-red-fg"
                                                    >BlackList</span
                                                >
                                            </td>
                                            <td>
                                                <button
                                                    @click="
                                                        editNasabah(item.id)
                                                    "
                                                    type="button"
                                                    class="btn btn-icon"
                                                >
                                                    <i
                                                        class="fa-solid fa-info"
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
