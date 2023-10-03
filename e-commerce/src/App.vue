<template>
  <!-- <div>App page</div>
  <div>
    <Button color="#4172DC" text="Shop Now" icon="84$" image=" "></Button>
  </div> -->
  <div id="app">
    <Button></Button>
    <MenuItem></MenuItem>
    <Pricing/>
    <Time></Time>
    <ProductCard/>
    <Top100Card4/>
    <Trending1 isNew="True" :image="image" price="64$" nameProduct="Hello" category="Cool"/>
    <CardButton/>
   
  </div>
</template>

<script>
import { RouterLink, RouterView } from "vue-router"
import Button from "./components/basic/Button.vue"
import ProductCard from "./components/ProductCard.vue"
import Pricing from "./components/basic/Pricing.vue"
import Time from "./components/basic/Time.vue"
import MenuItem from "./components/basic/MenuItem.vue"
import Top100Card4 from "./components/Top100Card4.vue"
import Trending1 from "./components/Trending(1).vue"
import CardButton from "./components/basic/CardButton.vue"


export default{
  name:'App',
  data() {
    return {
      image: new URL('./assets/image/top.png', import.meta.url)
    }
  },
  components: {
    Button,
    CardButton,
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
