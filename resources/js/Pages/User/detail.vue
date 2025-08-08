<script setup>
import { reactive } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import Layout from "../Layout/app.vue";
import Headers from "./partials/headers.vue";

const props = defineProps({
    data: Object,
});
const page = usePage();

const title = "Users";
const subtitle = "User Detail";

const formData = reactive({
    _token: page.props.auth.csrf,
    nik: props.data.nik,
    nama: props.data.nama,
    user: props.data.user,
    password: null,
    role: props.data.roles,
});

function UpdateUser() {
    return router.patch("/user/" + props.data.user, formData);
}
</script>

<template>
    <Layout>
        <Headers :title="title" :subtitle="subtitle"></Headers>
        <div class="page-body">
            <div class="container-xl">
                <form @submit.prevent="UpdateUser">
                    <div class="row row-deck row-cards">
                        <div class="col-sm-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nik</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.nik"
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.nama"
                                            disabled
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">User</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.user"
                                            disabled
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            >Password</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.password"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">roles</label>
                                        <select
                                            class="form-control"
                                            v-model="formData.role"
                                        >
                                            <option value="">Choise</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>
