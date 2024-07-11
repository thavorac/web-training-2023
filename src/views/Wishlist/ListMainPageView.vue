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

const imageTopCard4 = new URL("../../assets/image/red.png", import.meta.url);
const top100Card4 = new URL("../../assets/image/top100Card4.png", import.meta.url);
const dressImage = new URL("../../assets/image/dress.png", import.meta.url);
const shirtImage = new URL("../../assets/image/t-shirt.png", import.meta.url);
const productCardimage = new URL("../../assets/image/mid.png", import.meta.url);
const shoesMid1 = new URL("../../assets/image/mid1.png", import.meta.url);
const shoesMid2 = new URL("../../assets/image/mid2.png", import.meta.url);
const shoesMid3 = new URL("../../assets/image/mid3.png", import.meta.url);
const images = new URL("../../assets/image/top.png", import.meta.url);
const trendImg2 = new URL("../../assets/image/top1.png", import.meta.url);
const trendImg3 = new URL("../../assets/image/top2.png", import.meta.url);
const top100Card1 = new URL("../../assets/image/top100Card.png", import.meta.url);
const imageTop3 = new URL("../../assets/image/top3.png", import.meta.url);
const imageTop4 = new URL("../../assets/image/top4.png", import.meta.url);
const imageTop5 = new URL("../../assets/image/top5.png", import.meta.url);

</script>

<template>
    <MenuHeader></MenuHeader>
    <!-- sticky top-0 -->
    <CategoriesHead></CategoriesHead>
    <MenuProduct></MenuProduct>
    <!-- here is place that i want to inject the content into it when i route to each category -->
    <!-- <router-view></router-view> -->

    <div>
        <AdvertiseSlide></AdvertiseSlide>
        <FlashSale></FlashSale>
        <div class="product_card">
            <ProductCard new_price="$123" full_price="$131" discount_price="10%" rating="(54)" brandName="Tonny Black"
                detail="Shoulder bag-White-Plain" :productCardimage="productCardimage" />
            <ProductCard new_price="$113" full_price="$142" discount_price="13%" rating="(100)" brandName="Reebok"
                detail="Women's Powder sneaker" :productCardimage="shoesMid1" />
            <ProductCard new_price="$101" full_price="$321" discount_price="21%" rating="(83)" brandName="Patso"
                detail="Shoulder bag-Pink-Plain" :productCardimage="shoesMid2" />
            <ProductCard new_price="$141" full_price="$114" discount_price="25%" rating="(29)" brandName="Sketchers"
                detail="Sport-shoe 2102" :productCardimage="shoesMid3" />
        </div>
        <FlashSale text="Trending must-haves"></FlashSale>

        <!-- Trending collection -->
        <div class="trending_collection">
            <TrendingMust :isNew="true" :image="trendImg2" price="89$" nameProduct="Dotted dress-Casual"
                category="Cool & Sexy Calvin Klein" />
            <TrendingMust :isNew="false" :image="images" price="89$" nameProduct="Dotted dress-Casual"
                category="Cool & Sexy Calvin Klein" />
            <TrendingMust :isNew="true" :image="trendImg3" price="102$" nameProduct="Cream-Brown-Formal"
                category="beige coat Zara" />
        </div>

        <!-- Top100 -->
        <FlashSale text="Top100"></FlashSale>
        <div class="top100Card1">
            <Top100Card1 disPrice="120$" newPrice="$123" fullPrice="200$" productName="Mango"
                productTitle="Komono & Caftan-Black-Regular fit" rate="(289)" :top100Img1="top100Card1"></Top100Card1>
            <Top100Card1 disPrice="100$" newPrice="$122" fullPrice="130$" productName="Mango"
                productTitle="Komono & Caftan-Black-Regular fit" rate="(123)" :top100Img1="imageTop3"></Top100Card1>
            <Top100Card1 disPrice="150$" newPrice="$230" fullPrice="190$" productName="Mango"
                productTitle="Komono & Caftan-Black-Regular fit" rate="(329)" :top100Img1="imageTop4"></Top100Card1>
            <Top100Card1 disPrice="123$" newPrice="$43" fullPrice="100$" productName="Mango"
                productTitle="Komono & Caftan-Black-Regular fit" rate="(214)" :top100Img1="imageTop5"></Top100Card1>
        </div>

        <!-- Top100Card4 -->
        <div class="top100Card4">
            <Top100Card4 nameProduct="Throwback Shirts & all-day dressed" category="Never-Ending Summer" height="383px"
                :imageTopCard4="imageTopCard4" />
            <Top100Card4 nameProduct="Get in gym essentials" color="#1D5159" category="The most famous sport brands"
                :imageTopCard4="top100Card4" />
        </div>

        <!-- Banner -->
        <div class="baner">
            <BannerSlide color="#F7DDD0"></BannerSlide>
        </div>

        <!-- Top100Card41 -->
        <div class="top100Card41">
            <Top100Card41 nameProduct1="Get in gym essentials" color="#D11FB5" category1="The most famous sport brands"
                :imageTopCard41="dressImage" height="320px" />
            <Top100Card41 nameProduct1="Get in gym essentials" color="#0186C4" height="314px"
                category1="The most famous sport brands" :imageTopCard41="shirtImage" />
        </div>

    </div>
    <!-- Sub footer -->
    <SubFooter></SubFooter>

    <!-- Footer -->
    <Footer></Footer>

</template>

<style scopted>
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
