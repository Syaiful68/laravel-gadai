<script setup>
import TableView from "../../../components/TableView.vue";
const props = defineProps({
    angsuran: Object,
});

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}
</script>
<template>
    <TableView>
        <template #headers>
            <div class="d-flex">
                <h4 class="title-table">List Angsuran</h4>
                <div class="ms-auto">
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="$emit('onToggle')"
                    >
                        <i class="fas fa-plus me-2"></i>
                        Add
                    </button>
                </div>
            </div>
        </template>
        <template #body>
            <table
                class="table table-selectable card-table table-vcenter text-nowrap datatable"
            >
                <thead>
                    <tr>
                        <th>Code Pinjam</th>
                        <th>Nominal Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Sisa Bayar</th>
                        <th>Payment type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in angsuran" :key="index">
                        <td>{{ item.pinjaman.code_pinjam }}</td>
                        <td>Rp. {{ fcurrency(item.nominal) }}</td>
                        <td>{{ item.do_date }}</td>
                        <td>Rp. {{ fcurrency(item.sisa_bayar) }}</td>
                        <td>{{ item.payment_type }}</td>
                    </tr>
                </tbody>
            </table>
        </template>
    </TableView>
</template>
