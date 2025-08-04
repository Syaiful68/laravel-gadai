<script setup>
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";
import TableView from "./partials/tableView.vue";
import ModalView from "./partials/ModalView.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

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

function searching(key) {
    router.get("/user", { search: key }, { preserveState: true });
}
</script>

<template>
    <Layout>
        <Headers
            :title="title"
            :subtitle="subtitle"
            @toggle="toggleModal"
        ></Headers>
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
    <ModalView
        v-show="showModal"
        @toggle="toggleModal"
        :errs="errors"
    ></ModalView>
</template>
