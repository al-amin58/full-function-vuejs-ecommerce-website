<script setup>
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import {ref} from "vue";



const props = defineProps({
    brands:Array,
    errors: Array,
})
const url = ref(null);
const newUrl = ref(null);



const form = useForm({
    name: null,
    image:null
})
const onFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;
    newBrand.image = file;
    url.value = URL.createObjectURL(file);
    newUrl.value = URL.createObjectURL(file);
}

function addBrand()
{
    router.post('/brands', {...form})
    form.reset()
    url.value = null
}

const newBrand = useForm({
    id: null,
    name: null,
    image:null,
});
const editBrand = (category) => {
    document.getElementById('editBrand').$vb.modal.show()
    newBrand.id = category.id,
    newBrand.name = category.name,
    newBrand.image = category.image,
    newUrl.value = category.image
}

const updateBrand = (id) => {
    url.value = null;
    newUrl.value = null;
    router.post(`/update-brand/${id}`, newBrand);
    newBrand.reset();
    document.getElementById('editBrand').$vb.modal.hide()

}

</script>

<template>
    <Head title="Brands" />
    <AuthenticatedLayout>
        <div class="category">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- All Brands -->
                    <div class="category-all ">
                        <header class="p-4 bg-white shadow rounded">
                            <h2>All Brand</h2>
                        </header>
                        <transition name="fade" class="d-flex flex-column gap-3 my-3">
                            <div>
                                <div v-for="brand in brands" class="category d-flex align-items-center gap-3 bg-white shadow rounded px-3 py-2">
                                    <div>
                                        <img :src="brand.image" alt="Category" style="width:70px;height:50px;object-fit:cover;border-radius:4px">
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                        <h3 class="fs-4">{{ brand.name }}</h3>
                                        <div class="d-flex gap-2 actions">
                                            <button @click="editBrand(brand)" class="edit" style="width:30px;height:30px;">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <Link :href="`/brands/${brand.id}`" method="delete"  class="delete" preserve-scroll style="width:30px;height:30px;">
                                                <i class="bi bi-trash"></i>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-12">
                    <!-- Category Form -->
                    <div class="category-add bg-white shadow rounded p-4">
                        <h2 class="mb-4">Add new Brand</h2>
                        <form @submit.prevent="addBrand">
                            <div class="mb-3">
                                <InputLabel
                                    for="name"
                                    value="Brand Name"
                                    class="d-block mb-2"
                                />

                                <TextInput
                                    class="bt-border-color w-100 p-2"
                                    v-model="form.name"
                                />
                                <InputError :message="errors.name" />
                            </div>
                            <div class="mb-4">
                                <InputLabel
                                    for="name"
                                    value="Add Image"
                                    class="d-block mb-2"
                                />
                                <div class="category-image">
                                    <label for="category-image">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <span>Upload Image</span>
                                        <TextInput
                                            type="file"
                                            id="category-image"

                                            @change="onFileChange"
                                        />
                                    </label>
                                    <div class="category-image-preview">
                                        <img v-if="url" :src="url" alt="">
                                    </div>
                                </div>
                                <InputError :message="errors.image" />
                            </div>
                            <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Add Brand</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <Modal id="editBrand" v-vb-is:modal>
            <div class="category-add">
                <h2 class="mb-4">Update Brand</h2>
                <form @submit.prevent="updateBrand(newBrand.id)">
                    <div class="mb-3">
                        <InputLabel
                            for="name"
                            value="Brand Name"
                            class="d-block mb-2"
                        />

                        <TextInput
                            class="bt-border-color w-100 p-2"
                            v-model="newBrand.name"
                        />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="mb-4">
                        <InputLabel
                            for="name"
                            value="Add Image"
                            class="d-block mb-2"
                        />
                        <div class="category-image">
                            <label for="category-image">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>Upload Image</span>
                                <TextInput
                                    type="file"
                                    id="category-image"

                                    @change="onFileChange"
                                />
                            </label>
                            <div class="category-image-preview">
                                <img v-if="newUrl" :src="newUrl" alt="">
                            </div>
                        </div>
                        <InputError :message="errors.image" />
                    </div>
                    <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Submit Brand</PrimaryButton>
                </form>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
