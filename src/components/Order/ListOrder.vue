<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Datepicker from 'vue3-datepicker';
import IconCategories from '../icons/IconCategories.vue';
import IconSearch from '../icons/IconSearch.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconRecipe from '../icons/IconRecipe.vue';
import IconPurchase from '../icons/IconPurchase.vue';

// Define reactive variables
const page = ref(1);
const search = ref('');
const currentPage = ref(1);
const totalPages = ref(0);
const loading = ref(true);

const orders = ref([]);

const fetchOrders = async () => {
    loading.value = true;
    try {
        const response = await axios.get(`http://localhost/api/orders`);
        orders.value = response.data;
    } catch (error) {
        console.error('Error fetching orders:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchOrders);

const viewRecipe = (orderId: number) => {
    // Logic to view recipe for the order
    console.log(`Viewing recipe for order ${orderId}`);
};

const viewPurchase = (orderId: number) => {
    // Logic to view purchase details for the order
    console.log(`Viewing purchase for order ${orderId}`);
};

</script>

<template>
    <div class="flex">
        <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
            <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
            <template v-if="loading">
                <IconSkLoading className="w-6 h-6" />
            </template>
            <template v-else>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold">Total</span>
                    <span class="font-sans font-semibold text-2xl">{{ orders.length }}</span>
                </div>
            </template>
        </div>
    </div>
    <div class="flex pr-4 mt-4 space-x-1 justify-between">
        <!-- filter date -->
        <div class="flex items-center space-x-1">
            <!-- Start Date -->
            <div class="relative">
                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <Datepicker v-model="startDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" />
            </div>
            <span class="mx-1 text-gray-500">to</span>
            <!-- End Date -->
            <div class="relative">
                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <Datepicker v-model="endDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" />
            </div>
        </div>
        <!-- search field -->
        <div class="relative text-gray-400 space-x-4">
            <input v-model="search" type="text" placeholder="Search order" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button @click="fetchOrders" class="absolute z-30 inset-y-0 end-0 flex items-center pr-3">
                <IconSearch class="w-5 h-5" />
            </button>
        </div>
    </div>
    <div class="relative mt-3 flex flex-col rounded-md overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-start py-3 px-2">Order Id</th>
                    <th class="text-start py-3 px-2">User Name</th>
                    <th class="text-start py-3 px-2">Product</th> 
                    <th class="text-start py-3 px-2">Total Price</th>
                    <th class="text-start py-3 px-2">Order Date</th>
                    <th class="text-start py-3 px-2">Status</th>
                    <th class="text-start py-3 px-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in orders" :key="index" class="whitespace-nowrap odd:bg-white even:bg-gray-100">
                    <td class="py-3 px-2">{{ order.id }}</td>
                    <td class="py-3 px-2">{{ order.user_first_name }} {{ order.user_last_name }}</td>
                    <td class="py-3 px-2">{{ order.total }}</td>
                    <td class="py-3 px-2">{{ order.total }}</td>
                    <td class="py-3 px-2">{{ order.created_at }}</td>
                    <td class="py-3 px-2">
                        <span class="bg-[#F66603] text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ order.status }}</span>
                    </td>
                    <td class="py-3 px-2">
                        <button @click="viewRecipe(order.id)" class="text-blue-600 hover:text-blue-800">
                            <IconRecipe class="w-5 h-5" />
                        </button>
                        <button @click="viewPurchase(order.id)" class="text-green-600 hover:text-green-800 ml-2">
                            <IconPurchase class="w-5 h-5" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex mt-3 justify-between items-center">
        <div class="flex items-center space-x-2">
            <!-- Optional: Reset Filters button -->
        </div>
        <!-- Optional: PaginationView component -->
    </div>
</template>

<style scoped>
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
    }
    .pagination li {
        margin: 0 0.25rem;
    }
    .pagination button {
        padding: 0.5rem 1rem;
        border: none;
        background-color: #7367F0;
        color: white;
        cursor: pointer;
        border-radius: 0.25rem;
    }
    .pagination button.disabled {
        background-color: #d3d3d3;
        cursor: not-allowed;
    }
</style>
