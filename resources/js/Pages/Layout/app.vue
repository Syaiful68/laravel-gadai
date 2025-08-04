<script setup>
import Sidebar from "./SideNav.vue";
import Navbar from "./NavBar.vue";
import TaskBar from "./Footers.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const notification = computed(() => page.props.notification.upcomming);
</script>

<template>
    <div class="page">
        <!--  BEGIN SIDEBAR  -->
        <Sidebar></Sidebar>
        <!--  END SIDEBAR  -->
        <!-- BEGIN NAVBAR  -->
        <Navbar :notif="notification"></Navbar>
        <!-- END NAVBAR  -->
        <div class="page-wrapper">
            <slot></slot>
            <!-- END PAGE BODY -->
            <TaskBar></TaskBar>
        </div>
    </div>
</template>

<style scoped>
:where(.theme-dark, [data-theme="dark"]) .tblr-illustrations-good-info-a {
    fill: black;
    opacity: 0.07;
}
:where(.theme-dark, [data-theme="dark"]) .tblr-illustrations-good-info-b {
    fill: #1d2535;
}
:where(.theme-dark, [data-theme="dark"]) .tblr-illustrations-good-info-c {
    fill: #454c5e;
}
@media (prefers-color-scheme: dark) {
    .tblr-illustrations-good-info-a {
        fill: black;
        opacity: 0.07;
    }
    .tblr-illustrations-good-info-b {
        fill: #1d2535;
    }
    .tblr-illustrations-good-info-c {
        fill: #454c5e;
    }
}
</style>
