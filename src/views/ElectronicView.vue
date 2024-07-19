<script setup>
import SaleComponent from '../components/SaleComponent.vue'
import MenuHeader from '../components/MenuHeader.vue';
import CategoriesHead from '../components/CategoriesHead.vue';
import Footer from '../components/Footer.vue';
import SubHeader from '../components/SubHeader.vue';
import ChevronRight from '../components/icons/ChevronRight.vue';
import SubFooter from '../components/SubFooter.vue';

import { useCartStore } from '@/stores/useCartStoreP';

const data = useCartStore();


// const imageNames = [
//     '001.png', // Image name for index 1
//     // '01.png', // Image name for index 2
//     '02.png',
//     '03.png',// Image name for index 2
//     '04.png', // Image name for index 2
//     '005.png', // Image name for index 2
//     '007.png', // Image name for index 2
//     '008.png', // Image name for index 2
//     '009.png', // Image name for index 2
//     // Image name for index 2
//     // Add more image names here
// ];
// function url(image) {
//     // console.log(image);
//     let imageUrl = `../assets/image/${image}`;
//     return new URL(imageUrl, import.meta.url).href;
// }


// const branchs = [
//     'Apple Watch Series 5',
//     'Apple iPhone 11 (64GB, Black)',
//     'Apple iMac 27-inch',
//     ''
// ];
// import CartIcon from '../components/basic/CartIcon.vue';

// import SignIn from '../components/basic/SignIn.vue';
// import IconPerson from '../components/icons/IconPerson.vue';
// import IconHeart from '../components/icons/IconHeart.vue';
// import IconCard from '../components/icons/IconCard.vue';

</script>


<template>
    <!-- <div>
        <SignIn text="Login">
            <IconHeart />
        </SignIn>
        <SignIn text="Favorite">
            <IconPerson />
        </SignIn>
        <SignIn text="Card">
            <IconCard />
        </SignIn>
    </div> -->
    <div class="electronic">
        <div>
            <RouterLink class="no-underline" to="/">
                <MenuHeader />
            </RouterLink>
        </div>
        <div class="categoryHead">
            <CategoriesHead />
        </div>
        <div class="mb-5">
            <SubHeader>
                <ChevronRight width="5" color="black" class="mt-1" />
            </SubHeader>
        </div>


        <!-- copy -->
        <div class="container grid grid-cols-4 gap-1">
            <SaleComponent v-for="product in data.products" :key="product.id" :product="product" />
        </div>

        <!-- <div class="menuProduct">
            <MenuProduct></MenuProduct>
        </div> -->
        <!-- <div class="advertising">
            <Advertising :isNew="true" discount="20%"></Advertising>
        </div> -->

        <!-- <div class="container grid grid-cols-4 gap-1">
            <SaleComponent v-for="(imageName, index) in imageNames" :key="index" :image="`${url(imageName)}`">
                <div class="AddToCardButton">
                    <AddToCardButton color="#F8F8F8" text="Remove" colorText="#5E5873" width="153px" height="42px"
                        :icon="none">
                        <cart />

                    </AddToCardButton>
                    <AddToCardButton color="#7367F0" text="Add to cart" colorText="#FFFFFF" width="153px" height="42px"
                        :icon="none">
                        <Shop />
                    </AddToCardButton>
                </div>
            </SaleComponent>
        </div> -->
        <div>
            <SubFooter />
        </div>
        <div class="">
            <Footer></Footer>
        </div>
    </div>


</template>
