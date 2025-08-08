<script setup>
import { reactive, ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
const props = defineProps({
    errs: Object,
});
//

const showPass = ref(false);
const pages = usePage();
function togglePass() {
    return (showPass.value = !showPass.value);
}

const formData = reactive({
    _token: pages.props.auth.csrf,
    nik: null,
    nama: null,
    user: null,
    password: null,
    confirm_password: null,
});

function submitUser() {
    router.post("/user", formData, {
        onSuccess: () => {
            router.get("/user");
        },
    });
}
</script>

<template>
    <div class="modal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button
                        type="button"
                        class="btn-close"
                        @click="$emit('toggle')"
                    ></button>
                </div>
                <form @submit.prevent="submitUser">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nik</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="formData.nik"
                                placeholder="Your Nik ID"
                                :class="{ 'is-invalid': errs.nik }"
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="formData.nama"
                                placeholder="Your Name"
                                :class="{ 'is-invalid': errs.nama }"
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Your User"
                                v-model="formData.user"
                                :class="{ 'is-invalid': errs.user }"
                            />
                        </div>
                        <div class="mb-2">
                            <label class="form-label"> Password </label>
                            <div class="input-group input-group-flat">
                                <input
                                    :type="showPass ? 'text' : 'password'"
                                    class="form-control"
                                    v-model="formData.password"
                                    :class="{
                                        'is-invalid': errs.password,
                                    }"
                                    placeholder="Your password"
                                    autocomplete="off"
                                />
                                <span class="input-group-text">
                                    <a
                                        @click="togglePass"
                                        class="link-secondary"
                                        title="Show password"
                                        data-bs-toggle="tooltip"
                                        ><!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
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
                                                d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"
                                            />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"
                                            /></svg
                                    ></a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Confirm Password </label>
                            <div class="input-group input-group-flat">
                                <input
                                    :type="showPass ? 'text' : 'password'"
                                    class="form-control"
                                    v-model="formData.confirm_password"
                                    placeholder="Confirm password"
                                    :class="{
                                        'is-invalid': errs.confirm_password,
                                    }"
                                />
                                <span class="input-group-text">
                                    <a
                                        @click="togglePass"
                                        class="link-secondary"
                                        title="Show password"
                                        data-bs-toggle="tooltip"
                                        ><!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
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
                                                d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"
                                            />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"
                                            /></svg
                                    ></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            @click="$emit('toggle')"
                            class="btn me-auto"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            data-bs-dismiss="modal"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal {
    display: block;
}
</style>
