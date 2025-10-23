<script setup>
import Layout from "../Layout/app.vue";
import HeadersCard from "../../components/HeadersCard.vue";
import TableView from "../../components/TableView.vue";
import { router, usePage, Link } from "@inertiajs/vue3";
import { computed, watch, ref } from "vue";
import Pagination from "../../components/paginationView.vue";
import _ from "lodash";

const props = defineProps({
    data: Object,
});

const page = usePage();
const flash = computed(() => page.props.flash.msg);

const title = "Pinjaman";
const subtitle = "Pinjaman";

const SearchTerm = ref("");
const showAction = ref(null);

watch(
    SearchTerm,
    _.debounce(function (key) {
        router.get("/pinjaman", { search: key }, { preserveState: true });
    }, 1500)
);

function toggleAction(id) {
    if (showAction.value === id) {
        showAction.value = null;
    } else {
        showAction.value = id;
    }
}

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}

function deletePinjam(id) {
    router.delete("/pinjaman/" + id, {
        onSuccess: () => {
            window.location.reload();
        },
    });
}
function notePinjaman(id) {
    window.open("/file/" + id + "/draft", "_blank");
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
                                            <th>Code Pinjam</th>
                                            <th>Nasabah</th>
                                            <th>Pinjaman</th>
                                            <th>Persentase</th>
                                            <th>status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="data.total === 0">
                                            <td class="text-center" colspan="6">
                                                Data not Found
                                            </td>
                                        </tr>
                                        <tr
                                            v-for="(item, index) in data.data"
                                            :key="index"
                                        >
                                            <td>{{ item.code_pinjam }}</td>
                                            <td>{{ item.nasabah.name }}</td>
                                            <td>
                                                Rp.
                                                {{ fcurrency(item.pinjaman) }}
                                            </td>
                                            <td>{{ item.persentages }}%</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        item.status ===
                                                        'complete'
                                                    "
                                                    class="badge bg-green text-green-fg"
                                                    >Lunas</span
                                                >
                                                <span
                                                    v-if="
                                                        item.status ===
                                                        'incomplete'
                                                    "
                                                    class="badge bg-orange text-orange-fg"
                                                    >Angsur</span
                                                >
                                                <span
                                                    v-if="
                                                        item.status === 'lelang'
                                                    "
                                                    class="badge bg-red text-red-fg"
                                                    >Lelang</span
                                                >
                                            </td>
                                            <td class="text-end">
                                                <span class="dropdown">
                                                    <button
                                                        class="btn dropdown-toggle align-text-top"
                                                        data-bs-boundary="viewport"
                                                        data-bs-toggle="dropdown"
                                                        @click="
                                                            toggleAction(index)
                                                        "
                                                    >
                                                        Actions
                                                    </button>
                                                    <div
                                                        v-if="
                                                            showAction === index
                                                        "
                                                        class="dropdown-menu dropdown-menu-end show"
                                                        style="
                                                            position: absolute;
                                                            inset: 0px 0px auto
                                                                auto;
                                                            margin: 0px;
                                                            transform: translate(
                                                                0px,
                                                                42px
                                                            );
                                                        "
                                                    >
                                                        <a
                                                            :href="
                                                                'http://api.whatsapp.com/send?phone=+62' +
                                                                item.nasabah
                                                                    .contact +
                                                                '&text=mohon untuk segera membayarkan uang angsuran sebesar Rp. ' +
                                                                item.pinjaman +
                                                                '%20 sebelum tanggal ' +
                                                                item.term_date
                                                            "
                                                            target="_blank"
                                                            class="dropdown-item"
                                                        >
                                                            Send WA
                                                        </a>
                                                        <a
                                                            class="dropdown-item"
                                                            @click="
                                                                notePinjaman(
                                                                    item.code_pinjam
                                                                )
                                                            "
                                                            :disabled="
                                                                item.status ===
                                                                'lelang'
                                                            "
                                                        >
                                                            Print
                                                        </a>
                                                        <Link
                                                            :href="
                                                                '/pinjaman/' +
                                                                item.code_pinjam
                                                            "
                                                            class="dropdown-item"
                                                        >
                                                            Edit
                                                        </Link>
                                                        <button
                                                            @click="
                                                                deletePinjam(
                                                                    item.code_pinjam
                                                                )
                                                            "
                                                            type="button"
                                                            class="dropdown-item"
                                                        >
                                                            Delete
                                                        </button>
                                                    </div>
                                                </span>
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
</template>
