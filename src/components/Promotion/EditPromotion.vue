<script setup>
import { defineEmits, defineProps } from 'vue';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const emit = defineEmits(['cancel']);
const props = defineProps({
  promotionId: {
    type: Number,
    required: true
  }
});

const handleCancel = () => {
    emit('cancel');
};

const selectedCategory = ref('');
const selectedProducts = ref([]);
const categories = ref([]);
const products = ref([]);
const discountPercentage = ref(0);
const startDate = ref('');
const endDate = ref('');
const alertMessage = ref('');
const alertClass = ref('');
const isActive = ref(true);

const promotionName = ref('');
const promotionDescription = ref('');

const API_URL = 'http://localhost:80/api';

const endpoints = {
    promotion: (id) => `${API_URL}/promotions/${id}`,
    categories: `${API_URL}/categories`,
    productsByCategory: (categoryId) => `${API_URL}/categories/${categoryId}/products`
};

const fetchCategories = async () => {
    try {
        const response = await axios.get(endpoints.categories);
        categories.value = response.data.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

const fetchProducts = async () => {
    if (!selectedCategory.value) {
        products.value = [];
        return;
    }

    try {
        const response = await axios.get(endpoints.productsByCategory(selectedCategory.value));
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

const fetchPromotion = async () => {
    try {
        const response = await axios.get(endpoints.promotion(props.promotionId));
        const promotion = response.data.promotion;
        
        promotionName.value = promotion.name;
        promotionDescription.value = promotion.description;
        discountPercentage.value = promotion.discount_percentage;
        startDate.value = promotion.start_date;
        endDate.value = promotion.end_date;
        isActive.value = promotion.status;

        // Assuming promotion has a category_id field to preselect the category
        selectedCategory.value = promotion.category_id;

        // Fetch products after setting the category
        await fetchProducts();
        
        // Preselect the products
        selectedProducts.value = promotion.products.map(product => product.id);
    } catch (error) {
        console.error('Error fetching promotion:', error);
    }
};

onMounted(() => {
    fetchCategories();
    fetchPromotion();
});

const productsByCategory = computed(() => {
    if (!selectedCategory.value) {
        return [];
    }
    return products.value.filter(product => product.category_id === selectedCategory.value);
});

const updatePromotion = async () => {
    const currentDate = new Date();
    const endDateValue = new Date(endDate.value);
    const status = endDateValue >= currentDate && isActive.value;

    try {
        const response = await axios.put(endpoints.promotion(props.promotionId), {
            name: promotionName.value,
            description: promotionDescription.value,
            discount_percentage: discountPercentage.value,
            start_date: startDate.value,
            end_date: endDate.value,
            products: selectedProducts.value,
            status: status
        });
        alertMessage.value = response.data.message;
        alertClass.value = 'alert alert-success';
    } catch (error) {
        if (error.response && error.response.status === 422) {
            alertMessage.value = error.response.data.error || 'Validation error';
            alertClass.value = 'alert alert-danger';
        } else {
            alertMessage.value = error.response.data.message || 'Failed to update promotion';
            alertClass.value = 'alert alert-danger';
        }
    } finally {
        // Hide the alert message after 5 seconds
        setTimeout(() => {
            alertMessage.value = '';
            alertClass.value = '';
        }, 5000);
    }
};
</script>

<template>
  <div class="container">
    <div v-if="alertMessage" :class="alertClass">{{ alertMessage }}</div>

    <h2>Update Promotion</h2>
    <form @submit.prevent="updatePromotion" class="form">
      <div class="form-group">
        <label for="promotionName">Promotion Name:</label>
        <input type="text" v-model="promotionName" id="promotionName" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="promotionDescription">Description:</label>
        <textarea v-model="promotionDescription" id="promotionDescription" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select v-model="selectedCategory" @change="fetchProducts" id="category" class="form-control">
          <option value="" disabled>Select a category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
      <div v-if="selectedCategory" class="form-group">
        <label>Products:</label>
        <div v-for="product in productsByCategory" :key="product.id" class="form-check">
          <input type="checkbox" v-model="selectedProducts" :value="product.id" :id="`product-${product.id}`" class="form-check-input">
          <label :for="`product-${product.id}`" class="form-check-label">{{ product.name }}</label>
        </div>
      </div>
      <div class="form-group">
        <label for="discountPercentage">Discount Percentage:</label>
        <input type="number" v-model.number="discountPercentage" id="discountPercentage" class="form-control" required min="0" max="100">
      </div>
      <div class="form-group">
        <label for="startDate">Start Date:</label>
        <input type="date" v-model="startDate" id="startDate" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="endDate">End Date:</label>
        <input type="date" v-model="endDate" id="endDate" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="checkbox" v-model="isActive" id="isActive" class="form-check-input">
        <label for="isActive" class="form-check-label">Active</label>
      </div>
      <div class="row mt-5">
        <hr>
      </div>
      <div class="row">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
          <button type="button" @click="handleCancel"
                  class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
          <button type="submit"
                  class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">UPDATE</button>
        </div>
      </div>
    </form>
  </div>
</template>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}
.container {
  margin: 0 auto;
}

.form {
  margin-top: 20px;
}

.form-group { 
  margin-bottom: 15px;
}

.form-label {
  font-weight: bold;
}

.form-control {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.btn {
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}

.alert {
  margin-top: 20px;
  padding: 15px;
  border-radius: 4px;
}

.alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
}

.alert-danger {
  background-color: #f8d7da;
  border-color: #f5c6cb;
  color: #721c24;
}
</style>
