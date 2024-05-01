<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <!-- Side Bar -->
    <aside class="side-bar">
        <div class="side-bar-header border-bottom">
<!--            <img src="@/assets/images/iso-logo.png" alt="Logo" class="logo">-->
            <h2>BTTEX ACCESS</h2>
        </div>
        <div class="side-bar-body">
            <ul class="side-bar-body-items">
                <li>
                    <Link
                        href="/dashboard"
                        class="side-bar-body-items-item"
                        :class="{'side-bar-body-items-item--active': $page.component === 'Dashboard'}"
                    >
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </Link>
                </li>

                <li>
                    <Link href="/dashboard/products"
                          class="side-bar-body-items-item"
                          :class="{'side-bar-body-items-item--active': $page.component === 'Properties/ManageProperty'}"
                    >
                        <i class="bi bi-boxes"></i>
                        <span>Manage Products</span>
                    </Link>
                </li>

                <li>
                    <a
                    
                    class="side-bar-body-items-item "
                    data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"
                    :class="{'side-bar-body-items-item--active': $page.component === 'Category'}"
                    >
                        <i class="bi bi-ui-checks-grid"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="collapse ms-2" id="collapseExample">
                        <li>
                            <Link
                                href="/categories"
                                class="side-bar-body-items-item gap-1"
                                :class="{'side-bar-body-items-item--active': $page.component === 'Brand'}"
                            >
                            <i class="bi bi-app fs-5"></i>
                                <span>Main Caytegory</span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/dashboard/sub-category"
                                class="side-bar-body-items-item gap-1"
                                :class="{'side-bar-body-items-item--active': $page.component === 'SubCategory'}"
                            >
                            <i class="bi bi-app fs-5"></i>
                                <span>Sub Caytegory</span>
                            </Link>
                        </li>
                    </ul>
                </li>

                <li>
                    <Link
                        href="/brands"
                        class="side-bar-body-items-item"
                        :class="{'side-bar-body-items-item--active': $page.component === 'Brand'}"
                    >
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Brands</span>
                    </Link>
                </li>

                <li>
                    <Link
                        href="/pages"
                        class="side-bar-body-items-item"
                        :class="{'side-bar-body-items-item--active': $page.url.startsWith('/pages')}"
                    >
                        <i class="bi bi-body-text"></i>
                        <span>Pages</span>
                    </Link>
                </li>
                <!-- Settings -->
                <li>
                    <Link
                    href="/dashboard/settings"
                    class="side-bar-body-items-item"
                    :class="{'side-bar-body-items-item--active': $page.url.startsWith('/dashboard/settings')}"
                    >
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>
