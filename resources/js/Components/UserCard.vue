<script setup>
import {Link} from "@inertiajs/vue3";
import { ref } from 'vue'

const isLink = ref(false)

const props = defineProps({
    name: {
        type: String,
        default: "Developer Name"
    },
    role: {
        type: String,
        default: "Developer"
    },
    id: {
        type: Number,
        default: 0
    }
})
</script>

<template>
    <div class="col-lg-4 col-md-6 col-12">
        <div class="user-card">
            <button class="toggle" @click="isLink = !isLink"><i class="bi bi-three-dots"></i></button>
            <div class="user-card-head">
                <img src="https://img.freepik.com/free-photo/medium-shot-man-posing-studio_23-2150275677.jpg?size=626&ext=jpg&uid=R102446229&ga=GA1.1.1632597065.1693842988&semt=sph" alt="Developer">
            </div>
            <div class="user-card-body">
                <h3>{{ name }}</h3>
                <span>{{ role }}</span>
                <ul class="user-card-body-links" :class="{'toggled': isLink}">
                    <li>
                        <Link :href="`/developer/${id}`" class="link link--view">
                            <i class="bi bi-eye"></i>
                        </Link>
                    </li>
                    <li>
                        <Link href="#" class="link link--edit">
                            <i class="bi bi-pencil-square"></i>
                        </Link>
                    </li>
                    <li>
                        <Link :href="`/developer-delete/${id}`" class="link link--delete" method="get" preserve-scroll>
                            <i class="bi bi-trash"></i>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
