<template>
    <div>
      <h1>Checkout</h1>
      <form @submit.prevent="startCheckout">
        <label for="productname">Product Name</label>
        <input type="text" v-model="productname" id="productname" required />
  
        <label for="total">Total Price</label>
        <input type="number" v-model="totalprice" id="total" required />
  
        <button type="submit">Checkout</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CheckoutComponent',
    data() {
      return {
        productname: '',
        totalprice: 0
      };
    },
    methods: {
      async startCheckout() {
        try {
          const response = await axios.post('/api/checkout-session', {
            productname: this.productname,
            total: this.totalprice
          });
          window.location.href = response.data.url;
        } catch (error) {
          console.error('Error starting checkout:', error);
        }
      }
    }
  };
  </script>
  