<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link, Head} from "@inertiajs/vue3";
const props = defineProps({

    products:Array
})
</script>

<template>
    <Head title="Products" />
    <AuthenticatedLayout>
        <div class="d-flex align-items-center justify-content-between">
            <h2>All Products</h2>
            <Link  href="/dashboard/add-product" class="button-primary">
                <i class="bi bi-plus-lg fs-4"></i> Add New Product
            </Link>
        </div>
        <div class="row mt-5">
            <div class="col-lg-10">
                <div class="d-flex flex-column gap-3">
                    <div class="property shadow" v-for="product in products" :key="product.id">
                        <div class="property-images">
                            <img :src="product.images[0]?.url">
                        </div>
                        <div class="property-detail">
                            <h3 class="property-detail-title mb-1">
                                <Link href="/product-detail" class="iso-hover-primary">{{ product.title }}</Link>
                            </h3>
                            <div class="py-2 d-flex align-items-center gap-2">
                                <span class="primary-bg text-white py-1 px-3 rounded-5 d-inline-block">{{ product.category.name }}</span>
                                <span class="bg-secondary text-white py-1 px-3 rounded-5 d-inline-block">{{ product?.brand.name }}</span>
                            </div>
                            <ul class="d-flex align-items-center justify-content-end gap-2 actions">
                                <li>
                                    <Link :href="`/dashboard/edit-product/${product.slug}`" class="edit" methods="get">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="`/delete-product/${product.id}`" method="get"  class="delete" preserve-scroll>
                                        <i class="bi bi-trash"></i> Delete
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
