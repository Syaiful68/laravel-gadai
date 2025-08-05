<script setup>
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const user = computed(() => page.props.auth.user);

defineProps({
    label: String,
    icon: String,
    path: String,
});
</script>

<template>
    <li class="nav-item" :class="{ active: $page.url.startsWith(path) }">
        <Link class="nav-link" :href="path">
            <span class="nav-link-icon d-md-none d-lg-inline-block"
                ><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                <i class="fas" :class="icon"></i>
            </span>
            <span class="nav-link-title"> {{ label }} </span>
        </Link>
    </li>
</template>
