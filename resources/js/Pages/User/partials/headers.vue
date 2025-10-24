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
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <!-- BEGIN MODAL -->
                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </div>
</template>
