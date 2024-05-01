<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import {router, useForm} from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3"
import Editor from '@/Components/Editor.vue'

const props = defineProps({
    product: Object,
    categories: Array,
    brands: Array
})


const inModal = () => document.getElementById('category').$vb.modal.show()


const handleFileChange = (event) => {
    for (let i = 0; i < event.target.files.length; i++) {
        form.newImage.push({
            url: URL.createObjectURL(event.target.files[i]),
            file: event.target.files[i],
        });
    }

    console.log(form.images);
};

const removeMedia = (index) => {
    let removedImage = form.images[index];
    if (removedImage.url.startsWith('blob:')) {
        URL.revokeObjectURL(removedImage.url);
    }
    form.images.splice(index, 1);
};


const url = ref(null);
const onFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;
    url.value = URL.createObjectURL(file);
}


const newCategory = useForm({
    name:null,
    image:null,
})

const form = useForm({
    title: props.product.title,
    short_description: props.product.short_description,
    description: props.product.description,
    category_id: props.product.category_id,
    brand_id: props.product.brand_id,
    spacification: props.product.spacification,
    warranty: props.product.warranty,
    images: props.product.images,
    newImage:[],
})



function editproduct()
{
    router.post(`/update-product/${props.product.slug}`, form);
}

function addNewCategory()
{
    router.post('/categories', newCategory);
    document.getElementById('type').$vb.modal.hide()
}

</script>

<template>
    <AuthenticatedLayout>

        <div class="row product-create-tab">
            <div class="col-lg-3">
                <div class="nav flex-column nav-pills bg-white shadow" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-td-tab" data-bs-toggle="pill" data-bs-target="#v-pills-td" type="button" role="tab" aria-controls="v-pills-td" aria-selected="true">Title & Short Description</button>
                    <button class="nav-link" id="v-pills-bg-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bg" type="button" role="tab" aria-controls="v-pills-bg" aria-selected="false">Brand & Category</button>
                    <button class="nav-link" id="v-pills-image-tab" data-bs-toggle="pill" data-bs-target="#v-pills-image" type="button" role="tab" aria-controls="v-pills-image" aria-selected="false">Image</button>
                    <button class="nav-link" id="v-pills-description-tab" data-bs-toggle="pill" data-bs-target="#v-pills-description" type="button" role="tab" aria-controls="v-pills-description" aria-selected="false">Descriotion</button>
                    <button class="nav-link" id="v-pills-spaci-tab" data-bs-toggle="pill" data-bs-target="#v-pills-spaci" type="button" role="tab" aria-controls="v-pills-spaci" aria-selected="false">Spacification</button>
                    <button class="nav-link" id="v-pills-warranty-tab" data-bs-toggle="pill" data-bs-target="#v-pills-warranty" type="button" role="tab" aria-controls="v-pills-warranty" aria-selected="false">Warranty</button>
                </div>
                
            </div>
            <div class="col-lg-9">
                <div class="bg-white shadow d-flex align-items-center justify-content-end gap-3 py-2 px-1 mb-3">
                    <Link class="button-primary button-primary--outline" href="/dashboard/products">Cencel</Link>
                    <button class="button-primary" @click="editproduct">Update Product</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-td" role="tabpanel" aria-labelledby="v-pills-td-tab" tabindex="0">
                        <div class="p-4 bg-white shadow mb-4">
                            <div class="mb-4">
                                <InputLabel value="Title"
                                class="text-dark fw-medium mb-2 fs-4"
                                />
                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    class="d-block w-100 p-2 bt-border-color" />

                            </div>
                            <div>
                                <InputLabel 
                                value="Add Product Short Description"
                                class="text-dark fw-medium mb-2 fs-4"
                                />
                                <Editor v-model="form.short_description" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-bg" role="tabpanel" aria-labelledby="v-pills-bg-tab" tabindex="0">
                        <div class="bg-white d-flex w-100 p-4 shadow">
                            <div class="d-flex align-items-center gap-2  py-5 px-4 w-50">
                                <div class="w-100">
                                    <v-select
                                        label="name"
                                        v-model="form.category_id"
                                        placeholder="Add Category.."
                                        :reduce="category => category.id"
                                        :options="categories"
                                        :searchable="false"
                                        return-object
                                    ></v-select>
                                </div>
                                <div>
                                    <button class="px-2 py-1 border rounded d-flex align-items-center primary-bg text-white" @click="inModal">
                                        <i class="bi bi-plus fs-3"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2  py-5 px-4 rounded  w-50">
                                <div class="w-100">
                                    <v-select
                                        label="name"
                                        v-model="form.brand_id"
                                        placeholder="Add Brand.."
                                        :reduce="brand => brand.id"
                                        :options="brands"
                                        :searchable="false"
                                        return-object
                                    ></v-select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-image" role="tabpanel" aria-labelledby="v-pills-image-tab" tabindex="0">
                        <div class="bg-white shadow p-5 rounded mb-4">
                            <h3 class="mb-3">Product Images</h3>
                            <div class="file-upload-container">
                                <div class="file-upload-container-wrapper">
                                    <!--IMAGES PREVIEW-->
                                    <div v-for="(image, index) in form.images"   class="file-upload-container-wrapper__preview" :key="index">
                                        <img :src="image.url" class="file-upload-container-wrapper__preview-item">
                                        <Link :href="`/delete-image/${image.id}`" method="get" preserve-scroll class="file-upload-container-wrapper__preview-cancel" type="button">
                                            <i class="bi bi-trash"></i>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white shadow">
                    <h4 class="pb-3">Image Upload Requirements</h4>
                    <ul style="list-style:disc;" class="ps-4 mb-4">
                        <li>1 MB limit.</li>
                        <li>Allowed types: <span class="primary-color"> JPG</span>, <span class="primary-color">JPEG</span>, <span class="primary-color">PNG</span>.</li>
                    </ul>
                    <div class="file-upload-container">
                        <div class="file-upload-container-wrapper">
                            <!--IMAGES PREVIEW-->
                            <div v-for="(image, index) in form.newImage"   class="file-upload-container-wrapper__preview" :key="image.index">
                                <img :src="image.url" class="file-upload-container-wrapper__preview-item">
                                <button @click="removeMedia(index)"  class="file-upload-container-wrapper__preview-cancel" type="button">
                                    <svg viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="work-case" fill="currentColor" transform="translate(91.520000, 91.520000)"> <polygon id="Close" points="328.96 30.2933333 298.666667 1.42108547e-14 164.48 134.4 30.2933333 1.42108547e-14 1.42108547e-14 30.2933333 134.4 164.48 1.42108547e-14 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48"> </polygon> </g> </g> </g></svg>
                                </button>
                            </div>
                            <!--UPLOAD BUTTON-->
                            <div class="file-upload-container-wrapper__add">
                                <label for="mu-file-input" class="file-upload-container__add-btn">
                                            <span>
                                                <svg viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#D74825"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M736.68 435.86a173.773 173.773 0 0 1 172.042 172.038c0.578 44.907-18.093 87.822-48.461 119.698-32.761 34.387-76.991 51.744-123.581 52.343-68.202 0.876-68.284 106.718 0 105.841 152.654-1.964 275.918-125.229 277.883-277.883 1.964-152.664-128.188-275.956-277.883-277.879-68.284-0.878-68.202 104.965 0 105.842zM285.262 779.307A173.773 173.773 0 0 1 113.22 607.266c-0.577-44.909 18.09-87.823 48.461-119.705 32.759-34.386 76.988-51.737 123.58-52.337 68.2-0.877 68.284-106.721 0-105.842C132.605 331.344 9.341 454.607 7.379 607.266 5.417 759.929 135.565 883.225 285.262 885.148c68.284 0.876 68.2-104.965 0-105.841z" fill="#312782"></path><path d="M339.68 384.204a173.762 173.762 0 0 1 172.037-172.038c44.908-0.577 87.822 18.092 119.698 48.462 34.388 32.759 51.743 76.985 52.343 123.576 0.877 68.199 106.72 68.284 105.843 0-1.964-152.653-125.231-275.917-277.884-277.879-152.664-1.962-275.954 128.182-277.878 277.879-0.88 68.284 104.964 68.199 105.841 0z" fill="#D74825"></path><path d="M545.039 473.078c16.542 16.542 16.542 43.356 0 59.896l-122.89 122.895c-16.542 16.538-43.357 16.538-59.896 0-16.542-16.546-16.542-43.362 0-59.899l122.892-122.892c16.537-16.542 43.355-16.542 59.894 0z" fill="#312782"></path><path d="M485.17 473.078c16.537-16.539 43.354-16.539 59.892 0l122.896 122.896c16.538 16.533 16.538 43.354 0 59.896-16.541 16.538-43.361 16.538-59.898 0L485.17 532.979c-16.547-16.543-16.547-43.359 0-59.901z" fill="#312782"></path><path d="M514.045 634.097c23.972 0 43.402 19.433 43.402 43.399v178.086c0 23.968-19.432 43.398-43.402 43.398-23.964 0-43.396-19.432-43.396-43.398V677.496c0.001-23.968 19.433-43.399 43.396-43.399z" fill="#$secondary-color: var(--secondary-color, #D74825);"></path></g></svg>
                                            </span>
                                </label>
                                <input @change="handleFileChange" id="mu-file-input" type="file" accept="image/*" multiple hidden>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab" tabindex="0">
                        <div class="p-4 bg-white shadow mb-4">
                            <InputLabel 
                                value="Full Description"
                                class="text-dark fw-medium mb-2 fs-4"
                                />
                            <Editor v-model="form.description" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-spaci" role="tabpanel" aria-labelledby="v-pills-spaci-tab" tabindex="0">
                        <div class="p-4 bg-white shadow mb-4">
                            <InputLabel 
                                value="Spacification"
                                class="text-dark fw-medium mb-2 fs-4"
                                />
                            <Editor v-model="form.spacification" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-warranty" role="tabpanel" aria-labelledby="v-pills-warranty-tab" tabindex="0">
                        <div class="p-4 bg-white shadow mb-4">
                            <InputLabel 
                                value="Warranty"
                                class="text-dark fw-medium mb-2 fs-4"
                                />
                            <Editor v-model="form.warranty" />
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        
        <Modal id="category" v-vb-is:modal>
            <h3>Add New Category</h3>
            <form class="py-5" @submit.prevent="addNewCategory" preserve-scroll>
                <input type="text"
                    class="d-block w-100 p-2 bt-border-color mb-3"
                    placeholder="Add new category"
                    v-model="newCategory.name"
                >
                <div class="category-image pb-4">
                    <label for="category-image">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <span>Upload Image</span>
                        <input
                            type="file"
                            id="category-image"

                            @change="onFileChange"
                        />
                    </label>
                    <div class="category-image-preview">
                        <img v-if="url" :src="url" alt="">
                    </div>
                </div>
                <button class="button-primary w-100">Add</button>
            </form>
        </Modal>
    </AuthenticatedLayout>
</template>
