<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    notif: Object,
});
</script>

<template>
    <div
        class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card show"
        data-bs-popper="static"
    >
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="card-title">Notifications</h3>
                <!-- <div class="btn-close ms-auto" data-bs-dismiss="dropdown"></div> -->
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                <div
                    class="list-group-item"
                    v-for="(item, index) in notif"
                    :key="index"
                >
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span
                                class="status-dot status-dot-animated bg-red d-block"
                                v-if="item.status === 'incomplete'"
                            ></span>
                            <span
                                class="status-dot status-dot-animated bg-green d-block"
                                v-if="item.status === 'complete'"
                            ></span>
                        </div>
                        <div class="col text-truncate">
                            <Link
                                :href="'/pinjaman/' + item.name"
                                class="text-body d-block"
                            >
                                {{ item.name }}
                            </Link>
                            <div
                                class="d-block text-secondary text-truncate mt-n1"
                            >
                                {{ item.description }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <Link
                                :href="'notification-success/' + item.id"
                                class="list-group-item-actions show"
                            >
                                <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
                                <i
                                    class="fa-regular fa-star"
                                    v-if="item.status === 'incomplete'"
                                ></i>
                                <i
                                    class="fas fa-star"
                                    v-if="item.status === 'complete'"
                                ></i>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
