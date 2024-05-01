<script setup>
const props = defineProps({
    id: {
        type: String,
    }
})
</script>

<template>
    <!-- Modal -->
    <div class="modal fade"
         :id="id" tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-scrollable">

            <div class="modal-content p-4 border-none"
                 style="min-height:220px"
            >
                <!-- Close Button -->
                <button data-bs-dismiss="modal" aria-label="Close" class="modal-close">
                    <span class="modal-close-text">Close</span>
                    <span class="modal-close-icon">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </button>
                <!-- Content -->
                <slot></slot>

            </div>
        </div>
    </div>
</template>
