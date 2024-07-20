<template>
    <div class="cart-container">
      <h2>Your Shopping Cart</h2>
      <div v-if="cart.length === 0" class="empty-cart">
        <p>Your cart is empty.</p>
      </div>
      <div v-else>
        <div v-for="product in cart" :key="product.id" class="cart-item">
          <h3>{{ product.name }}</h3>
          <p class="price">${{ product.price.toFixed(2) }}</p>
          <button class="remove-button" @click="removeFromCart(product.id)">
            Remove
          </button>
        </div>
        <div class="total">
          <p>Total: ${{ totalPrice.toFixed(2) }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import axios from 'axios';
  
  const cart = ref([]);
  
  const fetchCart = async () => {
    const response = await axios.get('http://localhost:80/api/cart');
    cart.value = response.data;
  };
  
  onMounted(fetchCart);
  
  const removeFromCart = async (productId) => {
    await axios.post('http://localhost:80/api/cart/remove', { product_id: productId });
    fetchCart();
  };
  
  const totalPrice = computed(() => {
    return cart.value.reduce((total, product) => total + product.price, 0);
  });
  </script>
  
  <style scoped>
  .cart-container {
    padding: 20px;
    max-width: 600px;
    margin: auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }
  
  .price {
    font-weight: bold;
  }
  
  .remove-button {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    background-color: #ff4d4d;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .remove-button:hover {
    background-color: #e60000;
  }
  
  .total {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    text-align: right;
  }
  </style>