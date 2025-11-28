<script setup>
const props = defineProps({
    data: Object,
    total: Number,
    currentPage: Number,
});
</script>

<template>
    <div class="row g-2 justify-content-center justify-content-sm-between">
        <div class="col-auto d-flex align-items-center"></div>

        <div class="col-auto">
            <ul class="pagination m-0 ms-auto">
                <li class="page-item" v-if="props.data.prev_page_url !== null">
                    <a class="page-link" href="#" @click="">< Prev</a>
                </li>
                <li class="page-item" v-if="props.data.next_page_url !== null">
                    <a class="page-link" href="#" @click="">Next ></a>
                </li>
            </ul>
        </div>
    </div>
</template>
