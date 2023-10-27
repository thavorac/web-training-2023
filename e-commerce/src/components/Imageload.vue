<template>
    <div>
      <img :src="advertisementImage" alt="Advertisement Image" />
    </div>
  </template>
  
  <script>
  import { computed } from "vue";
  import { useGeneralStore } from "../stores/imageload"; // Update the path to your store
  
  export default {
    setup() {
      const generalStore = useGeneralStore();
  
      const advertisementImage = computed(() => generalStore.advertisement.image);
  
      return {
        advertisementImage,
      };
    },
  };
  </script>