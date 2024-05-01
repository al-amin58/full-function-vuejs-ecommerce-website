<script setup>
import debounce from "lodash/debounce";
import {computed, onMounted, ref, watch} from 'vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from '@inertiajs/vue3'

import { format } from 'date-fns'

const props = defineProps({
    pages:[] | null,
    main_url:String | null,
    filters: Object,
});


const FRONTEND_URL = 'https://isoholdings.com'

const search = ref();
const perPage = ref();

watch([search, perPage], debounce(function ([val, val2]) {
    Inertia.get(props.main_url, { search: val, perPage: val2 }, { preserveState: true, replace: true });
}, 300));

computed(() => {
    $sToast.fire({
        icon: 'success',
        title: usePage().props.value.message
    })
});
</script>

<template>
    <Head title="Pages" />
    <AuthenticatedLayout>
        <div>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="float-start mb-0">page List</h2>
                <a href="/pages/create" class="d-flex align-items-center gap-2 button-primary">
                    <i class="bi bi-plus fs-3"></i>
                    <span>Add New page</span>
                </a>
            </div>

            <section class="app-user-list">
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0 px-3">
                        <div class="d-flex align-items-center justify-content-between border-bottom mb-3 py-3">
                            <div class="select-search-area d-flex align-items-center">
                                <select class="form-select" v-model="perPage">
                                    <option :value="undefined">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                <div class="select-search-area">
                                    <label>Search
                                        <input v-model="search"
                                            type="search"
                                            class="form-control"
                                            placeholder="What You Find ?"
                                            aria-controls="DataTables_Table_0">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <table class="page-list-table table">
                            <thead class="table-light">
                            <tr class=null>
                                <th class="sorting">Id</th>
                                <th class="sorting">title</th>
                                <th class="sorting">Summery</th>
                                <th class="sorting">Created At</th>
                                <th class="sorting">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="page in pages" :key="page.id" @dblclick="copyToClipboard(page.slug)">
                                <td>#_{{ page.id }}</td>
                                <td>
                                    <a :href="`${FRONTEND_URL}/iso/${page.slug}`" target="_blank" class="fs-4 primary-color" >{{ page.title }}</a>
                                </td>
                                <td>
                                    <div v-html="page.summery.slice(0, 200)"></div>
                                </td>
                                <td>
                                    {{  format(new Date(page.created_at), 'yyyy-MM-dd')}}
                                </td>
                                <td>
                                    <div class="actions d-flex gap-2">
                                        <a :href="`/pages/${page.id}/edit`" class="edit w-auto">
                                            <i class="bi bi-pencil-square"></i>
                                            <span class="ms-1">Edit</span>
                                        </a>
                                        <button class="delete w-auto" type="button" v-if="page.is_delete === 1"
                                                @click="deleteItem(props.main_url, page.id)">
                                            <i class="bi bi-trash"></i>
                                            <span class="ms-1">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination :links="pages.links" :from="pages.from" :to="pages.to" :total="pages.total"/>
                    </div>
                </div>
            </section>
        </div>

    </AuthenticatedLayout>
</template>
