<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import notificationModal from "../../components/notificationModal.vue";

defineProps({
    notif: Array,
    user: Object,
});

const notificationShow = ref(false);
const showUserMenu = ref(false);
function ToggleNotif() {
    return (notificationShow.value = !notificationShow.value);
}

function toggleUserMenu() {
    return (showUserMenu.value = !showUserMenu.value);
}

function btnLogout() {
    router.delete("/logout");
}
</script>

<template>
    <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
        <div class="container-xl">
            <!-- BEGIN NAVBAR TOGGLER -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar-menu"
                aria-controls="navbar-menu"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- END NAVBAR TOGGLER -->
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-none d-md-flex">
                    <div class="nav-item dropdown d-none d-md-flex">
                        <a
                            href="#"
                            @click="ToggleNotif"
                            class="nav-link px-0 show"
                            data-bs-toggle="dropdown"
                            tabindex="-1"
                            aria-label="Show notifications"
                            data-bs-auto-close="outside"
                            aria-expanded="false"
                        >
                            <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
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
                                class="icon icon-1"
                            >
                                <path
                                    d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"
                                />
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                            </svg>
                            <span
                                class="badge bg-red"
                                v-if="notif.length !== 0"
                            ></span>
                        </a>
                        <notificationModal
                            v-show="notificationShow"
                            :notif="notif"
                        ></notificationModal>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a
                        href="#"
                        @click="toggleUserMenu"
                        class="nav-link d-flex lh-1 p-0 px-2"
                        data-bs-toggle="dropdown"
                        aria-label="Open user menu"
                    >
                        <span
                            class="avatar avatar-sm"
                            style="
                                background-image: url(./static/avatars/000m.jpg);
                            "
                        >
                        </span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ user.nama }}</div>
                            <div class="mt-1 small text-secondary">
                                {{ user.roles }}
                            </div>
                        </div>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
                        :class="{ show: showUserMenu === true }"
                        data-bs-popper="static"
                    >
                        <a href="./settings.html" class="dropdown-item"
                            >Profile</a
                        >
                        <a href="#" @click="btnLogout()" class="dropdown-item"
                            >Logout</a
                        >
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <!-- BEGIN NAVBAR MENU -->
                <!-- END NAVBAR MENU -->
            </div>
        </div>
    </header>
</template>
