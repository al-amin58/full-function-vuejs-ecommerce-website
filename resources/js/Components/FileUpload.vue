

<script setup>
import Uploader from 'vue-media-upload';
import { ref } from 'vue'
const images = ref([]);

const handleFileChange = (event) => {
    for (let i = 0; i < event.target.files.length; i++) {
        images.value.push({
            url: URL.createObjectURL(event.target.files[i]),
            file: event.target.files[i]
        });
    }

    console.log(images.value);
};

const fileChange = async (event) => {

    let files = event.target.files;

    for (let i = 0; i < files.length; i++) {
        let url = URL.createObjectURL(files[i]);
        let addedImage = { url: url, name: files[i].name, size: files[i].size, type: files[i].type };
    }
};

const removeMedia = (index) => {
    let removedImage = images.value[index];
    if (removedImage.url.startsWith('blob:')) {
        URL.revokeObjectURL(removedImage.url);
    }
    images.value.splice(index, 1);
};
</script>





<template>
    <div class="file-upload-container">
        <div class="file-upload-container-wrapper">
            <!--IMAGES PREVIEW-->
            <div v-for="(image, index) in images"   class="file-upload-container-wrapper__preview" :key="image.index">
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
        <div class="mt-3">
            <label class="upload-image button-primary" for="upload-img">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10V11H17C18.933 11 20.5 12.567 20.5 14.5C20.5 16.433 18.933 18 17 18H16C15.4477 18 15 18.4477 15 19C15 19.5523 15.4477 20 16 20H17C20.0376 20 22.5 17.5376 22.5 14.5C22.5 11.7793 20.5245 9.51997 17.9296 9.07824C17.4862 6.20213 15.0003 4 12 4C8.99974 4 6.51381 6.20213 6.07036 9.07824C3.47551 9.51997 1.5 11.7793 1.5 14.5C1.5 17.5376 3.96243 20 7 20H8C8.55228 20 9 19.5523 9 19C9 18.4477 8.55228 18 8 18H7C5.067 18 3.5 16.433 3.5 14.5C3.5 12.567 5.067 11 7 11H8V10ZM15.7071 13.2929L12.7071 10.2929C12.3166 9.90237 11.6834 9.90237 11.2929 10.2929L8.29289 13.2929C7.90237 13.6834 7.90237 14.3166 8.29289 14.7071C8.68342 15.0976 9.31658 15.0976 9.70711 14.7071L11 13.4142V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13.4142L14.2929 14.7071C14.6834 15.0976 15.3166 15.0976 15.7071 14.7071C16.0976 14.3166 16.0976 13.6834 15.7071 13.2929Z" fill="currentColor"></path> </g></svg>
                <span>upload Image</span>
                <input @change="handleFileChange" type="file" ref="fileInput" id="upload-img" hidden multiple/>
            </label>
        </div>
    </div>


    <!-- <div class="file-upload-container" :class="isInvalid?'mu-red-border':''">
        <div class="file-upload-container-wrapper">
            
            <div v-for="(image, index) in images" :key="index" class="file-upload-container-wrapper__preview">
                <img :src="image.url" alt="" class="file-upload-container-wrapper__preview-item">
                <button @click="removeMedia(index)" class="file-upload-container-wrapper__preview-item-cancel" type="button">
                    <svg
                        class='mu-times-icon'
                        xmlns="http://www.w3.org/2000/svg"
                        width="0.65em"
                        height="0.65em"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 352 512">
                        <path
                            d="m242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28L75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256L9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                            fill="currentColor"
                        />
                    </svg>
                </button>
            </div>
            
            <div class="file-upload-container__add">
                <label for="mu-file-input" class="file-upload-container__add-btn">
                    <svg
                        class="mu-plus-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        width="1em"
                        height="1em"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24">
                        <g fill="none">
                            <path
                                d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1zm1 15a1 1 0 1 1-2 0v-3H8a1 1 0 1 1 0-2h3V8a1 1 0 1 1 2 0v3h3a1 1 0 1 1 0 2h-3v3z"
                                fill="currentColor"/>
                        </g>
                    </svg>
                </label>
                <input @change="handleFileChange" id="mu-file-input" type="file" accept="image/*" multiple hidden>
            </div>
        </div>
    </div>

    <div>
        <input type="file" ref="fileInput" multiple @change="handleFileChange"/>
        <button @click="uploadFiles">Upload</button>
    </div> -->
</template>