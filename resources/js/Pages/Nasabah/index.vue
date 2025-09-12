<script setup>
import { router, Link } from "@inertiajs/vue3";
import Layout from "../Layout/app.vue";
import HeadersCard from "../../components/HeadersCard.vue";
import TableView from "./partials/tableView.vue";

const props = defineProps({
    data: Object,
});
const title = "Nasabah";
const subtitle = "List Nasabah";

function Searching(key) {
    // console.log(key);
    router.get("/nasabah", { q: key }, { preserveState: true });
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
                        <TableView
                            :data="data"
                            @SearchTerm="Searching"
                        ></TableView>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
