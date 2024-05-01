<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="fs-5 primary-color mt-1">
            {{ message }}
        </p>
    </div>
</template>
