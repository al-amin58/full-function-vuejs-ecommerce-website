<template>
    <div class="d-flex align-items-center justify-content-between mx-0 row my-4 pt-1">
        <div class="col-sm-12 col-md-5">
            <p class="text-shadow fw-medium iso-text-color iso-underline">
                Showing
                <span class="secondary-color">{{ from }}</span>
                to
                <span class="secondary-color">{{ to }}</span>
                of
                <span class="secondary-color">{{ total }}</span>
                entries
            </p>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="d-flex align-items-center justify-content-end">
                <ul class="pagination flex bg-white p-2  shadow rounded gap-2">
                    <li
                        class="paginate_button page-item"
                        v-for="(link) in links"
                        :class="{ 'active' : link.active }" :key="link.id"
                    >
                        <Link :href="link.url" class="page-link" v-html="link.id" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        links: {
            type: Array
        },
        from: {
            type: Number,
            default: 0
        },
        to: {
            type: Number,
            default: 3
        },
        total: {
            type: Number,
            default: 10
        },
    })
</script>
