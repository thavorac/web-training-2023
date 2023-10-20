<template>
  <!-- <div>App page</div>
  <div>
    <Button color="#4172DC" text="Shop Now" icon="84$" image=" "></Button>
  </div> -->
  <div id="app">
    <MenuHeader/> 
    <Footer></Footer> 
    <Banner/> 
    <Button image="images" color="skyblue"></Button> 
    <MenuItem></MenuItem> 
    <Pricing newPrice="$228" discount="-10%" fullPrice="$290"/> 
    <Time></Time> 
    <ProductCard brandName="Tonny Black" detail="Shoulder bag-White-Plain" :productCardimage="productCardimage"/> 
    <Top100Card4 nameProduct="Throwback Shirts & all-day dressed" category="Never-Ending Summer" :imageTopCard4="imageTopCard4"/> 
    <Trending1 isNew="True" :image="image" price="89$" nameProduct="Dotted dress-Casual" category="Cool & Sexy Calvin Klein"/>    
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


export default{
  name:'App',
  data() {
    return {
      image: new URL('./assets/image/top.png', import.meta.url),
      imageTopCard4: new URL('./assets/image/red.png', import.meta.url),
      productCardimage: new URL('./assets/image/mid.png' , import.meta.url),
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
   

   
  }
}

</script>

<style scoped></style>
