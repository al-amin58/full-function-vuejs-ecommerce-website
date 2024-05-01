<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: 'admin@admin.com',
    password: '12345678',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
    console.log(form);
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="d-flex align-items-center justify-content-center min-vh-100">
            <div class="login shadow">
                <h3 class="text-center py-3">Login</h3>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 d-block w-100"
                            v-model="form.email"
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-3">
                        <InputLabel for="password" value="Password" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 d-block w-100"
                            v-model="form.password"
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <label class="d-flex">
                            <div>
                                <Checkbox name="remember" v-model:checked="form.remember" />
                            </div>
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
<!--                        <Link-->
<!--                            v-if="canResetPassword"-->
<!--                            :href="route('password.request')"-->
<!--                            class="primary-color"-->
<!--                        >-->
<!--                            Forgot your password?-->
<!--                        </Link>-->
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
