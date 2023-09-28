<template>
  <!-- <div>App page</div>
  <div>
    <Button color="#4172DC" text="Shop Now" icon="84$" image=" "></Button>
  </div> -->
  <div id="app">
    <ProductCard/>
  </div>
</template>

<script>
import { RouterLink, RouterView } from "vue-router"
// import Button from "./components/basic/Button.vue"
import ProductCard from "./components/Top100Card.vue"

export default{
  name:'App',
  components: {
    ProductCard,
  }
}

</script>

<style scoped></style>