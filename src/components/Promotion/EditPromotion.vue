<script setup>
import { ref, reactive, onMounted, computed, watch, nextTick } from 'vue';
import axios from 'axios';
import moment from 'moment';
import { useRouter } from 'vue-router';

const props = defineProps(['promotionId']);
const emit = defineEmits(['cancel']);

const router = useRouter();

const promotion = reactive({
  name: '',
  description: '',
  discount_percentage: 0,
  start_date: '',
  end_date: '',
});

const categories = ref([]);
const products = ref([]);
const selectedCategory = ref('');
const selectedProducts = ref([]);
const alertMessage = ref('');
const alertClass = ref('');

const fetchPromotion = async () => {
  try {
    console.log('Fetching promotion data for ID:', props.promotionId);
    const response = await axios.get(`http://localhost:80/api/promotions/${props.promotionId}`);
    console.log('Promotion data:', response.data);
    Object.assign(promotion, response.data);
    selectedCategory.value = response.data.category_id;
    selectedProducts.value = response.data.products.map(product => product.id);
    promotion.start_date = moment(response.data.start_date).format('YYYY-MM-DD');
    promotion.end_date = moment(response.data.end_date).format('YYYY-MM-DD');
    
    // Fetch products only after promotion data is set
    await nextTick();
    fetchProducts(); 
  } catch (error) {
    console.error('Error fetching promotion data:', error);
    alertMessage.value = 'Failed to fetch promotion data.';
    alertClass.value = 'alert alert-danger';
  }
};

const fetchCategories = async () => {
  try {
    console.log('Fetching categories');
    const response = await axios.get('http://localhost:80/api/categories');
    console.log('Categories data:', response.data);
    categories.value = response.data.data || response.data;
  } catch (error) {
    console.error('Error fetching categories:', error);
    alertMessage.value = 'Failed to fetch categories.';
    alertClass.value = 'alert alert-danger';
  }
};

const fetchProducts = async () => {
  if (!selectedCategory.value) return;
  try {
    console.log(`Fetching products for category ID: ${selectedCategory.value}`);
    const response = await axios.get(`http://localhost:80/api/categories/${selectedCategory.value}/products`);
    console.log('Products data:', response.data);
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
    alertMessage.value = 'Failed to fetch products.';
    alertClass.value = 'alert alert-danger';
  }
};

const updatePromotion = async () => {
  try {
    console.log('Updating promotion');
    await axios.put(`http://localhost:80/api/promotions/${props.promotionId}`, {
      name: promotion.name,
      description: promotion.description,
      discount_percentage: promotion.discount_percentage,
      start_date: promotion.start_date,
      end_date: promotion.end_date,
      status: promotion.status,
      products: selectedProducts.value,
    });
    alertMessage.value = 'Promotion updated successfully!';
    alertClass.value = 'alert alert-success';
    setTimeout(() => {
      emit('cancel');
      router.push('/Homepage');
    }, 2000);
  } catch (error) {
    console.error('Error updating promotion:', error);
    alertMessage.value = 'Failed to update promotion.';
    alertClass.value = 'alert alert-danger';
  }
};

const handleCancel = () => {
  emit('cancel');
};

const productsByCategory = computed(() => {
  if (!selectedCategory.value) {
    return [];
  }
  return products.value.filter(product => product.category_id === selectedCategory.value);
});

watch(selectedCategory, async (newCategory) => {
  if (newCategory) {
    await fetchProducts();
  }
});

onMounted(() => {
  fetchPromotion();
  fetchCategories();
});
</script>


<template>
  <div class="container">
    <div v-if="alertMessage" :class="alertClass">{{ alertMessage }}</div>

    <h2>Update Promotion</h2>
    <form @submit.prevent="updatePromotion" class="form">
      <div class="form-group">
        <label for="promotionName">Promotion Name:</label>
        <input type="text" v-model="promotion.name" id="promotionName" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="promotionDescription">Description:</label>
        <textarea v-model="promotion.description" id="promotionDescription" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select v-model="selectedCategory" id="category" class="form-control">
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
        <input type="number" v-model.number="promotion.discount_percentage" id="discountPercentage" class="form-control" required min="0" max="100">
      </div>
      <div class="form-group">
        <label for="startDate">Start Date:</label>
        <input type="date" v-model="promotion.start_date" id="startDate" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="endDate">End Date:</label>
        <input type="date" v-model="promotion.end_date" id="endDate" class="form-control" required>
      </div>
      <div class="row mt-5"></div>
      <div class="row">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
          <button type="button" @click="handleCancel" class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
          <button type="submit" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">UPDATE</button>
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
