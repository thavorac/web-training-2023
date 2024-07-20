<template>
    <div>
      <h1>Send Recipe</h1>
      <button @click="sendRecipe">Send Recipe</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'PaymentComponent',
    methods: {
      async sendRecipe() {
        try {
          const response = await axios.post('/api/send-recipe');
          alert(response.data.message);
        } catch (error) {
          console.error('Error sending recipe:', error);
        }
      }
    }
  };
  </script>
  