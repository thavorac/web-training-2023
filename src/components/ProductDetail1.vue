<template>
    <div>
        <div>
            <RouterLink class="no-underline" to="/">
                <MenuHeader />
            </RouterLink>
        </div>
        <div class="categoryHead">
            <CategoriesHead />
        </div>
        <div class="mt-10"></div>
        <!-- <div class="mb-5">
            <SubHeader>
                <ChevronRight width="5" color="black" class="mt-1" />
            </SubHeader>
        </div> -->

        <div class=" flex justify-center items-center mb-5">
            <div class="icon">
                <RouterLink to="/showProducts">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="green" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </RouterLink>

            </div>
            <div v-if="product" class="container mt-4" style="background-color: white;">
                <div class="row lh-lg">
                    <!-- <div class="col-sm-3">
                        <img style=" width: 100%; height: 100%;" :src="`http://localhost/storage/${product.image}`"
                            class="object-cover transform transition-transform duration-500 group-hover:scale-110"
                            alt="Product Image">
                    </div> -->
                    <div class="col-sm-3 group relative overflow-hidden">
                        <img style="width: 100%; height: 100%;" :src="`http://localhost/storage/${product.image}`"
                            class="object-cover transform transition-transform duration-500 group-hover:scale-110"
                            alt="Product Image">
                    </div>
                    <div class="col-sm-8 mt-2">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <h5 class="fw-bold" style="color: #5E5873;">{{ product.name }}</h5>

                            <h4 class=" me-1 mt-3 fw-bold price">
                                ${{ product.pricing }}</h4>
                            <!-- <span>
                            <div>
                                <slot/>
                            </div>
                        </span> -->
                            <!-- <p style="padding-top: 5px;  margin: 0px;">Description <span class="inStock">{{ text }}</span>
                        </p> -->
                            <span style="color: #6E6B7B;">By <span style="color: #6E6B7B;font-weight:bold;">{{
                                product.brand }}</span></span>
                            <p class="text mb-4 mb-md-0 mt-1" style="width: 539px; color: #6E6B7B;">
                                {{ product.description }}
                            </p>
                            <ButtonShipping class="pt-2" style="padding-top: 9px; margin-left: 0px;"
                                text="Free Shipping">
                                <ShopIcon class="pt-2"></ShopIcon>
                            </ButtonShipping>
                            <ButtonShipping style="padding-top: 10px;" text="EMI options available">
                                <Shipping></Shipping>
                            </ButtonShipping>
                            <hr style="border:1px solid #e7e8e6; width: 535px;  ">
                            <p style="color: #5E5873; font-weight: 600;">Colors</p>
                            <div class="color1">
                                <div class="dot1" style="border-color:red ;">
                                    <span class="dot" style="background-color: red;"></span>
                                </div>
                                <div class="dot1" style="border-color:blue ;">
                                    <span class="dot" style="background-color: blue;"></span>
                                </div>
                                <div class="dot1" style="border-color:gray;">
                                    <span class="dot" style="background-color: gray;"></span>
                                </div>
                                <div class="dot1" style="border-color:green;">
                                    <span class="dot" style="background-color: green;"></span>
                                </div>
                                <div class="dot1" style="border-color:yellow;">
                                    <span class="dot" style="background-color: yellow;"></span>
                                </div>
                            </div>
                            <hr style="border:1px solid #EBE9F1; width: 535px; height: 1px;">
                            <div class="button mb-1 gap-2">
                                <AddToCardButton class="addtocard cursor-pointer" color="#7367F0" text="Add To Cart"
                                    colorText="#ffffff" width="155px" height="38px" raduis="2px">
                                    <ShopOutline />
                                </AddToCardButton>
                                <AddToCardButton class="cursor-pointer" color="#fffff" text="Wishlist"
                                    colorText="#7367F0" width="118px" height="38px" raduis="3px"
                                    border="1px solid #7367F0">
                                    <Heart class="heart" />
                                </AddToCardButton>
                                <button
                                    style="border: 1px solid #7367F0; background-color: white; color: #EBE9F1 ; border-radius: 3px; height: 38px;">
                                    <Share></Share>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <SubFooter />
        </div>
        <div class="">
            <Footer></Footer>
        </div>
    </div>
</template>

<script setup>
import ButtonShipping from './basic/ButtonShipping.vue';
import ShopIcon from './basic/ShopIcon.vue';
import Shipping from './basic/Shipping.vue';
import AddToCardButton from './basic/AddToCardButton.vue';
import Heart from './basic/Heart.vue';
import ShopOutline from './basic/ShopOutline.vue';
import Share from './basic/Share.vue';
import MenuHeader from '../components/MenuHeader.vue';
import CategoriesHead from '../components/CategoriesHead.vue';
import Footer from '../components/Footer.vue';
import SubHeader from '../components/SubHeader.vue';
import ChevronRight from '../components/icons/ChevronRight.vue';
import SubFooter from '../components/SubFooter.vue';

import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const product = ref(null);
const route = useRoute();

const fetchProductDetail = async () => {
    const productId = route.params.productId;
    try {
        const response = await axios.get(`http://localhost/api/products/${productId}`);
        product.value = response.data.data;
    } catch (error) {
        console.error('Error fetching product details:', error);
    }
};

onMounted(() => {
    fetchProductDetail();
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');


.price {
    color: rgba(255, 46, 0, 1);
    font-weight: 800;
    font-size: 20px;
    line-height: 20px;
    font-family: 'Lato', sans-serif;
}

.inStock {
    color: #28C76F;
    font-size: 14px;
    padding-top: 9px;
}

.color {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 7px;
    position: absolute;
    /* position: relative; */
}

.button {
    width: 338px;
    height: 38px;
    display: flex;
    font-size: 14px;
    gap: 20px;
}

.color,
.dot {
    height: 20px;
    width: 20px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    left: 1.4px;


    /* margin-left: 7px; */
}

.dot1 {
    height: 27px;
    width: 27px;
    /* background-color: ; */
    border: 2px #bbb solid;
    border-radius: 50%;
    display: inline-block;
    margin-left: 7px;
    /* padding: 10px; */
}

.heart {
    color: #82868B;
}

.icon {
    width: 50px;
    /* height: 18px; */
    border: 1.5px;
    padding-top: 10px;
    cursor: pointer;
    margin-left: 10px;
    /* fill: red; */
}

.icon svg:hover {
    stroke: rgba(246, 242, 238, 0.951);
    fill: green;
}
</style>