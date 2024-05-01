<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head } from '@inertiajs/vue3'
import { useForm } from "@inertiajs/vue3"
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'

const props = defineProps({
    categories:Array,
    subCategories:Array,
    errors:Array,
})

const url = ref(null);
const newUrl = ref(null);
const parentIdError = ref(null);


const form = useForm({
    name: null,
    image:null,
    parent_id:null,
})
const onFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;
    newCategory.image = file;
    url.value = URL.createObjectURL(file);
    newUrl.value = URL.createObjectURL(file);
}

const addCategory = () =>
{
    if(form.parent_id == null) {
        parentIdError.value = "The Parent Category Field is Required.";
    }else {
        router.post('/categories', {...form})
        form.reset()
        url.value = null
    }
}


const newCategory = useForm({
    id: null,
    name: null,
    image:null,
    parent_id: 0,
});
const editCategory = (category) => {
    document.getElementById('editCategory').$vb.modal.show()
    newCategory.id = category.id,
    newCategory.parent_id = category.parent_id,
    newCategory.name = category.name,
    newCategory.image = category.image,
    newUrl.value = category.image
}

const updateCategory = (id) => {
    url.value = null,
    newUrl.value = null,
    router.post(`/update-category/${id}`, newCategory);
    newCategory.reset();
    document.getElementById('editCategory').$vb.modal.hide()
}
</script>

<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <div class="category">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- All Category -->
                    <div class="category-all ">
                        <header class="p-4 bg-white shadow rounded">
                            <h2>Sub Categories</h2>
                        </header>
                        <transition name="fade" class="d-flex flex-column gap-3 my-3">
                            <div>
                                <div v-for="category in subCategories" class="category d-flex align-items-center gap-3 bg-white shadow rounded px-3 py-2">
                                    <div>
                                        <img :src="category.image" alt="Category" style="width:70px;height:50px;object-fit:cover;border-radius:4px">
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                        <h3 class="fs-4">{{ category.name }}</h3>
                                        <div class="d-flex gap-2 actions">
                                            <button @click="editCategory(category)" class="edit" style="width:30px;height:30px;">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <Link :href="`/categories/${category.id}`" method="delete"  class="delete" preserve-scroll style="width:30px;height:30px;">
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
                        <h2 class="mb-4">Add new Category</h2>
                        <form @submit.prevent="addCategory">
                            <div class="mb-3">
                                <InputLabel
                                    for="Parent Category"
                                    value="Parent Category"
                                    class="d-block mb-2"
                                />

                                <v-select
                                    label="name"
                                    v-model="form.parent_id"
                                    :reduce="category => category.id"
                                    :options="categories"
                                    :searchable="false"
                                    return-object
                                    class="bt-border-color"
                                ></v-select>
                                <InputError v-if="parentIdError" :message="parentIdError" />

                            </div>
                            <div class="mb-3">
                                <InputLabel
                                    for="name"
                                    value="Category Name"
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
                            <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Add Category</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <Modal id="editCategory" v-vb-is:modal>
            <div class="category-add">
                <h2 class="mb-4">Update Category</h2>
                <form @submit.prevent="updateCategory(newCategory.id)">
                    <div class="mb-3">
                        <span class="text-secondary border d-block rounded p-1 mb-3" style="font-size: 12px;">If you remove the parent category, the updated category will become a parent category by default.</span>
                        <InputLabel
                            for="Parent Category"
                            value="Parent Category"
                            class="d-block mb-2"
                        />

                        <v-select
                            label="name"
                            v-model="newCategory.parent_id"
                            :reduce="category => category.id"
                            :options="categories"
                            :searchable="false"
                            return-object
                            class="bt-border-color"
                        ></v-select>


                    </div>
                    <div class="mb-3">
                        <InputLabel
                            for="name"
                            value="Category Name"
                            class="d-block mb-2"
                        />

                        <TextInput
                            class="bt-border-color w-100 p-2"
                            v-model="newCategory.name"

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
                    <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Update Category</PrimaryButton>
                </form>
            </div>
        </Modal>
    </AuthenticatedLayout>

    <Modal id="editCategory" v-vb-is:modal>
        <h3>Edit Category</h3>
    </Modal>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
