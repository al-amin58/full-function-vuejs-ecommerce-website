<template>
    <SummernoteEditor
        v-model="myValue"
        
    />
</template>
<script setup>
import  SummernoteEditor  from 'vue3-summernote-editor';
import { ref } from 'vue';

const myValue = ref('');
</script>
