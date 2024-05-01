<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="min-h-100 d-flex align-items-center justify-content-center">
            <div class="login shadow">
                <div class="mb-4">
                    This is a secure area of the application. Please confirm your password before continuing.
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 d-block w-100"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Confirm
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
