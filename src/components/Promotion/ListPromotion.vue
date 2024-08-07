<script setup lang="ts">
import { ref, computed } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Datepicker from 'vue3-datepicker';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import { RouterLink } from 'vue-router';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';

// Define reactive variables
const promotions = ref<Promotion[]>([]);
const loading = ref(false);
const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);

interface Promotion {
  id: number;
  name: string;
  description?: string;
  discount_percentage: string;
  start_date: string;
  end_date: string;
  status: boolean;
}

// Function to fetch promotions
const fetchPromotions = () => {
  loading.value = true;
  axios.get<Promotion[]>('http://localhost:80/api/promotions')
    .then((response) => {
      promotions.value = response.data; // Directly assign the array to promotions.value
      console.log(response.data);
    })
    .catch((error) => {
      console.error('Error fetching promotions:', error);
    })
    .finally(() => {
      loading.value = false;
    });
};

// Function to format dates
const formatDate = (dateString: string): string => {
  const options: Intl.DateTimeFormatOptions = {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
  };
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', options);
};

// Function to filter promotions by date range
const filteredData = computed(() => {
  if (!startDate.value || !endDate.value) {
    return promotions.value;
  }
  const start = startDate.value.getTime();
  const end = endDate.value.getTime();
  return promotions.value.filter((promotion) => {
    const promotionStartDate = new Date(promotion.start_date).getTime();
    const promotionEndDate = new Date(promotion.end_date).getTime();
    return promotionStartDate >= start && promotionEndDate <= end;
  });
});

// Function to confirm deletion
const confirmDelete = (promotionId: number) => {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to recover this promotion!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DC2626',
    cancelButtonColor: '#4F46E5',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      deletePromotion(promotionId);
    }
  });
};

// Function to delete promotion
const deletePromotion = (promotionId: number) => {
  axios.delete(`http://localhost:80/api/promotions/${promotionId}`)
    .then(() => {
      Swal.fire(
        'Deleted!',
        'The promotion has been deleted.',
        'success'
      );
      fetchPromotions();
    })
    .catch((error) => {
      console.error('Error deleting promotion:', error);
      Swal.fire(
        'Error!',
        'Failed to delete the promotion.',
        'error'
      );
    });
};

// Fetch promotions on component mount
fetchPromotions();

</script>

<template>
  <div class="container mx-auto">
    <!-- Header Section -->
    <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
      <!-- Icon for Categories -->
      <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
      <!-- Loading Indicator -->
      <template v-if="loading">
        <IconSkLoading class="w-6 h-6" />
      </template>
      <!-- Total Promotions Display -->
      <template v-else>
        <div class="flex flex-col">
          <span class="text-sm font-semibold">Total</span>
          <span class="font-sans font-semibold text-2xl">{{ filteredData.length }}</span>
        </div>
      </template>
      <!-- Router Link to Create Promotion Page -->
      <RouterLink to="/admin/promotion/create-promotion"
        class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
        <IconsCirclePlus class="w-10 h-10" stroke="2.0" />
        <span class="text-xl font-semibold"> Promotion</span>
      </RouterLink>
    </div>

    <!-- Date Filter Section -->
    <div class="flex pr-4 mt-4 space-x-1">
      <!-- Datepicker for Start Date -->
      <div class="flex items-center space-x-1">
        <div class="relative">
          <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <Datepicker v-model="startDate"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select start date" />
        </div>
        <span class="mx-1 text-gray-500">to</span>
        <!-- Datepicker for End Date -->
        <div class="relative">
          <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <Datepicker v-model="endDate"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select end date" />
        </div>
      </div>
    </div>

    <!-- Promotions Table -->
    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
        <!-- Table Headers -->
        <thead class="text-xs text-gray-700 bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-lg font-sans">ID</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Description</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Percentage</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Start</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">End</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Status</th>
            <th scope="col" class="px-6 py-3 text-lg">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loading State -->
          <tr v-if="loading">
            <td colspan="7">Loading...</td>
          </tr>
          <!-- No Data State -->
          <template v-if="filteredData.length === 0">
            <tr>
              <td colspan="7" class="px-6 py-6 text-center text-gray-500">No promotions found</td>
            </tr>
          </template>
          <!-- Data Rows -->
          <template v-else>
            <tr v-for="(promotion, index) in filteredData" :key="index"
              :class="`bg-white ${index === filteredData.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`">
              <td class="px-6 py-6">{{ promotion.id }}</td>
              <td class="px-6 py-6">{{ promotion.description }}</td>
              <td class="px-6 py-6">{{ promotion.discount_percentage }}%</td>
              <td class="px-6 py-6">{{ formatDate(promotion.start_date) }}</td>
              <td class="px-6 py-6">{{ formatDate(promotion.end_date) }}</td>
              <td class="px-6 py-6">
                <span :class="{ 'text-green-500': promotion.status, 'text-red-500': !promotion.status }">
                  {{ promotion.status ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td class="px-6 py-6 flex space-x-2">
                <RouterLink :to="`/admin/promotion/${promotion.id}/edit`">
                  <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                </RouterLink>
                <IconDelete @click="() => confirmDelete(promotion.id)" class="w-6 h-6 text-red-500 cursor-pointer" />
                <RouterLink :to="`/admin/promotion/detail`">
                  <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" />
                </RouterLink>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

