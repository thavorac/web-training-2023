<template>
    <div class="container">
      <div class="w-11/12 ms-5">
        <h1 class="font-thin p-0 ms-24">Create Product</h1>
        <hr>
        <div class="form">
          <form @submit.prevent="submitForm" class="ps-2">
            <div class="row">
              <div class="col-4">
                <div class="form-group mb-1">
                  <label for="name">Name</label>
                  <input type="text" v-model="formData.name" class="form-control" placeholder="Enter Product Name">
                </div>
              </div>
              <div class="col-5">
                <div class="form-group mb-2">
                  <label for="pricing">Pricing</label>
                  <input type="text" v-model="formData.pricing" class="form-control" placeholder="Enter Product Price">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group mb-2">
                  <label for="discount">Discount</label>
                  <input type="text" v-model="formData.discount" class="form-control" placeholder="Enter Product Discount">
                </div>
              </div>
              <div class="col-5">
                <div class="form-group mb-2">
                  <label for="color">Color</label>
                  <input type="text" v-model="formData.color" class="form-control" placeholder="Enter Product Color">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group mb-2">
                  <label for="size">Size</label>
                  <select v-model="formData.size" class="form-control">
                    <option value="" disabled>Select Size</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    <option value="extra large">Extra Large</option>
                  </select>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group mb-2">
                  <label>Brand</label>
                  <input type="text" v-model="formData.brand" class="form-control" placeholder="Enter Product Brand">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-9">
                <div class="form-group mb-2">
                  <label for="category_id">Category</label>
                  <select v-model="formData.category_id" class="form-control">
                    <option value="" disabled>Select Category</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                      {{ category.name }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-9">
                <div class="form-group mb-2">
                  <label for="multiple_files" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload multiple files</label>
                  <input ref="fileInput" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-9">
                <div class="form-group mb-2">
                  <img v-if="uploadedImageUrl" :src="uploadedImageUrl" alt="Uploaded Image" class="mt-3" style="max-width: 100%;">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group mb-2">
                  <label for="supplier_id">Supplier ID</label>
                  <input type="text" v-model="formData.supplier_id" class="form-control" placeholder="Enter Product Supplier ID">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Save/Insert Data</button>
            <router-link to="/getProducts" class="btn btn-primary mt-3 ms-3">Back to Product View</router-link>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const categories = ref([]);
  const formData = ref({
    name: '',
    pricing: '',
    discount: '',
    color: '',
    size: '',
    brand: '',
    category_id: '',
    supplier_id: ''
  });
  const fileInput = ref(null);
  const uploadedImageUrl = ref('');
  
  const fetchCategories = async () => {
    try {
      const response = await fetch('http://localhost:80/api/categories');
      categories.value = await response.json();
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  };
  
  const submitForm = async () => {
    try {
      const response = await axios.post('http://localhost:80/api/products', formData.value, {
        headers: { "Content-Type": "application/json" }
      });
      console.log(response.data); // Handle response as needed
      await uploadImages(response.data.data.id); // Pass the product ID to the uploadImages function
      clearFormData();
    } catch (error) {
      console.error('Error creating product:', error);
    }
  };
  
  const uploadImages = async (productId) => {
    const files = fileInput.value.files;
    if (!files.length) {
      console.error('No images selected');
      return;
    }
  
    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
      formData.append('image[]', files[i]);
    }
    formData.append('product_id', productId);
  
    try {
      const response = await axios.post('http://localhost:80/api/images', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });
  
      console.log('Images uploaded:', response.data);
      uploadedImageUrl.value = response.data.data[0].images; // Set the URL of the first uploaded image
    } catch (error) {
      console.error('Error uploading images:', error);
    }
  };
  
  const clearFormData = () => {
    formData.value = {
      name: '',
      pricing: '',
      discount: '',
      color: '',
      size: '',
      brand: '',
      category_id: '',
      supplier_id: ''
    };
    fileInput.value.value = ''; // Clear file input
  };
  
  onMounted(() => {
    fetchCategories();
  });
  </script>
  
  <style scoped>
  .form {
    margin-left: 100px;
    margin-top: 40px;
  }
  </style>
  