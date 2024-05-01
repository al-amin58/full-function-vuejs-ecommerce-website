<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="d-block">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
