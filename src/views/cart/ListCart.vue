<template>
  <div>
    <router-view @add-to-cart="addToCart" :cartItems="cartItems" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { onMounted, watch } from 'vue'
const cartItems = ref([])

const addToCart = (product) => {
  const existingProduct = cartItems.value.find((item) => item.id === product.id)
  if (existingProduct) {
    existingProduct.quantity += 1
  } else {
    cartItems.value.push({ ...product, quantity: 1 })
  }
}

onMounted(() => {
  const cartItemsFromStorage = JSON.parse(localStorage.getItem('cartItems')) || []
  cartItems.value = cartItemsFromStorage
})

watch(cartItems, (newCartItems) => {
  localStorage.setItem('cartItems', JSON.stringify(newCartItems))
})
</script>

<style scoped>
/* your styles */
</style>
