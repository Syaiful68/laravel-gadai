<script setup>
import Layout from "../Layout/app.vue";
import Headers from "../../components/HeadersCard.vue";
import ModalView from "./partials/ModalView.vue";
import TableView from "../../components/TableView.vue";
import Pagination from "../../components/paginationView.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import _ from "lodash";

const props = defineProps({
    data: Object,
    errors: Object,
});

const showModal = ref(false);

function toggleModal() {
    return (showModal.value = !showModal.value);
}

const title = "Users";
const subtitle = "List User";

const SearchTerm = ref("");

watch(
    SearchTerm,
    _.debounce(function (key) {
        router.get("/user", { search: key }, { preserveState: true });
    }, 1500)
);
function EditUser(id) {
    router.get("/user/" + id);
}
</script>

<template>
    <Layout>
        <Headers>
            <template #title-pre>
                <!--  -->
                <div class="page-pretitle">{{ title }}</div>
                <h2 class="page-title">{{ subtitle }}</h2>
            </template>
            <template #link-button>
                <!--  -->
                <div class="btn-list">
                    <button
                        @click="$emit('toggle')"
                        type="button"
                        class="btn btn-primary"
                    >
                        New User
                    </button>
                </div>
            </template>
        </Headers>
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
                                            <th>Nama</th>
                                            <th>User</th>
                                            <th>Roles</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="data.total === 0">
                                            <td colspan="5" class="text-center">
                                                Data not found
                                            </td>
                                        </tr>
                                        <tr
                                            v-for="(item, index) in data.data"
                                            :key="index"
                                        >
                                            <td>{{ item.nama }}</td>
                                            <td>{{ item.user }}</td>
                                            <td>{{ item.roles }}</td>
                                            <td>
                                                <!-- {{ item.status }} -->
                                                <span
                                                    v-if="
                                                        item.is_active === '1'
                                                    "
                                                    class="badge bg-green text-green-fg"
                                                    >Active</span
                                                >
                                                <span
                                                    v-if="
                                                        item.is_active === '2'
                                                    "
                                                    class="badge bg-red text-red-fg"
                                                    >In Active</span
                                                >
                                            </td>
                                            <td>
                                                <button
                                                    @click="EditUser(item.user)"
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
                                    >
                                        <p class="m-0 text-secondary">
                                            Showing
                                            <strong
                                                >{{ data.from }} to
                                                {{ data.to }}</strong
                                            >
                                            of
                                            <strong
                                                >{{
                                                    data.total
                                                }}
                                                entries</strong
                                            >
                                        </p>
                                    </div>
                                    <Pagination :data="data.links"></Pagination>
                                </div>
                            </template>
                        </TableView>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
    <ModalView
        v-show="showModal"
        @toggle="toggleModal"
        :errs="errors"
    ></ModalView>
</template>
