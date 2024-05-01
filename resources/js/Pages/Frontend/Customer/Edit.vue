<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AppLayout>
        <template #header>
            <h2>Profile</h2>
        </template>

        <div class="row flex-column align-items-center py-5">
            <div class="mb-4 col-lg-6">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                />
            </div>

            <div class="mb-4 col-lg-6">
                <UpdatePasswordForm  />
            </div>

            <div class="mb-4  col-lg-6">
                <DeleteUserForm />
            </div>
        </div>
    </AppLayout>
</template>
