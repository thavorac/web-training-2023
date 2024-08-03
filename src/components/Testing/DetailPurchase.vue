<template>
  <div class="p-3">
    <p class="font-semibold text-xl dark:text-white text-[#58AB5D]">Order Product</p>
  </div>
  <div v-if="product" class="container con mt-3 flex justify-start items-start">
    <div class="row">
      <div class="img col-md-5 group relative overflow-hidden">
        <img width="100%" :src="`http://localhost/storage/${product.image}`"
          class="object-cover transform transition-transform duration-500 group-hover:scale-110" alt="" />
      </div>
      <div class="col-sm-6 mt-1 ms-12 leading-6">
        <form @submit.prevent="handleSubmit">
          <p>{{ product.name }}</p>
          <p>Original Price : ${{ product.origin_price }}</p>
          <!-- <Qty1 v-model:quantity="quantity">{{ quantity }}</Qty1> -->
          <div class="col-sm-10">
            <label for=" category-name" class="block mb-2 font-semibold">Qty</label>
            <input id="category-name" type="number" v-model="quantity"
              class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Input qty" required>
          </div>
          <!-- <p class="mt-2">Total Price : ${{ product.totalPrice }}</p> -->
          <!-- <p class="mt-2">Total Price : ${{ totalPrice }}</p> -->
          <div class="col-sm-10 mt-3">
            <label for="supplier" class="block mb-3 font-semibold text-gray-900 dark:text-white">Supplier</label>
            <select v-model="selectedSupplier"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option value="">Select supplier</option>
              <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
            </select>
          </div>
          <div class="col-sm-12 flex flex-col md:flex-row justify-start mt-5 space-y-2 md:space-y-0 md:space-x-2">
            <button type="button" @click="handleCancel"
              class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
              CANCEL
            </button>
            <button type="submit"
              class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
              CREATE
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import Qty1 from '../basic/Qty1.vue';
import { useRoute, useRouter } from 'vue-router';

const product = ref(null);
const suppliers = ref([]);
const selectedSupplier = ref("");
const quantity = ref(1);
const route = useRoute();
const router = useRouter();

const handleCancel = () => {
  router.push('/admin/purchase');
};

const fetchProductDetail = async () => {
  const productId = route.params.productId;
  try {
    const response = await axios.get(`http://localhost/api/products/${productId}`);
    product.value = response.data.data;
    await fetchSuppliers(productId);
  } catch (error) {
    console.error('Error fetching product details:', error);
  }
};

const fetchSuppliers = async (productId) => {
  try {
    const response = await axios.get(`http://localhost/api/products/${productId}/suppliers`);
    suppliers.value = response.data;
  } catch (error) {
    console.error('Error fetching suppliers:', error);
  }
};

const handleSubmit = async () => {
  try {

    const purchaseData = {
      qty: quantity.value,
      status: 'pending', // assuming a default status
      supplier_id: selectedSupplier.value,
      product_id: product.value.id,

    };

    const totalPrice = computed(() => {
      return product.value ? product.value.origin_price * quantity.value : 0;
    });

    const response = await axios.post('http://localhost/api/purchases', purchaseData);
    // alert('Purchase created successfully!');
    handleCancel();
    console.log(handleSubmit);

  } catch (error) {
    console.error('Error creating purchase:', error);
    alert('Failed to create purchase');
  }
};

onMounted(() => {
  fetchProductDetail();
});

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap');

* {
  font-family: "Rubik", sans-serif;
  font-optical-sizing: auto;
  font-weight: 600;
  font-style: normal;
}

.con {
  width: 1022px;
  height: 400px;
}

img {
  object-fit: cover;
}
</style>
