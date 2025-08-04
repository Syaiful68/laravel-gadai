<script setup>
defineProps({
    data: Object,
});
</script>

<template>
    <div class="col-auto">
        <ul class="pagination m-0 ms-auto">
            <li
                class="page-item"
                :class="{ active: item.active === true }"
                v-for="(item, index) in data"
                :key="index"
            >
                <a class="page-link" :href="item.url" v-html="item.label"></a>
            </li>
        </ul>
    </div>
</template>
