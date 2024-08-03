<script setup lang="ts">
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Datepicker from 'vue3-datepicker';
import PaginationView from '../../views/PaginationView.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import { RouterLink } from 'vue-router';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';

// Define reactive variables
const page = ref(1);
const search = ref('');
const currentPage = ref(1);
const totalPages = ref(0);
const loading = ref(true);

const orders = ref([]);
const users = ref([]);

const fetchOrders = async () => {
    loading.value = true;
    try {
        const response = await axios.get(`http://localhost/api/orders`);
        orders.value = response.data;
        // console.log('fetch orders ', response.data);
    } catch (error) {
        console.error('Error fetching orders:', error);
    } finally {
        loading.value = false;
    }
    
};
const fetchUsers = async () => {
    loading.value = true;
    try {
        const response = await axios.get(`http://localhost/api/login`);
        users.value = response.data;
        console.log('fetch users ', response.data);
    } catch (error) {
        console.error('Error fetching users:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchOrders);

const deleteOrder = async (orderId: number) => {
    try {
        await axios.delete(`http://localhost/api/orders/${orderId}`);
        currentPage.value = 1; // Reset page to 1
        fetchOrders(); // Fetch data again after deletion
        Swal.fire("Deleted!", "Your order has been deleted.", "success");
    } catch (error) {
        Swal.fire("Error!", "An error occurred while deleting the order.", "error");
    }
};

const confirmDelete = (orderId: number) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteOrder(orderId);
        }
    });
};

interface Order {
    id: number;
    user_first_name: string;
    user_last_name: string;
    quantity: number;
    total_price: number;
    order_date: string;
    status: string;
}

const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);

// const filteredData = computed(() => {
//     let filtered = orders.value;
//     if (search.value) {
//         filtered = filtered.filter(order =>
//             order.product_name.toLowerCase().includes(search.value.toLowerCase())
//         );
//     }
//     if (startDate.value && endDate.value) {
//         const start = new Date(startDate.value).setHours(0, 0, 0, 0);
//         const end = new Date(endDate.value).setHours(23, 59, 59, 999);
//         filtered = filtered.filter(order => {
//             const orderDate = new Date(order.order_date).getTime();
//             return orderDate >= start && orderDate <= end;
//         });
//     }
//     return filtered;
// });

// watch([startDate, endDate, search], fetchOrders);

// const resetFilters = () => {
//     search.value = '';
//     startDate.value = null;
//     endDate.value = null;
//     fetchOrders();
// };

fetchOrders();

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
            <!-- <RouterLink to="/admin/order/create"
                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                <span class="text-xl font-semibold">Order</span>
            </RouterLink> -->
        </div>
    </div>
    <div class="flex pr-4 mt-4 space-x-1 justify-between">
        <!-- filter date -->
        <div class="flex items-center space-x-1">
            <div class="relative">
                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <Datepicker v-model="startDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date start" />
            </div>
            <span class="mx-1 text-gray-500">to</span>
            <div class="relative">
                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <Datepicker v-model="endDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date end" />
            </div>
        </div>
        <!-- search field -->
        <div class="relative text-gray-400 space-x-4">
            <input v-model="search" type="text" placeholder="Search order"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button @click="fetchOrders"
                class="absolute z-30 inset-y-0 end-0 flex items-center pr-3">
                <IconSearch className="w-5 h-5" />
            </button>
        </div>
    </div>
    <div class="relative mt-3 flex flex-col rounded-md overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-start py-3 px-2">Order Id</th>
                    <th class="text-start py-3 px-2">User Name</th>
                    <!-- <th class="text-start py-3 px-2">Product</th> -->
                    <th class="text-start py-3 px-2">Total Price</th>
                    <th class="text-start py-3 px-2">Order Date</th>
                    <th class="text-start py-3 px-2">Status</th>
                    <th class="text-start py-3 px-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in orders" :key="index"
                    class="whitespace-nowrap odd:bg-white even:bg-gray-100">
                    <td class="py-3 px-2">{{ order.id }}</td>
                    <td class="py-3 px-2">{{ order.user_first_name }} {{ order.user_last_name }}</td>
                    <td class="py-3 px-2">{{ order.total }}</td>
                    <td class="py-3 px-2">{{ order.created_at }}</td>
                    <td class="py-3 px-2">
                        <span
                       class="bg-[#F66603] text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ order.status }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex mt-3 justify-between items-center">
        <div class="flex items-center space-x-2">
            <!-- <button @click="resetFilters"
                class="bg-gray-300 py-2 px-4 text-gray-700 rounded-md hover:bg-gray-400">
                Reset Filters
            </button> -->
        </div>
        <!-- <PaginationView :current-page="currentPage" :total-pages="totalPages" @page-changed="fetchOrders" /> -->
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
