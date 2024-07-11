<template>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="text-">Manage Product {{ products.length }}</h1>
      <hr>
      <div class="line" style="text-align:right">
        <router-link to="/product-form" class="btn btn-primary mb-1">Add New Product</router-link>
      </div>
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Name</th>
            <th scope="col">Pricing</th>
            <th scope="col">Discount</th>
            <th scope="col">Color</th>
            <th scope="col">Size</th>
            <th scope="col">Brand</th>
            <th scope="col">Category ID</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, index) in paginatedProducts" :key="product.id" style="background:white;">
            <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
            <td>{{ product.name }}</td>
            <td>{{ product.pricing }}</td>
            <td>{{ product.discount }}</td>
            <td>{{ product.color }}</td>
            <td>{{ product.size }}</td>
            <td>{{ product.brand }}</td>
            <td>{{ product.category_id }}</td>
            <td>
              <img :src="product.firstImage?.images" alt="Product Image" class="object-cover h-10 w-10">
            </td>
            <td class="flex space-x-2">
              <router-link :to="'/edit-product/' + product.id" class="btn btn-success" :title="'Edit Product'">Edit</router-link>
              <button @click="confirmDelete(product.id)" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <PaginationView :totalPages="totalPages" :currentPage="currentPage" @goToPage="goToPage" />
    </div>
  </div>
</template>

<script setup>
import PaginationView from '@/views/PaginationView.vue';
import { ref, onMounted, computed } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const products = ref([]);
const currentPage = ref(1);
const successMessage = ref('');

const fetchProducts = async () => {
  try {
    const response = await fetch('http://localhost/api/products');
    const data = await response.json();
    products.value = data.map(product => {
      if (!product.images) {
        product.images = [];
      }
      return product;
    });
    await fetchFirstImages();
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

const fetchFirstImages = async () => {
  try {
    for (const product of products.value) {
      const response = await axios.get(`http://localhost/api/products/${product.id}/getFirstImage`);
      product.firstImage = response.data.data;
      console.log(`Product ID: ${product.id}, Image URL: ${product.firstImage?.images}`);
    }
  } catch (error) {
    console.error('Error fetching first images:', error);
  }
};

const deleteProduct = async (productId) => {
  try {
    await fetch(`http://localhost/api/products/${productId}`, {
      method: 'DELETE'
    });
    products.value = products.value.filter(product => product.id !== productId);
    successMessage.value = 'Product deleted successfully';
  } catch (error) {
    console.error('Error deleting product:', error);
  }
};

const confirmDelete = (productId) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      deleteProduct(productId);
      Swal.fire("Deleted!", "Your file has been deleted.", "success");
    }
  });
};

const itemsPerPage = 7;
const totalPages = computed(() => Math.ceil(products.value.length / itemsPerPage));

const paginatedProducts = computed(() => {
  const startIndex = (currentPage.value - 1) * itemsPerPage;
  return products.value.slice(startIndex, startIndex + itemsPerPage);
});

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

onMounted(() => {
  fetchProducts();
});
</script>

<style scoped>
.form {
  margin-left: 100px;
  margin-top: 40px;
}
</style>
