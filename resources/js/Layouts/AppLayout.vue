<script setup>
import { ref, onMounted} from 'vue';
import {Link} from '@inertiajs/vue3'
import Search from "@/Components/Search.vue";
import axios from "axios";


const products = ref(null);
const brands = ref(null);
const categories = ref(null);

const getProducts = async () => {
    await axios.get('/get-product-title')
        .then(response => {
            products.value = response.data;
            console.log(response);
        })
        .catch(error => {
            console.error(error);
        });
}
const getBrands = async() => {
    await axios.get('/get-brands')
        .then(response => {
            brands.value = response.data;
        })
        .catch(error => {
            console.error(error);
        });
}

const getCategories = async() => {
    await axios.get('/get-categories')
        .then(response => {
            categories.value = response.data;
        })
        .catch(error => {
            console.error(error);
        });
}

onMounted( () => {
    getProducts();
    getBrands();
    getCategories();
});

</script>

<template>
    <div class="bt-primary-bg d-flex align-items-center justify-content-center py-2 text-white">
        <marquee >
            <ul class="d-flex align-items-center" style="gap:100px">
                <li class="d-flex align-items-center gap-1">
                    <svg width="20px" height="20px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="16" height="16" id="icon-bound" fill="none"></rect> <path d="M10,1L3,9h4.5L6,15l7-8H8.5L10,1z"></path> </g></svg>
                    OFFICE HOURS: SAT - THU 9.30AM - 19.00PM (CLOSE ON WEEKEND)
                </li>
                <li class="d-flex align-items-center gap-1">
                    <svg width="20px" height="20px"    viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="16" height="16" id="icon-bound" fill="none"></rect> <path d="M10,1L3,9h4.5L6,15l7-8H8.5L10,1z"></path> </g></svg>
                    AVAILABLE 24/7 AT +8801716 284115
                </li>
                <li class="d-flex align-items-center gap-1">
                    <svg width="20px" height="20px"viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="16" height="16" id="icon-bound" fill="none"></rect> <path d="M10,1L3,9h4.5L6,15l7-8H8.5L10,1z"></path> </g></svg>
                    EMAIL: INFO@BTTEXACCESS.COM
                </li>
                <li class="d-flex align-items-center gap-1">
                    <svg width="20px" height="20px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="16" height="16" id="icon-bound" fill="none"></rect> <path d="M10,1L3,9h4.5L6,15l7-8H8.5L10,1z"></path> </g></svg>
                    CORPORATE OFFICE: GREEN SATMAHAL, HOUSE: 206-208, 4TH FLOOR (402-403), BORO MOGHBAZAR, DHAKA-1217, BANGLADESH
                </li>
            </ul>
        </marquee>
    </div>
    <div class="top-bar">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <Link href="/" class="logo">
                    <img src="https://bttexaccess.com/wp-content/uploads/2020/07/350x74_black.png" alt="">
                </Link>

                <Search />

                <div>
                    <Link href="/dashboard" class="d-flex align-items-center gap-2 text-white" v-if="$page.props.auth?.user?.type === 'admin'">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </Link>
                    <Link href="/customer/profile" class="d-flex align-items-center gap-2 text-white" v-else-if="$page.props.auth?.user?.type === 'Customer'">
                        <i class="bi bi-person-badge"></i>
                        <span>Profile</span>
                    </Link>
                    <Link href="/login" class="d-flex align-items-center gap-2 text-white" v-else>
                        <i class="bi bi-person fs-3"></i>
                        <span>Sign In</span>
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light p-0">
        <div class="container position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2 p-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link--category">
                            <i class="bi bi-list"></i>
                            Product Categories
                            <i class="bi bi-chevron-down"></i>

                            <ul class="categories">
                                <li v-for="category in categories" :key="category.id">
                                    <Link href="/products" :data="{category_id: category.id}" method="get" class="header-links-item border-bottom d-flex align-items-center gap-2" preserve-scroll>
                                        <img :src="category.image" style="width:20px;height:20px;">
                                        {{ category.name }}
                                    </Link>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <Link href="/" class="nav-link ">Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link href="/about" class="nav-link">About Us</Link>
                    </li>
                    <li class="nav-item megaMenu">
                        <Link href="/products" class="nav-link megaMenuLink">All Products</Link>

                        <div class="megaMenuItems" v-if="products !== null">
                            <div class="megaMenuContent">
                                <ul class="row" >
                                    <li class="col-lg-3" v-for="product in products">
                                        <Link :href="`/product/${product.slug}`" class="mb-2 text-dark"><span class="fs-3 d-inline-block">.</span> {{ product.title }}</Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item megaMenu">
                        <Link class="nav-link megaMenuLink">Brands</Link>

                        <div class="megaMenuItems" v-if="brands !== !null">
                            <div class="megaMenuContent">
                                <ul class="d-flex flex-wrap gap-3" >
                                    <li class="mb-2" v-for="brand in brands">
                                        <Link :href="`/products/${brand.id}`" class="mb-2 text-dark bg-white shadow rounded px-4 py-2 text-center">
                                            <img :src="brand.image" style="width:70px;height:70px;">
                                            <p class="text-dark fw-norlam fs-5">{{ brand.name}}</p>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <Link href="/contact" class="nav-link">Contact Us</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="bg-white">
        <slot></slot>
    </main>

    <footer class="border-top pt-5 pb-2 bg-dark">
        <div class="container border-bottom">
            <div class="row mb-3">
                <div class="col-lg-4 col-md-2 col-12">
                    <div class="footer-item">
                        <h3 class="text-white mb-3">B.T. TEX. ACCESS.</h3>
                        <ul>
                            <li class="mb-2">
                                <p class="text-white">House# 205, Level-2 Boro Moghbazar, Wireless Railgate, Ramna,</p>
                                <p class="text-white">Dhaka-1217, Bangladesh</p>
                            </li>
                            <li class="mb-2">
                                <h4 class="text-white mb-1">Phone</h4>
                                <a href="" class="text-white d-block">+8802-22222529</a>
                                <a href="" class="text-white">+8802-48315919</a>
                            </li>
                            <li>
                                <h4 class="text-white">Email</h4>
                                <a href="" class="text-white d-block">bttexaccess@ymail.com</a>
                                <a href="" class="text-white">aulad.btta@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-2 col-12">
                    <div class="footer-item">
                        <h3 class="text-white mb-3">QUICK CONTACT</h3>
                        <ul>
                            <li class="mb-2">
                                <h4 class="text-white mb-1">Sales Team</h4>
                                <a href="#" class="text-white d-block">+8801670 263463</a>
                                <a href="#" class="text-white">+8801613 722962</a>
                            </li>
                            <li class="mb-2">
                                <h4 class="text-white mb-1">Technical Team</h4>
                                <a href="" class="text-white">+8801613 722960</a>
                            </li>
                            <li class="mb-2">
                                <h4 class="text-white mb-1">Support Team</h4>
                                <a href="" class="text-white">+8801670 263465</a>
                            </li>
                            <li class="mb-2">
                                <h4 class="text-white mb-1">HOT LINE</h4>
                                <a href="" class="text-white">+8801716 284115</a>
                            </li>
                        </ul>
                    </div>
                </div>
<!--                <div class="col-lg-3 col-md-2 col-12">-->
<!--                    <div class="footer-item">-->
<!--                        <h3 class="text-white mb-3">Categories</h3>-->
<!--                        <ul class="d-flex flex-wrap gap-3">-->
<!--                            <li v-for="category in footerCats">-->
<!--                                <Link href="/products" :data="{category_id: category.id}" method="get" class="text-white primary-bg px-3 py-1 rounded-5">{{category.name}}</Link>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-lg-4 col-md-2 col-12">
                    <div>
                        <h3 style="margin-bottom:20px;" class="text-white mb-3">Follow Us</h3>
                        <ul class="socials">
                            <li>
                                <a href="#" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-lg-flex align-items-center justify-content-between pt-4 pb-3">
            <p class="text-white">&copy; {{ new Date().getFullYear() }} {{ $page.props?.auth?.APP_NAME }} All rights reserved.</p>
            <p class="text-white"><a class="text-white" href="https://creativetechpark.com/" target="_blank">Web Development Company </a> Creative Tech Park.</p>
        </div>
    </footer>
</template>



