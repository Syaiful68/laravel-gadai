<script setup>
import { ref } from "vue";
const SearchTerm = ref();
</script>

<template>
    <!--  -->
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
</template>
