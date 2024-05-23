<script setup>
import { defineProps } from 'vue';
import ChevronRight from './icons/ChevronRight.vue';
import ChevronLeft from './icons/ChevronLeft.vue';

const props = defineProps({
    title: String,
    detail: String,
    image: String,
    color: String
});

const data = {};

// You can add other logic or functions here if needed

</script>
<template>
    <div class="container-fluid h-52" style="background-color: #F7DDD0;">
        <div class="row">
            <div class="col-sm-3 d-flex justify-center align-items-center">
                <ChevronLeft></ChevronLeft>
            </div>
            <div class="col-sm-6">
                <div class="row d-flex justify-center align-items-center">
                    <div class="col-sm-6 d-flex flex-col justify-center align-items-left">
                        <p class="uppercase text-2xl font-bold" style="color:#465D6B;">magsafe</p>
                        <p class="text-xl font-me" style="color: #555555;">Snap on a magnetic case, wallet, or both. And
                            get faster wireless
                            charging.
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <img src="../assets/image/Iphone.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-3 d-flex justify-center align-items-center pt-20">
                <ChevronRight width="6" color="black"></ChevronRight>
            </div>
        </div>
    </div>

    <!-- <div :style="{ backgroundColor: color }" class="container">
        <div class="arrow-left-right">
            <ChevronLeft></ChevronLeft>
        </div>
        <div class="txt">
            <p class="upper">MAGSAFE</p>
            <p class="lower">Snap on a magnetic case, wallet, or both. And get faster wireless charging.</p>
        </div>
        <div class="img">
            <img src="../assets/image/Iphone.png" alt="">
        </div>
        <div class="arrow-left-right">
            <ChevronRight></ChevronRight>
        </div>
    </div> -->

</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
</style>