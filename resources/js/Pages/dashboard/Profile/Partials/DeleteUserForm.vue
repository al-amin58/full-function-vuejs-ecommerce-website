<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/TailwindModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
<!--    <section class="bg-white p-4 shadow rounded">-->
<!--        <header class="mb-3">-->
<!--            <h2 class="mb-2">Delete Account</h2>-->

<!--            <p>-->
<!--                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting-->
<!--                your account, please download any data or information that you wish to retain.-->
<!--            </p>-->
<!--        </header>-->

<!--        <button @click="confirmUserDeletion" class="button-primary button-primary&#45;&#45;outline">Delete Account</button>-->

<!--        <Modal :show="confirmingUserDeletion" @close="closeModal">-->
<!--            <div style="max-width: 500px">-->
<!--                <h2>-->
<!--                    Are you sure you want to delete your account?-->
<!--                </h2>-->

<!--                <p>-->
<!--                    Once your account is deleted, all of its resources and data will be permanently deleted. Please-->
<!--                    enter your password to confirm you would like to permanently delete your account.-->
<!--                </p>-->

<!--                <div class="mt-6">-->
<!--                    <InputLabel for="password" value="Password" class="sr-only" />-->

<!--                    <TextInput-->
<!--                        id="password"-->
<!--                        ref="passwordInput"-->
<!--                        v-model="form.password"-->
<!--                        type="password"-->
<!--                        class=""-->
<!--                        placeholder="Password"-->
<!--                        @keyup.enter="deleteUser"-->
<!--                    />-->

<!--                    <InputError :message="form.errors.password" class="mt-2" />-->
<!--                </div>-->

<!--                <div class="d-flex justify-content-end">-->
<!--                    <PrimaryButton @click="closeModal"> Cancel </PrimaryButton>-->

<!--                    <button-->
<!--                        class="button-primary"-->
<!--                        :class="{ 'opacity-25': form.processing }"-->
<!--                        :disabled="form.processing"-->
<!--                        @click="deleteUser"-->
<!--                    >-->
<!--                        Delete Account-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </Modal>-->
<!--    </section>-->
</template>
