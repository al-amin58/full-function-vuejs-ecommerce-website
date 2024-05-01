<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="min-h-100 d-flex align-items-center justify-content-center">
            <div class="login shadow">
                <div class="mb-4">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
                    we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </div>

                <div class="mb-4" v-if="verificationLinkSent">
                    A new verification link has been sent to the email address you provided during registration.
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-4 d-flex align-items-center justify-content-between">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Resend Verification Email
                        </PrimaryButton>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class=""
                            >Log Out</Link
                        >
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
