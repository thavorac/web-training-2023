<template>
    <div class="container drop-shadow-md rounded-1 mb-5" style="width: 305px; height: 390px; background-color: white;">
        <div class="row">
            <div class="col-sm-12">
                <div style="height: 241px;">
                    <img :src="product.image" width="304" height="221" alt="">
                </div>
                <div class="text">
                    <img src="../assets/image/stars.png" alt="" />
                    <div class="text1">
                        <span style="float: right;">${{ product.price }}</span>
                        <p style="font-weight: 600; margin: 0px;">{{ product.name }}</p>
                        <p>{{ product.description }}</p>
                    </div>
                    <div class="AddToCardButton">
                        <!-- <AddToCardButton color="#F8F8F8" text="Remove" colorText="#5E5873" width="153px" height="42px"
                            :icon="none" raduis="4px 1px 1px 4px">
                            <CartIcon />
                        </AddToCardButton> -->
                        <AddToCardButton class="cursor-pointer" @click="data.addToCart(product)" color="#7367F0"
                            text="Add to cart" colorText="#FFFFFF" width="153px" height="42px" :icon="none"
                            raduis="1px 4px 4px">
                            <ShopIcon />
                        </AddToCardButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import AddToCardButton from './basic/AddToCardButton.vue';
import ShopIcon from './basic/ShopIcon.vue';
import CartIcon from './basic/CartIcon.vue';
import { defineProps } from 'vue';

import { useCartStore } from '@/stores/useCartStoreP';

const data = useCartStore();

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
})

import { onMounted, ref } from 'vue';

const postData = ref([])

const getPost = async () => {
    return fetch('http://localhost/api/products')
        .then(response => response.json())
}
onMounted(() => {
    getPost().then(data => {
        postData.value = data
    })
})

// const props = defineProps({
//     image: String,
//     branch: String,
// });
</script>



<style scoped>
body {
    color: #6E6B7B;
}

.btn1 {
    /* width: 153px;
    height: 42px; */
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.btn1 button {
    border: none;
    background-color: #ddd;
    padding: 7px;
}

.AddToCardButton {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-content: center;
    margin-top: 20px;
    box-sizing: border-box;
    /* gap:10px; */
}

.text1 {
    line-height: 29px;
}
</style>