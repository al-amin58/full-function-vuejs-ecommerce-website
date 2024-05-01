<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { watch, ref, onMounted } from 'vue';
import {Link, useForm, Head} from '@inertiajs/vue3'
import ProductCard from "@/Components/ProductCard.vue";
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

const filterProducts = ref(null);
const props = defineProps({
    products:Array,
    categories: Array,
    brands: Array
})

const breakpoints = {
    // 700px and up
    700: {
        itemsToShow: 2,
        snapAlign: 'center',
    },
    // 1024 and up
    1024: {
        itemsToShow: 3,
        snapAlign: 'start',
    },
    1244: {
        itemsToShow: 5,
        snapAlign: 'start',
    },
}



const query = useForm({
    category_id: null,
    brand_id: null,
})

const loadBesicData = async(events) => {
    const response = await axios.get('/mejor-home-appliances',{params:{...events}});

    filterProducts.value = response.data;
}

onMounted(async () => {
    await loadBesicData();
});
watch(() => {
    return [query.category_id, query.brand_id];
}, async ([category_id, brand_id]) => {
    try {
        await loadBesicData({
            category_id,
            brand_id
        })
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

</script>

<template>
    <Head title="Textile Machinery's & Lab Testing Equipments Supplier in Bangladesh" />
    <AppLayout>
        <section>
            <div class="container">
                <div class="d-flex gap-5">
                    <div class="d-block">
                        <ul class="header-links shadow vh-60">
                            <li v-for="category in categories" :key="category.id">
                                <Link href="/products" :data="{category_id: category.id}" method="get" class="header-links-item border-bottom d-flex align-items-center gap-2" preserve-scroll>
                                    <img :src="category.image" style="width:20px;height:20px;">
                                    {{ category.name }}

                                    <div class="dropDown shadow" v-if="category?.children_recursive?.length > 0">
                                        <ul class="dropDownItem">
                                            <li v-for="item in category.children_recursive">
                                                <Link href="/products" :data="{category_id: item.id}" method="get" class="header-links-item border-bottom d-flex align-items-center gap-2" preserve-scroll>
                                                    <img :src="item.image" style="width:20px;height:20px;">
                                                    {{ item.name }}
                                                </Link>
                                            </li>
                                        </ul>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 ps-0">
                            <div class="vh-60">
                                <Carousel :autoplay="2000" :wrap-around="true">
                                    <Slide v-for="slide in 3" :key="slide">
                                        <div class="carousel__item w-100">
                                            <img src="https://bttexaccess.com/newbackup/application/storage/app/medias//491b15xI0qiOBqGQola4fAkl5whx39lSbHm9jbB6.jpg"
                                                 class="d-block w-100 h-100 object-fit-cover"
                                                 alt="">
                                        </div>
                                    </Slide>

                                    <template #addons>
                                        <Navigation />
                                    </template>
                                </Carousel>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex flex-column vh-60">
                                <div class="h-50 pb-2">
                                    <img src="https://bttexaccess.com/newbackup/application/storage/app/medias/NwyumrwHns6eqNLAUtnbYpMD78xgGOOzYA5RC13G.jpg"
                                         class="d-block w-100 h-100"
                                         alt="">
                                </div>
                                <div class="h-50 pt-2">
                                    <img src="https://bttexaccess.com/newbackup/application/storage/app/medias/QzUbrfkScWymfWKvmv6GmOoVsE3BZWbMF0bPMjgA.jpg"
                                         class="d-block w-100 h-100"
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5 mb-5">
            <div class="container p-5">
                <div class="row ">
                    <div class="col-lg-3">
                        <div class="icon-box  p-4">
                            <div class="icon">
                                <i class="bi bi-send-fill"></i>
                            </div>
                            <h4>HIGHEST QUALITY</h4>
                            <p>Guaranteed Excellence We ensure 100% quality with products.</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-box  p-4">
                            <div class="icon">
                                <i class="bi bi-envelope-paper"></i>
                            </div>
                            <h4>CUSTOMER SUPPORT</h4>
                            <p>Dedicated Service Team Our team is available from 9.30am to 7pm</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-box  p-4">
                            <div class="icon">
                                <i class="bi bi-coin"></i>
                            </div>
                            <h4>DELIVERY</h4>
                            <p>Fastest Delivery across Bangladesh Fast delivery within 2-48 hours</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-box p-4 ">
                            <div class="icon">
                                <i class="bi bi-window-stack"></i>
                            </div>
                            <h4>EASY RETURN & REFUND</h4>
                            <p>Easy Retrun & Refund You Will Get a Return and Refund within 7 Days</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="category-section py-5">
            <div class="container">
                <Carousel :items-to-show="8" :autoplay="2000" :wrap-around="true">
                    <Slide v-for="category in categories"  :key="category.id">
                        <Link href="/products" :data="{category_id: category.id}" method="get" class="category-section-card h-100  bg-white w-100 mx-2 overflow-hidden">
                            <div class="mb-2">
                                <img :src="category.image" :alt="category.name">
                            </div>
                            <div>
                                <h3 class="text-center">{{  category.name }}</h3>
                            </div>
                        </Link>
                    </Slide>
                </Carousel>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h2 class="mb-4">Featured Products</h2>
                <div>
                    <carousel :items-to-show="5" :autoplay="2000"  :wrap-around="true" :breakpoints="breakpoints">
                        <slide v-for="product in products" :key="product.id">
                            <div class="mx-2 ">
                                <ProductCard :info="product" class="w-100" />
                            </div>
                        </slide>
                        <template #addons>
                            <pagination />
                        </template>
                    </carousel>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h2 class="mb-4">Top Selling Products</h2>
                <div>
                    <carousel :items-to-show="5"  :autoplay="1500" :wrap-around="true" :breakpoints="breakpoints">
                        <slide v-for="product in products" :key="product.id">
                            <div class="mx-2 ">
                                <ProductCard :info="product" class="w-100" />
                            </div>
                        </slide>
                        <template #addons>
                            <pagination />
                        </template>
                    </carousel>
                </div>
            </div>
        </section>
        <section class="py-5 product-filter-section">
            <div class="container border overflow-hidden" >
                <div class="d-flex align-items-center justify-content-between p-3  mx-n4 border-bottom" style="background-color: #f2f2f2">
                    <h3>Major Home Appliances</h3>
                    <ul class="d-flex gap-3 flex-wrap">
                        <li class="brand">
                            <input
                                type="radio"
                                id="all"
                                value="all"
                                name="brand"
                                @click="query.brand_id = null"
                                checked
                                hidden>
                            <label for="all" class="shadow" >All</label>
                        </li>
                        <li v-for="brand in brands" :key="brand.id" class="brand">
                            <input
                                type="radio"
                                :id="`brand-${brand.id}`"
                                :value="brand.id"
                                v-model="query.brand_id"
                                name="brand"
                                hidden>
                            <label :for="`brand-${brand.id}`" class="shadow">{{ brand.name }}</label>
                        </li>
                    </ul>
                </div>
                <div class="row p-0 " style="min-height: 400px;">
                    <div class="col-lg-2 p-0 ms-n2"  style="background: #f2f2f2">
                        <ul class="links shadow h-100  ">

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
                    <div class="col-lg-10 pe-0">

                        <div class="row row-cols-lg-2 row-cols-lg-4 products p-3">
                            <ProductCard v-for="product in filterProducts" :info="product" :key="product.id"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>


<style  lang="scss"scoped>
.carousel__prev,
.carousel__next {
    box-sizing: content-box;
    border: 5px solid white;
}


</style>
