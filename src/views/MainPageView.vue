<script setup>
import MenuHeader from '@/components/MenuHeader.vue';
import CategoriesHead from '@/components/CategoriesHead.vue';
import MenuProduct from '@/components/MenuProduct.vue';
import AdvertiseSlide from '@/components/AdvertiseSlide.vue';
import FlashSale from '@/components/FlashSale.vue';
import ProductCard from '@/components/ProductCard.vue';
import TrendingMust from '@/components/TrendingMust.vue';
import Top100Card1 from '@/components/Top100Card1.vue';
import Top100Card4 from '@/components/Top100Card4.vue';
import BannerSlide from '@/components/BannerSlide.vue';
import Top100Card41 from '@/components/Top100Card41.vue';
import SubFooter from '@/components/SubFooter.vue';
import Footer from '@/components/Footer.vue';

const imageTopCard4 = new URL("../assets/image/red.png", import.meta.url);
const top100Card4 = new URL("../assets/image/top100Card4.png", import.meta.url);
const dressImage = new URL("../assets/image/dress.png", import.meta.url);
const shirtImage = new URL("../assets/image/t-shirt.png", import.meta.url);
const productCardimage = new URL("../assets/image/mid.png", import.meta.url);
const shoesMid1 = new URL("../assets/image/mid1.png", import.meta.url);
const shoesMid2 = new URL("../assets/image/mid2.png", import.meta.url);
const shoesMid3 = new URL("../assets/image/mid3.png", import.meta.url);
const images = new URL("../assets/image/top.png", import.meta.url);
const trendImg2 = new URL("../assets/image/top1.png", import.meta.url);
const trendImg3 = new URL("../assets/image/top2.png", import.meta.url);
const top100Card1 = new URL("../assets/image/top100Card.png", import.meta.url);
const imageTop3 = new URL("../assets/image/top3.png", import.meta.url);
const imageTop4 = new URL("../assets/image/top4.png", import.meta.url);
const imageTop5 = new URL("../assets/image/top5.png", import.meta.url);

</script>

<template>
    <div class="fixed top-0 left-0 right-0  z-50">
        <MenuHeader></MenuHeader>
        <!-- sticky top-0 -->
        <CategoriesHead></CategoriesHead>
        <MenuProduct></MenuProduct>
    </div>
    <div class="pt-64"></div>
    <!-- here is place that i want to inject the content into it when i route to each category -->
    <!-- <router-view></router-view> -->
    <div class="">
        <RouterView />
    </div>
    <!-- Sub footer -->
    <SubFooter></SubFooter>

    <!-- Footer -->
    <Footer></Footer>

</template>

<style scopted>
/* Ensure the fixed header has a background color to cover content underneath */


/* Additional spacing for the header */
.pt-20 {
    padding-top: 5rem;
    /* Adjust this value to match the height of the fixed header */
}

.product_card {
    /* width: 1260px; */
    width: 1518px;
    height: 380px;
    display: flex;
    /* gap: 20px; */
    gap: 45px;
    padding-left: 88px;
    margin-top: 37px;
}

.trending_collection {
    width: 1260px;
    height: 437px;
    display: flex;
    /* gap: 20px; */
    gap: 60px;
    padding-left: 88px;
    margin-top: 37px;
    /* margin-top: 200px; */
}

.top100Card1 {
    width: 1260px;
    height: 480px;
    display: flex;
    gap: 47px;
    /* gap: 20px; */
    padding-left: 88px;
    margin-top: 37px;
}

.top100Card4 {
    width: 1440px;
    height: 384px;
    padding: 0px 90px;
    display: flex;
    gap: 101px;
    /* gap: 20px; */
    padding-left: 88px;
    margin-top: 47px;
}

.baner {
    margin-top: 47px;
}

.top100Card41 {
    width: 1440px;
    height: 347px;
    padding: 0px 90px;
    display: flex;
    gap: 99px;
    /* ? gap: 20px; */
    padding-left: 88px;
    margin-top: 47px;
}
</style>
