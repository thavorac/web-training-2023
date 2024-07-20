<template>
  <div class="container ">
    <input type="text" style="border: none;" class="searchBar" placeholder="Search here">
    <Search class=" ps-24"></Search>
  </div>
</template>

<script setup>

import Search from './search.vue'

</script>

<style scoped>
.container {
  width: 1100px;
}

.container input.searchBar {
  width: 100%;
  height: 58px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border: none;
  border-radius: 6px;
}

.container input.searchBar::placeholder {
  /* CSS styles for the placeholder */
  padding: 10px;
  font-size: 16px;
  color: #B9B9C3;
  /* font-style: italic; */
  /* Add more CSS styles as needed */
}

input:focus {
  /* position: relative; */
  outline-color: skyblue;
}
</style>