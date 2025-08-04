<script setup>
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import TableView from "./partials/tableView.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
});
const title = "Pinjaman";
const subtitle = "Pinjaman";

function searching(key) {
    router.get("/pinjaman", { search: key }, { preserveState: true });
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
                        <TableView
                            :data="data"
                            @SearchTerm="searching"
                        ></TableView>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
