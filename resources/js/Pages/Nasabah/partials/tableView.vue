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
        <div class="card-body border-bottom py-3"></div>
        <div class="table-responsive"></div>
        <div class="card-footer"></div>
    </div>
</template>
