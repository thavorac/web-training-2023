<template>
  <div id="app">
    <div class="container">
        <div>
            <MenuHeader/>
        </div>
        <div class="categoryHead">
            <CategoriesHead/>
        </div>
        <div class="menuProduct">
            <MenuProduct></MenuProduct>
        </div>
        <div class="advertising">
            <Advertising :isNew="true" discount="20%"></Advertising>
        </div>
        <!-- <Viewall></Viewall> -->
        <div class="flash-sale">
            <div class="text">
                <aside class="ftext">Flash Sales</aside>
                <aside class="view-all">
                    <p class="all">View all</p>
                    <p class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </p>
                </aside>
            </div>
            <div class="product_card">
                <ProductCard new_price="$123" full_price="$131" discount_price="10%" rating="(54)" brandName="Tonny Black" detail="Shoulder bag-White-Plain" :productCardimage="productCardimage"/> 
                <ProductCard new_price="$113" full_price="$142" discount_price="13%" rating="(100)" brandName="Reebok" detail="Women's Powder sneaker" :productCardimage="shoesMid1"/> 
                <ProductCard new_price="$101" full_price="$321" discount_price="21%" rating="(83)" brandName="Patso" detail="Shoulder bag-Pink-Plain" :productCardimage="shoesMid2"/> 
                <ProductCard new_price="$141" full_price="$114" discount_price="25%" rating="(29)" brandName="Sketchers" detail="Sport-shoe 2102" :productCardimage="shoesMid3"/> 
        </div>
    </div>   
      <div class="trending">
        <div class="text">
          <aside class="ftext">Trending must-haves</aside>
          <aside class="view-all">
            <p class="all">View all</p>
            <p class="icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="{1.5}"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
              </svg>
            </p>
          </aside>
        </div>
        <div class="trending_collection">
          <Trending1
            :isNew="true"
            :image="trendImg2"
            price="89$"
            nameProduct="Dotted dress-Casual"
            category="Cool & Sexy Calvin Klein"
          />
          <Trending1
            :isNew="false"
            :image="images"
            price="89$"
            nameProduct="Dotted dress-Casual"
            category="Cool & Sexy Calvin Klein"
          />
          <Trending1
            :isNew="true"
            :image="trendImg3"
            price="102$"
            nameProduct="Cream-Brown-Formal"
            category="beige coat Zara"
          />
        </div>
      </div>

      <div class="top100">
        <div class="text">
          <aside class="ftext">Top100</aside>
          <aside class="view-all">
            <p class="all">View all</p>
            <p class="icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="{1.5}"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
              </svg>
            </p>
          </aside>
        </div>
        <div class="top100Card1">
          <Top100Card1
            disPrice="120$"
            newPrice="$123"
            fullPrice="200$"
            productName="Mango"
            productTitle="Komono & Caftan-Black-Regular fit"
            rate="(289)"
            :top100Img1="top100Card1"
          ></Top100Card1>
          <Top100Card1
            disPrice="100$"
            newPrice="$122"
            fullPrice="130$"
            productName="Mango"
            productTitle="Komono & Caftan-Black-Regular fit"
            rate="(123)"
            :top100Img1="imageTop3"
          ></Top100Card1>
          <Top100Card1
            disPrice="150$"
            newPrice="$230"
            fullPrice="190$"
            productName="Mango"
            productTitle="Komono & Caftan-Black-Regular fit"
            rate="(329)"
            :top100Img1="imageTop4"
          ></Top100Card1>
          <Top100Card1
            disPrice="123$"
            newPrice="$43"
            fullPrice="100$"
            productName="Mango"
            productTitle="Komono & Caftan-Black-Regular fit"
            rate="(214)"
            :top100Img1="imageTop5"
          ></Top100Card1>
        </div>
      </div>

      <div class="top100Card4">
        <Top100Card4
          nameProduct="Throwback Shirts & all-day dressed"
          category="Never-Ending Summer"
          :imageTopCard4="imageTopCard4"
        />
        <Top100Card4
          nameProduct="Get in gym essentials"
          color="#1D5159"
          category="The most famous sport brands"
          :imageTopCard4="top100Card4"
        />
      </div>
      <div class="baner">
        <Banner color="#F7DDD0"></Banner>
      </div>
      <div class="top100Card41">
        <Top100Card41
          nameProduct1="Get in gym essentials"
          color="#D11FB5"
          category1="The most famous sport brands"
          :imageTopCard41="dressImage"
        />
        <Top100Card41
          nameProduct1="Get in gym essentials"
          color="#0186C4"
          height="341px"
          category1="The most famous sport brands"
          :imageTopCard41="shirtImage"
        />
      </div>
      <div class="footer">
        <Footer></Footer>
      </div>
    </div>
  </div>

</template>

<script>
import Button from "./components/basic/Button.vue";
import ProductCard from "./components/ProductCard.vue";
import Pricing from "./components/basic/Pricing.vue";
import Time from "./components/basic/Time.vue";
import MenuItem from "./components/basic/MenuItem.vue";
import Top100Card4 from "./components/Top100Card4.vue";
import Trending1 from "./components/Trending(1).vue";
import MenuHeader from "./components/MenuHeader.vue";
import Footer from "./components/Footer.vue";
import Banner from "./components/Banner.vue";
import Advertising from "./components/Advertising.vue";
import Top100Card from "./components/Top100Card.vue";
import PricingBtn from "./components/basic/PricingBtn.vue";
import Top100Card1 from "./components/Top100Card1.vue";
import Top100Card41 from "./components/Top100Card41.vue";
import CategoriesHead from "./components/CategoriesHead.vue";
import MenuProduct from "./components/MenuProduct.vue";

import { mapState } from "pinia";
import { useGeneralStore } from "./stores/general";
// const generalStore = useGeneralStore();

export default {
  name: "App",
  data() {
    return {
      images: new URL("./assets/image/top.png", import.meta.url),
      imageTopCard4: new URL("./assets/image/red.png", import.meta.url),
      productCardimage: new URL("./assets/image/mid.png", import.meta.url),
      shoesMid1: new URL("./assets/image/mid1.png", import.meta.url),
      shoesMid2: new URL("./assets/image/mid2.png", import.meta.url),
      shoesMid3: new URL("./assets/image/mid3.png", import.meta.url),
      trendImg2: new URL("./assets/image/top1.png", import.meta.url),
      trendImg3: new URL("./assets/image/top2.png", import.meta.url),
      top100Card1: new URL("./assets/image/top100Card.png", import.meta.url),
      imageTop3: new URL("./assets/image/top3.png", import.meta.url),
      imageTop4: new URL("./assets/image/top4.png", import.meta.url),
      imageTop5: new URL("./assets/image/top5.png", import.meta.url),
      top100Card4: new URL("./assets/image/top100Card4.png", import.meta.url),
      dressImage: new URL("./assets/image/dress.png", import.meta.url),
      shirtImage: new URL("./assets/image/t-shirt.png", import.meta.url),
    };
  },
  components: {
    MenuHeader,
    Footer,
    Banner,
    Button,
    MenuItem,
    Pricing,
    Time,
    ProductCard,
    Top100Card4,
    Trending1,
    Advertising,
    Top100Card,
    PricingBtn,
    Top100Card1,
    Top100Card41,
    CategoriesHead,
    MenuProduct,
  },
  methods: {},
  computed: {
    ...mapState(useGeneralStore, ["categories"]),
    ...mapState(useGeneralStore,["advertisement"]),
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Lato&display=swap");
* {
  padding: 0px;
  margin: 0px;
}
#app {
  max-width: 1280px;
  margin: 0px;
  padding: 0px;
}
.container {
  /* width: 1440px; */
  width: 1518px;
  /* height: auto; */
  background-color: #ffffff;
  box-shadow: 0px 0px 12px 0px #0000001a;
}
.categoryHead {
  width: 1440px;
  height: 78px;
  /* padding: 8px 90px; */
  justify-content: space-between;
}
.menuProduct {
  margin-top: 25px;
  /* width: 1440px; */
  height: 52px;
  /* background-color: #FFFFFF;
    color: black; */
}
.advertising{
  width: 1518px;
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
.footer {
  margin-top: 47px;
}

/* Flash Sales */
.flash-sale {
  /* width: 1440px; */
  width: 1518px;
  height: 448px;
  /* padding: 0px 90px; */
  gap: 48px;
  margin-top: 67px;
}
.flash-sale .text {
  width: 1260px;
  height: 20px;
  display: flex;
  margin-left: 87px;
}
.flash-sale .text .ftext {
  width: 332.47px;
  height: 20px;
  left: 90px;
  font-size: 28px;
  font-weight: 500;
  line-height: 20px;
  font-family: "Lato", sans-serif;
  color: #000000;
}
.flash-sale .text .view-all {
  width: 58px;
  height: 20px;
  left: 1292px;
  display: flex;
  margin-left: 872px;
}
.flash-sale .text .view-all .all {
  width: 42px;
  height: 20px;
  font-size: 12px;
  font-weight: 400;
  line-height: 20px;
  text-align: right;
  font-family: "Lato", sans-serif;
  color: #262626;
  margin-left: 155px;
}
.flash-sale .text .view-all .icon {
  width: 16px;
  height: 16px;
  rotate: 0;
}
svg {
  width: 21px;
  height: 14px;
  font-weight: 500;
}

/* Trending */

.trending {
  width: 1440px;
  height: 507px;
  /* padding: 0px 90px; */
  gap: 50px;
  margin-top: 47px;
}
.trending .text {
  width: 1260px;
  height: 20px;
  display: flex;
  margin-left: 87px;
}
.trending .text .ftext {
  width: 332.47px;
  height: 20px;
  left: 90px;
  font-size: 28px;
  font-weight: 500;
  line-height: 20px;
  font-family: "Lato", sans-serif;
  color: #000000;
}
.trending .text .view-all {
  width: 58px;
  height: 20px;
  left: 1292px;
  display: flex;
  margin-left: 872px;
}
.trending .text .view-all .all {
  width: 42px;
  height: 20px;
  font-size: 12px;
  font-weight: 400;
  line-height: 20px;
  text-align: right;
  font-family: "Lato", sans-serif;
  color: #262626;
}
.trending .text .view-all .icon {
  width: 16px;
  height: 16px;
  rotate: 0;
}
svg {
  width: 21px;
  height: 14px;
  font-weight: 500;
}

/* Top100 */
.top100 {
  width: 1440px;
  height: 548px;
  gap: 48px;
  margin-top: 47px;
}
.top100 .text {
  width: 1260px;
  height: 20px;
  display: flex;
  margin-left: 87px;
}
.top100 .text .ftext {
  width: 332.47px;
  height: 20px;
  left: 90px;
  font-size: 28px;
  font-weight: 500;
  line-height: 20px;
  font-family: "Lato", sans-serif;
  color: #000000;
}
.top100 .text .view-all {
  width: 58px;
  height: 20px;
  left: 1292px;
  display: flex;
  margin-left: 872px;
}
.top100 .text .view-all .all {
  width: 42px;
  height: 20px;
  font-size: 12px;
  font-weight: 400;
  line-height: 20px;
  text-align: right;
  font-family: "Lato", sans-serif;
  color: #262626;
}
.top100 .text .view-all .icon {
  width: 16px;
  height: 16px;
  rotate: 0;
}
svg {
  width: 21px;
  height: 14px;
  font-weight: 500;
}
</style>
