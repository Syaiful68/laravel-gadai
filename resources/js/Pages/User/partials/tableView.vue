<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import _ from "lodash";
import Pagination from "../../../components/paginationView.vue";

defineProps({
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
function EditUser(id) {
    router.get("/user/" + id);
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
                        <th>Nama</th>
                        <th>User</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data.total === 0">
                        <td colspan="5" class="text-center">Data not found</td>
                    </tr>
                    <tr v-for="(item, index) in data.data" :key="index">
                        <td>{{ item.nama }}</td>
                        <td>{{ item.user }}</td>
                        <td>{{ item.roles }}</td>
                        <td>
                            <!-- {{ item.status }} -->
                            <span
                                v-if="item.is_active === '1'"
                                class="badge bg-green text-green-fg"
                                >Active</span
                            >
                            <span
                                v-if="item.is_active === '2'"
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
