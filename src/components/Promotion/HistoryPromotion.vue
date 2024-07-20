<template>
  <div class="container mx-auto">
    <!-- Alert Message -->
    <h2>Discount History</h2>
    <!-- Header Section for Promotions -->
    <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md mt-8">
      <!-- Loading Indicator -->
      <template v-if="loading">
        <IconSkLoading class="w-6 h-6" />
      </template>
      <!-- Router Link to Create Promotion Page -->
      <RouterLink
        to="/admin/promotion"
        class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md"
      >
        <BackIcon class="w-10 h-10" stroke="2.0" />
        <span class="text-xl font-semibold">Back</span>
      </RouterLink>
    </div>

    <!-- Date Filter Section -->
    <div class="flex pr-4 mt-4 space-x-1">
      <!-- Datepicker for Start Date -->
      <div class="flex items-center space-x-1">
        <div class="relative">
          <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <Datepicker
            v-model="startDate"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select start date"
          />
        </div>
        <span class="mx-1 text-gray-500">to</span>
        <!-- Datepicker for End Date -->
        <div class="relative">
          <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <Datepicker
            v-model="endDate"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select end date"
          />
        </div>
      </div>
    </div>

    <!-- Promotions Table -->
    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <!-- Table Headers -->
        <thead class="text-xs text-gray-700 bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-lg font-sans">ID</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Product Name</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Discount</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Date Range</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loading State -->
          <tr v-if="loading">
            <td colspan="4" class="text-center py-6">Loading...</td>
          </tr>
          <!-- No Data State -->
          <template v-if="filteredData.length === 0">
            <tr>
              <td colspan="4" class="text-center py-6 text-gray-500">No promotions found</td>
            </tr>
          </template>
          <!-- Data Rows -->
          <template v-else>
            <tr v-for="(item, index) in filteredData" :key="index" :class="`bg-white ${index === filteredData.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`">
              <td class="px-6 py-3">{{ index + 1 }}</td>
              <td class="px-6 py-3">{{ item.product_name }}</td>
              <td class="px-6 py-3">{{ item.discount }}</td>
              <td class="px-6 py-3">{{ item.start_date }} - {{ item.end_date }}</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import Datepicker from 'vue3-datepicker';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import BackIcon from '../icons/BackIcon.vue';

// Define reactive variables
const discountHistory = ref<any[]>([]);
const loading = ref<boolean>(false);
const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);
const alertMessage = ref<string>('');
const alertClass = ref<string>('');

// Function to fetch discount history
const fetchDiscountHistory = async () => {
  loading.value = true;
  try {
    const response = await axios.get('http://localhost:80/api/promotions/history');
    discountHistory.value = response.data;
  } catch (error) {
    console.error('Error fetching discount history:', error);
    alertMessage.value = 'Failed to fetch discount history';
    alertClass.value = 'alert alert-danger';
  } finally {
    loading.value = false;
  }
};

// Fetch discount history on component mount
onMounted(fetchDiscountHistory);

// Computed property for filtered data based on date range
const filteredData = computed(() => {
  if (!startDate.value || !endDate.value) {
    return discountHistory.value;
  }
  const start = startDate.value.getTime();
  const end = endDate.value.getTime();
  return discountHistory.value.filter((item: any) => {
    const itemStartDate = new Date(item.start_date).getTime();
    const itemEndDate = new Date(item.end_date).getTime();
    return itemStartDate >= start && itemEndDate <= end;
  });
});
</script>