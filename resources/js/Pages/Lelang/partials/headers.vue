<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

defineProps({
    title: String,
    subtitle: String,
});
</script>

<template>
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">{{ title }}</div>
                    <h2 class="page-title">{{ subtitle }}</h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <Link
                                href="/lelang"
                                v-if="$page.url !== '/lelang'"
                                class="btn btn-1"
                            >
                                Back
                            </Link>
                        </span>
                        <a
                            href="#"
                            class="btn btn-primary btn-6 d-sm-none btn-icon"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-report"
                            aria-label="Create new report"
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
                        </a>
                    </div>
                    <!-- BEGIN MODAL -->
                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </div>
</template>
