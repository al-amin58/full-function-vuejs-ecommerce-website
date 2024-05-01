<script setup>
import { Link } from '@inertiajs/vue3';
import SideBar from '@/Components/SideBar.vue';

const showingNavigationDropdown = ref(false);
import { ref, onMounted, onBeforeUnmount } from 'vue';

const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 0;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
});

</script>

<template>
    <div>
        <div class="layout">

            <SideBar />

            <!-- App Content -->
            <div class="app-content">
                <header class="app-content__header  shadow bg-white p-3 rounded d-flex align-items-center justify-content-between"
                        :class="{'scrolled-header': isScrolled}"
                >
                    <div>

                        <a  :href="$page.props.auth.APP_URL" target="_blank" class="button-primary">
                            <i class="bi bi-globe"></i> Visit Website
                        </a>
                    </div>
                    <ul role="button" class="d-flex align-items-center gap-3">

                        <li class="nav-item dropdown dropdown-user">
                            <Link class="nav-link dropdown-toggle d-flex gap-2" id="dropdown-user" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="">
                                    <h4 class="user-name fw-bolder">Admin User</h4>
                                    <p class="user-status">admin</p>
                                </div>
                                <span class="avatar">
                                    <img class="round" src="@/assets/images/avatar.png" alt="avatar" >
                                    <span class="avatar-status-online"></span>
                                </span>
                            </Link>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                                <Link class="dropdown-item" href="/profile">
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span>Profile</span>
                                </Link>
                                <div class="dropdown-divider"></div>
                                <Link href="/logout" method="post" class="dropdown-item w-100" as="button">
                                    <i class="bi bi-box-arrow-left"></i>
                                    <span>Log Out</span>
                                </Link>
                            </div>
                        </li>
                    </ul>
                </header>

                <main>
                    <slot />
                </main>

            </div>
        </div>
    </div>
</template>
