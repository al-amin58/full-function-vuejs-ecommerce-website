<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
import {Link, router, useForm, Head} from "@inertiajs/vue3";
import {watch} from "vue";

const props = defineProps({
    products: Array,
    categories: Array,
    brands: Array
})


const query = useForm({
    category_id: null,
    brand_id: null,
})

watch(() => {
    return [query.category_id, query.brand_id];
}, ([category_id, brand_id]) => {
    router.get('/products', { category_id, brand_id }, { preserveScroll: true });
});

</script>

<template>
    <Head title="All Product" />
    <AppLayout>
        <section>
            <div class="container product-filter-section">
                <div class="row">
                    <div class="w-20">
                        <div style="background-color:#f2f2f2" class="py-4 px-2">
                            <div class="mb-3">
                                <h3 class="mb-2">Categories</h3>
                                <ul class="links h-100">
                                    <li v-for="category in categories" :key="category.id">

                                        <input
                                            type="radio"
                                            :id="`category-${category.id}`"
                                            :value="category.id"
                                            v-model="query.category_id"
                                            name="category"
                                            hidden>

                                        <label :for="`category-${category.id}`" class="links-item border-bottom">{{ category.name }}</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h3 class="mb-2">Brands</h3>
                                <ul class="d-flex flex-column links">
                                    <li v-for="brand in brands" :key="brand.id" class="brand">
                                        <input
                                            type="radio"
                                            :id="`brand-${brand.id}`"
                                            :value="brand.id"
                                            v-model="query.brand_id"
                                            name="brand"
                                            hidden >
                                        <label :for="`brand-${brand.id}`" class="links-item border-bottom">{{ brand.name }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-80">
                        <div class="row row-cols-2 row-cols-lg-4">
                            <ProductCard v-for="product in products" :info="product" :key="product.id"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
