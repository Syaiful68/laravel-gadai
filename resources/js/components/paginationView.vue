<script setup>
const props = defineProps({
    data: Object,
});
</script>

<template>
    <div class="row g-2 justify-content-center justify-content-sm-between">
        <div class="col-auto d-flex align-items-center">
            <p class="m-0 text-secondary">
                Showing
                <strong>{{ data.from }} to {{ data.to }}</strong>
            </p>
        </div>

        <div class="col-auto">
            <ul class="pagination m-0 ms-auto">
                <li class="page-item" v-if="props.data.prev_page_url !== null">
                    <a class="page-link" :href="props.data.prev_page_url"
                        >< Prev</a
                    >
                </li>
                <li class="page-item" v-if="props.data.next_page_url !== null">
                    <a class="page-link" :href="props.data.next_page_url"
                        >Next ></a
                    >
                </li>
            </ul>
        </div>
    </div>
</template>
