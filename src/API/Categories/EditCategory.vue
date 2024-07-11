<template>
    <div class="container ms-3">
      <div class="jumbotron w-96" style="margin-top: 5%">
        <h1>Create Category</h1>
        <hr>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label>Name</label>
            <input type="text" v-model="formData.name" class="form-control" placeholder="Enter Category Name">
          </div>
          <button type="submit" class="btn btn-success mt-5">Save/Insert Data</button>
          <router-link to="/getCategory" class="btn btn-primary mt-5 ms-2">Back to Category View</router-link>
        </form>
      </div>
     
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute } from 'vue-router';
 
  const route = useRoute();
  const categoryId = route.params.id;
  
  const formData = ref({
    name: ''
  });
  
  const getCategoriesAndEdit = async (categoryId) => {
    try {
      const response = await axios.get(`http://localhost/api/categories/${categoryId}`);
      const category = response.data;
      console.log(category);
      // Populate form data with category details
      formData.value = {
        name: category.name
      };
    } catch (error) {
      console.error('Error fetching category:', error);
    }
  };
  
  const submitForm = async () => {
    try {
      let response;
      if (categoryId) {
        // Update existing category
        response = await axios.patch(`http://localhost/api/categories/${categoryId}`, { ...formData.value, "_method": "PATCH" });
      } else {
        // Create new category
        response = await axios.post('http://localhost/api/categories', { ...formData.value });
      }
      // Assuming the response contains a success message
      console.log(response.data.message);
      // Clear form data after successful submission
      clearFormData();
    } catch (error) {
      console.error(error);
      // Handle error
    }
  };
  
  const clearFormData = () => {
    // Clear form data
    formData.value = {
      name: ''
    };
  };
  
  // Fetch category details when the component is mounted
  onMounted(() => {
    getCategoriesAndEdit(categoryId);
  });
  </script>
  