<template>
    <div>
        <Carousel id="gallery" :items-to-show="1" :wrapAround="true" v-model="currentSlide">
            <Slide v-for="slide in images" :key="slide">
                <div class="carousel__item">
                    <img :src="slide.url">
                </div>
            </Slide>
        </Carousel>

        <Carousel class="mt-1"
                id="thumbnails"
                :items-to-show="3"
                :wrapAround="true"
                v-model="currentSlide"
                ref="carousel"
        >
            <Slide v-for="(slide, index) in images" :key="slide">
                <div class="carousel__item" @click="slideTo(index)">
                    <img :src="slide.url" alt="">
                </div>
            </Slide>
        </Carousel>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Carousel, Navigation, Slide, Pagination } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'


defineProps({
    images:{
        type:Array,
        required:true
    }
})
const currentSlide = ref(0)
const slideTo = (val)=> {
    currentSlide.value = val
}

</script>

<style scoped>
    #gallery .carousel__item{
        width: 100%;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #thumbnails .carousel__item{
        width: 100%;
        height: 100%;
        margin: 0 8px;
    }

    #thumbnails .carousel__item img{
        width: 120px;
        height: 100px;
        object-fit: contain;
        overflow: hidden;
    }
    #gallery .carousel__item img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    #thumbnails .carousel__track .carousel__item{
        border:1px solid gray;
        border-right:none;
    }
    #thumbnails .carousel__track .carousel__item:last-child{
        border-right:1px solid gray;
    }

    #thumbnails{
        padding:0 !important;
    }

</style>