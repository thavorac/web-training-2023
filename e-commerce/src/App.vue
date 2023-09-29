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


export default{
  name:'App',
  components: {
    Button,
    MenuItem,
    Pricing,
    Time,
    ProductCard,
    Top100Card4,
   
  }
}

</script>

<style scoped></style>
