<script setup>
import Layout from "../Layout/app.vue";
import HeadersCard from "../../components/HeadersCard.vue";
import TableView from "./partials/tableView.vue";
import { router, usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    data: Object,
});

const page = usePage();
const flash = computed(() => page.props.flash.msg);

const title = "Pinjaman";
const subtitle = "Pinjaman";

function searching(key) {
    router.get("/pinjaman", { search: key }, { preserveState: true });
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
                    href="/pinjaman/create"
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
                    Pinjaman
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
                            @SearchTerm="searching"
                        ></TableView>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
