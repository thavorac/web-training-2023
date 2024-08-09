<template>
    <div class="checkout-container">
      <h2>Checkout</h2>
      <form @submit.prevent="handleSubmit" class="payment-form">
        <label for="card-element">Credit or debit card</label>
        <div id="card-element" class="card-element"></div>
        <button type="submit" class="submit-button">Submit Payment</button>
      </form>
    </div>
</template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { loadStripe } from '@stripe/stripe-js';
  
  const stripePromise = loadStripe('your_stripe_public_key');
  
  const handleSubmit = async () => {
    const stripe = await stripePromise;
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
  
    const { client_secret } = await axios.post('http://localhost/api/create-payment-intent', {
      amount: 100, // amount in dollars
    });
  
    const result = await stripe.confirmCardPayment(client_secret, {
      payment_method: {
        card: cardElement,
      },
    });
  
    if (result.error) {
      console.error(result.error.message);
    } else {
      if (result.paymentIntent.status === 'succeeded') {
        console.log('Payment successful!');
      }
    }
  };
  </script>
  
  <style scoped>
  .checkout-container {
    padding: 20px;
    max-width: 500px;
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
  
  .payment-form {
    display: flex;
    flex-direction: column;
  }
  
  label {
    margin-bottom: 10px;
    font-weight: bold;
  }
  
  .card-element {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 20px;
  }
  
  .submit-button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .submit-button:hover {
    background-color: #0056b3;
  }
  </style>