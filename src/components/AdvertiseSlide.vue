<script setup>
import ButtonShop from '../components/basic/ButtonShop.vue';
</script>

<template>
    <div class="container-fluid relative">
        <div class="row d-flex ">
            <div class="col-md-4 p-0">
                <img src="../assets/image/left.png" width="547" height="460" alt="">
            </div>
            <div class="col-md-8 d-flex flex-col justify-center align-items-center gap-3"
                style="background-color: #6386d1;">
                <div class="name_parent">
                    <p class="font-bold text-3xl text-white tracking-wide">Kimonos, Caftans & Pareos</p>
                </div>
                <div class="dis_parent">
                    <p class="text-2xl text-white">Poolside glam included From $4.99</p>
                </div>
                <div>
                    <RouterLink to="/electronic">
                        <ButtonShop style="margin-left: 0px;" color="#4172DC" text="Shop Now"></ButtonShop>
                    </RouterLink>
                </div>
            </div>
        </div>
        <div class="row absolute z-10 left-96 top-32" style="padding-left: 17px;">
            <!-- absolute left-96 top-32 -->
            <div class="col-md-3 " style="height: 163px; width: 228px;">
                <div class="bg-white shadow-sm d-flex flex-col justify-center align-items-center"
                    style="width: 228px; height: 123px;">
                    <p class="text-xl font-bold">Summer Essentials</p>
                    <p class="m-0 text-xl font-bold text-red-500">20% off</p>
                </div>
                <div class="text-center pt-2 bg-gray-900" style="width: 228px; height: 40px;">
                    <p class="text-sm text-white">19 Jul-30 Jul</p>
                </div>
            </div>
        </div>
    </div>
</template>