<template>
  <div>
    <h1>Edit Promotion</h1>
    <form @submit.prevent="updatePromotion">
      <div>
        <label for="name">Name:</label>
        <input v-model="promotion.name" type="text" id="name" required />
      </div>
      <div>
        <label for="description">Description:</label>
        <textarea v-model="promotion.description" id="description" required></textarea>
      </div>
      <div>
        <label for="discount_percentage">Discount Percentage:</label>
        <input v-model.number="promotion.discount_percentage" type="number" id="discount_percentage" required />
      </div>
      <div>
        <label for="start_date">Start Date:</label>
        <input v-model="promotion.start_date" type="date" id="start_date" required />
      </div>
      <div>
        <label for="end_date">End Date:</label>
        <input v-model="promotion.end_date" type="date" id="end_date" required />
      </div>
      <div>
        <label for="status">Status:</label>
        <select v-model="promotion.status" id="status" required>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
      <div>
        <label for="products">Products:</label>
        <select v-model="selectedProducts" multiple id="products">
          <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}</option>
        </select>
      </div>
      <button type="submit">Update Promotion</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';
import moment from "moment";

// Define state variables
const promotion = ref({
  name: '',
  description: '',
  discount_percentage: 0,
  start_date: '',
  end_date: '',
  status: 'inactive',
});
const products = ref([]);
const selectedProducts = ref([]);

// Retrieve promotion ID from route params
const route = useRoute();
const router = useRouter();
const promotionId = route.params.promotionId;

// Fetch promotion and product data on component mount
onMounted(async () => {
  try {
    const promotionResponse = await axios.get(`http://localhost:80/api/promotions/${promotionId}`)
    const productsResponse = await axios.get('http://localhost:80/api/products')

    promotionResponse.data.start_date = moment(promotionResponse.data.start_date).format('YYYY-MM-DD')
    promotionResponse.data.end_date = moment(promotionResponse.data.end_date).format('YYYY-MM-DD')

    promotion.value = promotionResponse.data;
    products.value = productsResponse.data;
    console.log(promotionResponse)
    // selectedProducts.value = promotionResponse.data.products.map(product => product.id);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

// Handle form submission
const updatePromotion = async () => {
  try {
    await axios.put(`http://localhost:80/api/promotions/${promotionId}`, {
      ...promotion.value,
      products: selectedProducts.value,
    });
    router.push('/promotions'); // Redirect to promotions list or details page
  } catch (error) {
    console.error('Error updating promotion:', error);
  }
};
</script>

<style scoped>

</style>
