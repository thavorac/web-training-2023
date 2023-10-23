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
            <Advertising></Advertising>
        </div>
        <div class="product_card">
            <ProductCard new_price="$123" full_price="$231" discount_price="$101" rating="(54)" brandName="Tonny Black" detail="Shoulder bag-White-Plain" :productCardimage="productCardimage"/> 
            <ProductCard new_price="$113" full_price="$142" discount_price="$213" rating="(100)" brandName="Reebok" detail="Women's Powder sneaker" :productCardimage="shoesMid1"/> 
            <ProductCard new_price="$101" full_price="$321" discount_price="$213" rating="(83)" brandName="Patso" detail="Shoulder bag-Pink-Plain" :productCardimage="shoesMid2"/> 
            <ProductCard new_price="$141" full_price="$114" discount_price="$250" rating="(29)" brandName="Sketchers" detail="Sport-shoe 2102" :productCardimage="shoesMid3"/> 
        </div>
        <div class="trending_collection">
            <Trending1 :isNew="true" :image="trendImg2" price="89$"  nameProduct="Dotted dress-Casual" category="Cool & Sexy Calvin Klein"/>  
            <Trending1 :isNew="false" :image="images" price="89$" nameProduct="Dotted dress-Casual" category="Cool & Sexy Calvin Klein"/>  
            <Trending1 :isNew="true" :image="trendImg3" price="102$" nameProduct="Cream-Brown-Formal" category="beige coat Zara"/>  
        </div> 
        <div class="top100Card1">
            <Top100Card1 disPrice="120$" newPrice="$123" fullPrice="200$" productName="Mango" productTitle="Komono & Caftan-Black-Regular fit" rate="(289)" :top100Img1="top100Card1"></Top100Card1>
            <Top100Card1 disPrice="100$" newPrice="$122" fullPrice="130$" productName="Mango" productTitle="Komono & Caftan-Black-Regular fit" rate="(123)" :top100Img1="imageTop3"></Top100Card1>
            <Top100Card1 disPrice="150$" newPrice="$230" fullPrice="190$" productName="Mango" productTitle="Komono & Caftan-Black-Regular fit" rate="(329)" :top100Img1="imageTop4"></Top100Card1>
            <Top100Card1 disPrice="123$" newPrice="$43" fullPrice="100$" productName="Mango" productTitle="Komono & Caftan-Black-Regular fit" rate="(214)" :top100Img1="imageTop5"></Top100Card1> 
        </div>
        <div class="top100Card4">
            <Top100Card4 nameProduct="Throwback Shirts & all-day dressed" category="Never-Ending Summer" :imageTopCard4="imageTopCard4"/> 
            <Top100Card4 nameProduct="Get in gym essentials" color="#1D5159" category="The most famous sport brands" :imageTopCard4="top100Card4"/> 
           
        </div>
        <div class="baner">
            <Banner color="#F7DDD0"></Banner>
        </div>
        <div class="top100Card41">
            <Top100Card41 nameProduct1="Get in gym essentials" color="#D11FB5" category1="The most famous sport brands" :imageTopCard41="dressImage" /> 
            <Top100Card41 nameProduct1="Get in gym essentials" color="#0186C4" category1="The most famous sport brands" :imageTopCard41="shirtImage"/> 
        </div>
        <div class="footer">
            <Footer></Footer> 
        </div>
    </div>

    
   
    <!-- <Button image="images" color="#4172DC" text="Shop Now"></Button>  
    <MenuItem text="Sign in"></MenuItem> 
    <Pricing newPrice="$228" discount="-10%" fullPrice="$290"/> 
    <PricingBtn discountBtn="-10%" newPriceBtn="$228" fullPriceBtn="$290" />
    <Time></Time>  -->
  </div>
</template>

<script>
import Button from "./components/basic/Button.vue"
import ProductCard from "./components/ProductCard.vue"
import Pricing from "./components/basic/Pricing.vue"
import Time from "./components/basic/Time.vue"
import MenuItem from "./components/basic/MenuItem.vue"
import Top100Card4 from "./components/Top100Card4.vue"
import Trending1 from "./components/Trending(1).vue"
import MenuHeader from "./components/MenuHeader.vue"
import Footer from "./components/Footer.vue"
import Banner from "./components/Banner.vue"
import Advertising from "./components/Advertising.vue"
import Top100Card from "./components/Top100Card.vue"
import PricingBtn from "./components/basic/PricingBtn.vue"
import Top100Card1 from "./components/Top100Card1.vue"
import Top100Card41 from "./components/Top100Card41.vue"
import CategoriesHead from "./components/CategoriesHead.vue"
import MenuProduct from "./components/MenuProduct.vue"


export default{
  name:'App',
  data() {
    return {
      images: new URL('./assets/image/top.png', import.meta.url),
      imageTopCard4: new URL('./assets/image/red.png', import.meta.url),
      productCardimage: new URL('./assets/image/mid.png' , import.meta.url),
      shoesMid1: new URL('./assets/image/mid1.png' , import.meta.url),
      shoesMid2: new URL('./assets/image/mid2.png' , import.meta.url),
      shoesMid3: new URL('./assets/image/mid3.png' , import.meta.url),
      trendImg2: new URL('./assets/image/top1.png' , import.meta.url),
      trendImg3: new URL('./assets/image/top2.png' , import.meta.url),
      top100Card1: new URL('./assets/image/top100Card.png', import.meta.url),
      imageTop3: new URL('./assets/image/top3.png', import.meta.url),
      imageTop4: new URL('./assets/image/top4.png', import.meta.url),
      imageTop5: new URL('./assets/image/top5.png', import.meta.url),
      top100Card4: new URL('./assets/image/top100Card4.png', import.meta.url),
      dressImage: new URL('./assets/image/dress.png', import.meta.url),
      shirtImage: new URL('./assets/image/t-shirt.png',import.meta.url),
    }
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
  }
}

</script>

<style scoped>
  *{
    padding: 0px;
    margin: 0px;
  }
  /* #id{
    /* width: 1440px; */
    /* height: 4283px; */
   
  
  .container{
    width: 1440px;
    /* height: auto; */
    background-color: #FFFFFF;
    box-shadow: 0px 0px 12px 0px #0000001A;

  }
  .categoryHead{
    width: 1440px;
    height: 78px;
    /* padding: 8px 90px; */
    justify-content: space-between;
  }
  .menuProduct{
    margin-top: 25px;
    /* width: 1440px; */
    height: 52px;
    /* background-color: #FFFFFF;
    color: black; */
  }

  .product_card{
    width: 1260px;
    height: 380px;
    display: flex;
    gap: 20px;
    padding-left: 88px;
    margin-top: 48px;
  }
  .trending_collection{
    width: 1260px;
    height: 437px;
    display: flex;
    gap: 20px;
    padding-left: 88px;
    margin-top: 200px;
  }
  .top100Card1{
    width: 1260px;
    height: 480px;
    display: flex;
    gap: 20px;
    padding-left: 88px;
    margin-top: 134px;
   
  }
  .top100Card4{
    width: 1440px;
    height: 384px;
    padding: 0px 90px;
    display: flex;
    gap: 20px;
    padding-left: 88px;
    margin-top: 76px;

  }
  .baner{
    margin-top: 76px;
  }
  .top100Card41{
    width: 1440px;
    height: 347px;
    padding: 0px 90px;
    display: flex;
    gap: 20px;
    padding-left: 88px;
    margin-top: 76px;
  }
  .footer{
    margin-top: 30px;
  }


</style>
