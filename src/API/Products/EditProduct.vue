<template>
  <div class="container">
    <div class="jumbotron">
      <h1 class="ps-4">Edit Product</h1>
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
                <option value="#" disabled>Select Category</option>
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
              <label for="multiple_files" :src="getImage()" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                multiple files</label>
              <input ref="fileInput"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="multiple_files" type="file" multiple>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="form-group mb-2">
              <label for="supplier_id">Supplier ID</label>
              <input type="text" v-model="formData.supplier_id" class="form-control"
                placeholder="Enter Product Supplier ID">
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-success mt-5">Save/Update Data</button>
        <a href="/getProducts" class="btn btn-primary mt-5 ms-2">Back to Product View</a>
      </form>
    </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
const props = defineProps(['title']);
const route = useRoute();
const productId = route.params.id;

const categories = ref('');
const fetchCategories = async () => {
    try {
      const response = await fetch('http://localhost:80/api/categories');
      categories.value = await response.json();
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  };

const successMessage = ref('');
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
//   const productId = 'YOUR_PRODUCT_ID'; // Replace with the actual product ID

const getProductAndEdit = async (productId) => {
  try {
    const response = await axios.get(`http://localhost/api/products/${productId}`);
    const product = response.data;
    console.log(product)
    // Populate form data with product details
    formData.value = {
      name: product.name,
      pricing: product.pricing,
      discount: product.discount,
      color: product.color,
      size: product.size,
      brand: product.brand,
      category_id: product.category_id,
      supplier_id: product.supplier_id,

    };

  } catch (error) {
    console.error('Error fetching product:', error);
  }
};

const submitForm = async () => {
  try {
    let response;
    if (productId) {
      // Update existing product
      response = await axios.patch(`http://localhost/api/products/${productId}`, { ...formData.value, "_method": "PATCH" });
    } else {
      // Create new product
      response = await axios.post('`http://localhost/api/products', { ...formData.value, "_method": "PATCH" });
    }
    successMessage.value = response.data.message; // Assuming the response contains a success message
    // Clear form data after successful submission
    clearFormData();
  } catch (error) {
    console.error(error);
    // Handle error
  }
};

// Fetch product details when the component is mounted
onMounted(() => {
  getProductAndEdit(productId);


});
onMounted(()=>{
  fetchCategories();
})

const clearFormData = () => {
  // Clear form data
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
};

</script>

<style scoped>
.form {
    margin-left: 100px;
    margin-top: 40px;
  }
/* Add your component-specific styles here */
</style>