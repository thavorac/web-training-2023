<template>
    <div id="app">
      <color-rating :rating="3"></color-rating>
    </div>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Define ColorRating component
  const ColorRating = defineComponent({
    props: ['rating'],
    template: `
      <div class="rating">
        <span v-for="i in 5" :key="i" :class="{ 'star': i <= rating, 'star-inactive': i > rating }">&#9733;</span>
      </div>
    `
  });
  
  export default {
    name: 'Ratting',
    components: {
      'color-rating': ColorRating
    }
  };
  </script>
  
  <style>
  .rating {
    display: inline-block;
  }
  .star {
    color: gold; /* Default color for stars */
  }
  </style>
  