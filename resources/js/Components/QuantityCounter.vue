<script setup>
    import { ref } from 'vue'


    const emit = defineEmits(['update:modelValue'])
    const decrement =  () => emit('update:modelValue', quantity.value--)
    const increment =  () => emit('update:modelValue', quantity.value++)

    const props = defineProps({
        modelValue:Number
    })

    const quantity = ref(props.modelValue)



</script>

<template>
    <div class="quantity">
        <button @click.prevent="decrement" :disabled="quantity <= 0">&mdash;</button>
        <input type="text" :value="props.modelValue" readonly>
        <button @click.prevent="increment">&#xff0b;</button>
    </div>
</template>

<style lang="scss" scoped>
    .quantity {
        display: inline-flex;
        align-items: center;
        border: 1px solid black;
        width: 150px;
        button {
            width: 33.33%;
        }
        input {
            text-align: center;
            width: 33.33%;
            height: 44px;
            border: none;
            border-inline: 1px solid black;
        }
    }
</style>
