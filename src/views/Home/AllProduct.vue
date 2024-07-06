<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Loop through products -->
            <div v-for="(product, index) in products" :key="index"
                class="item bg-white rounded-lg overflow-hidden shadow-md">
                <div class="pic bg-gray-200">
                    <img :src="`http://localhost/storage/${product.image}`" class="object-cover overflow-hidden"
                        alt="Product Image">
                </div>
                <div class="content">
                    <div class="category">
                        <div class="text">
                            <p class="font-bold text-sm text-gray-800">{{ product.name }}</p>
                            <p class="text-xs text-gray-600 mt-1 overflow-hidden text-ellipsis whitespace-nowrap">{{
                                product.description }}</p>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-6 h-6 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                    </div>
                    <div class="star flex items-center mt-1">
                        <img src="../../assets/image/star.png" alt="Star Rating">
                        <span>{{ rate }}</span>
                    </div>
                    <div>
                        <PricingBtn style="margin-top: 8px; margin-left: -10px;" discountBtn="-10%"
                            :newPriceBtn="`$${product.pricing}`" fullPriceBtn="$290"></PricingBtn>
                    </div>
                </div>
                <div class="AddToCardButton flex justify-between ">
                    <AddToCardButton color="#F8F6F8" text="Wishlist" colorText="#5E5873" width="151px" height="42px"
                        :icon="none" raduis="4px 1px 1px 4px">
                        <CartIcon />
                    </AddToCardButton>
                    <AddToCardButton @click="data.addToCart(product)" color="#7367F0" text="Add to cart"
                        colorText="#FFFFFF" width="151px" height="42px" :icon="none" raduis="1px 4px 4px">
                        <ShopIcon />
                    </AddToCardButton>
                </div>
            </div>
            <!-- End loop -->
        </div>
    </div>
</template>


<script setup>
import { defineProps } from 'vue';
import PricingBtn from '../../components/basic/PricingBtn.vue';
import AddToCardButton from '../../components/basic/AddToCardButton.vue';
import ShopIcon from '../../components/basic/ShopIcon.vue';
import CartIcon from '../../components/basic/CartIcon.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';

// Define the properties for the Product component
const props = defineProps({
    top100Img1: String,
    productName: String,
    productTitle: String,
    rate: Number,
    fullPrice: String,
    disPrice: String,
    newPrice: String
});

// Define the product state as a ref to an array of products
const products = ref([]);

// Function to fetch products from the API
const getProducts = () => {
    axios.get('http://localhost/api/products').then(res => {
        products.value = res.data.data;
        console.log(res);
    }).catch(error => {
        console.error('Error fetching products:', error);
    });
};

// Fetch products when the component is mounted
onMounted(() => {
    getProducts();
});

</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

* {
    padding: 0px;
    margin: 0px;
    box-sizing: border-box;
}

.AddToCardButton {
    margin-top: -12px;
    display: flex;
    justify-content: center;
    align-items: center;

}

.item {
    width: 320px;
    height: 440px;
    box-shadow: 0px 0px 12px 0px #56565665;
    margin-left: 20px;
    margin-top: 10px;
    border-radius: 9px;
}

.item .pic {
    width: 320px;
    height: 250px;
    border-radius: 8px 8px 0px 0px;
    /* margin-left: -12px; */
}

.item .pic img {
    width: 100%;
    height: 100%;
    /* object-fit: cover; */

}

.item .content {
    width: 300px;
    height: 153px;
    padding: 20px;
    gap: 12px;
    color: #FFFFFF;
}

.item .content .category {
    width: 260px;
    height: 44px;
    gap: 80px;
    display: flex;
}

.item .content .category .text {
    width: 160px;
    height: 44px;
    gap: 4px;
}

.item .content .category .text .f-text {
    width: 38px;
    height: 20px;
    font-size: 20px;
    font-weight: 600;
    color: #5E5873;
    font-family: 'Lato', sans-serif;
}

.item .content .category .text .s-text {
    width: 160px;
    margin-top: 4px;
    height: 20px;
    font-size: 14px;
    font-weight: 400;
    line-height: 25px;
    font-family: 'Lato', sans-serif;
    color: #6E6B7B;
}

.item .content .category .icon {
    width: 20px;
    height: 18px;
    border: 1.5px;
    padding-top: 10px;
}

.item .content .star {
    width: 260px;
    height: 25px;
    gap: 12px;
    position: relative;
    line-height: 25px;
}

.item .content .star .img {
    width: 120px;
    height: 24px;
}

.item.content .star span {
    width: 29px;
    height: 25px;
    font-size: 12px;
    font-weight: 400;
    line-height: 25px;
    text-align: center;
    color: #555555;
}
</style>