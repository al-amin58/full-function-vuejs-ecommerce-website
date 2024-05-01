<script setup>
import {Link, router, useForm} from "@inertiajs/vue3";
import {watch, ref, onMounted, onBeforeUnmount} from "vue";
import axios from 'axios'

const isPreview = ref(false);
const handleClickOutside = (event) => {
    const searchPreview = document.querySelector('#search-preview');

    if (searchPreview && !searchPreview.contains(event.target)) {
        isPreview.value = true;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});

const products = ref(null)

const form = useForm({
    query: null
});

watch(() => form.query, (query) => {
    isPreview.value = false;
    axios.get(`/search?query=${query}`)
        .then(response => {
            products.value = response.data;
        })
        .catch(error => {
            console.error(error);
        });
});


if(products?.length > 0) {
    isPreview.value = true;
}


const hoverProduct = ref(null)

const getProduct = (product) => {
    hoverProduct.value = product
}



const search = () => {
    router.get('/products', form);
}
</script>

<template>
    <div class="search">
        <div class="d-flex align-items-center">
            <input type="text"  v-model="form.query">
            <button class="primary-bg rounded-0 text-white" @click="search">Search</button>
        </div>

        <div class="search-preview shadow" :class="{'d-none' : isPreview}" id="search-preview" v-if="products !== null && products?.length > 0">
            <div class="d-flex">
                <div :class="{'col-6' : hoverProduct?.length > 0}">
                    <ul class="search-preview-list">
                        <li v-for="product in products" :key="product.id">
                            <Link class="search-preview-list-item" @mouseover="getProduct(product)">
                                <div>
                                    <img :src="product.images[0].url" alt="">
                                </div>
                                <div>
                                    <h4>
                                        <Link :href="`/product/${product?.slug}`">{{ product.title.slice(0, 30) }}...</Link>
                                    </h4>
                                </div>
                            </Link>
                        </li>
                    </ul>
                </div>
                <div class="col-6" v-if="hoverProduct !== null">
                    <div class="search-preview-single p-3">
                        <Link to="" class="p-1 mb-2">
                            <img :src="hoverProduct?.images[0].url" alt="">
                        </Link>
                        <h3>
                            <Link :href="`/product/${hoverProduct?.slug}`">{{  hoverProduct?.title.slice(0, 30) }}...</Link>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
