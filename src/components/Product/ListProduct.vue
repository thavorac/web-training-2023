<script setup lang="ts">
import { ref, computed, onMounted, watch } from 'vue';
import { useFetch } from '@/composable/useFetch';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import { RouterLink } from 'vue-router';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Datepicker from 'vue3-datepicker'; // Import the datepicker component
import PaginationView from '../../views/PaginationView.vue';

// Define reactive variables
const page = ref(1);
const search = ref('');
const currentPage = ref(1);
const totalPages = ref(0);
const images = ref([]);
const loading = ref(true);

const fetchImages = async () => {
    try {
        const response = await fetch('http://localhost:80/api/images');
        const data = await response.json();
        images.value = data;
    } catch (error) {
        console.error('Error fetching images:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchImages);

const getProducts = async () => {
    try {
        const response = await axios.get(`http://localhost/api/products?page=${currentPage.value}`);
        product.value = response.data;
        totalPages.value = response.data.last_page;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

const goToPage = (page: number) => {
    currentPage.value = page;
    getProducts();
};

const deleteProduct = (productId: number) => {
    axios.delete(`http://localhost/api/products/${productId}`)
        .then(() => {
            currentPage.value = 1; // Reset page to 1
            getProducts(); // Fetch data again after deletion
            Swal.fire("Deleted!", "Your product has been deleted.", "success");
        })
        .catch((error) => {
            Swal.fire("Error!", "An error occurred while deleting the product.", "error");
        });
};

// Function to confirm deletion using SweetAlert
const confirmDelete = (productId: number) => {
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
            deleteProduct(productId)
                .then(() => {
                    // Fetch data again after deletion
                    page.value = 1; // Reset page to 1
                    useFetch(`${import.meta.env.VITE_BACKEND}/api/products?page=${page.value}&search=${search.value}`);
                    Swal.fire(
                        "Deleted!",
                        "Your product has been deleted.",
                        "success"
                    );
                })
                .catch((error) => {
                    Swal.fire(
                        "Error!",
                        "An error occurred while deleting the product.",
                        "error"
                    );
                });
        }
    });
};

// Define the Product interface
interface Product {
    id: number;
    name: string;
    brand: string;
    pricing: number;
    category_id: number;
    size: string;
    image: string; // Corrected the type from 'text' to 'string'
    description: string;
    created_at?: string; // Updated to match the API response field
}

const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);

const product = ref<Product[]>([]);

const filteredData = computed(() => {
    let filtered = product.value;

    if (search.value) {
        filtered = filtered.filter(pro => pro.name.toLowerCase().includes(search.value.toLowerCase()));
    }

    // Filter by date range
    if (startDate.value && endDate.value) {
        const start = new Date(startDate.value).setHours(0, 0, 0, 0);
        const end = new Date(endDate.value).setHours(23, 59, 59, 999);

        filtered = filtered.filter(pro => {
            const createdAt = new Date(pro.created_at).getTime();
            return createdAt >= start && createdAt <= end;
        });
    }

    return filtered;
});

// Watchers to refetch data on filter change
watch([startDate, endDate, search], getProducts);

// Method to reset all filters
const resetFilters = () => {
    search.value = '';
    startDate.value = null;
    endDate.value = null;
    getProducts();
};

// Initial data fetching
getProducts();
</script>

<template>
    <div class="flex">
        <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
            <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
            <template v-if="loading">
                <IconSkLoading className="w-6 h-6" />
            </template>
            <template v-else>
                <div class="flex flex-col ">
                    <span class="text-sm font-semibold">Total</span>
                    <span class=" font-sans font-semibold text-2xl">{{ filteredData.length }}</span>
                </div>
            </template>
            <RouterLink to="/admin/product/create"
                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                <span class="text-xl font-semibold "> Product</span>
            </RouterLink>
        </div>

    </div>
    <div class="flex pr-4 mt-4 space-x-1 justify-between">
        <!-- filter date -->
        <!-- Datepicker for start date -->
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
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date start" />
            </div>
            <span class="mx-1 text-gray-500">to</span>
            <!-- Datepicker for end date -->
            <div class="relative">
                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <Datepicker v-model="endDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date end" />
            </div>
        </div>
        <!-- search field -->
        <div class="relative text-gray-400 space-x-4 ">
            <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                <IconSearch class="w-6 h-6" stroke="2.0" />
            </div>
            <input v-model="search" type="text" placeholder="Search"
                class="appearance-none pl-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-none border-none focus:ring-0" />
            <!-- button reset filter -->
            <button @click="resetFilters" class=" ">
                <div class="flex items-center">
                    <span class="font-medium text-sm text-blue-500 cursor-pointer">All Products</span>
                    <a class="pt-1" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#1E90FF"
                            class="size-5">
                            <path fill-rule="evenodd"
                                d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </button>
        </div>
    </div>
    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700  bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Brand
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Size
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg font-sans">
                        Description
                    </th>
                    <!-- <th scope="col" class="px-6 py-3 text-lg">
                        Description
                    </th> -->
                    <th scope="col" class="px-6 py-3 text-lg">
                        Created_At
                    </th>

                    <th scope="col" class="px-6 py-3 text-lg">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="loading">
                    <th colspan="3">
                        <IconSkLoading className="w-6 h-6" />
                    </th>
                </tr>
                <template v-if="filteredData.length === 0">
                    <tr>
                        <td colspan="8" class="px-6 py-6 text-center text-gray-500">No products found
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="(product, index) in filteredData"
                        :class="`bg - white ${index == filteredData.length - 1 ? '' : 'border-b'} border - gray - 200 cursor - pointer hover: bg - gray - 100`"
                        :key="index">
                        <td class="px-6 py-6">
                            {{ product?.id }}
                        </td>
                        <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ product?.name }}
                        </th>
                        <td class="px-6 py-6">{{ product?.brand }}
                        </td>
                        <td class="px-6 py-6">{{ product?.pricing }}
                        </td>
                        <td class="px-6 py-6">{{ product?.category_id }}
                        </td>
                        <td class="px-6 py-6">{{ product?.size }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <!-- <img :src="image.replace('storage', 'app')" alt="Photo" width="50px" /> -->

                            <!-- <img :src="`http://localhost/storage/${image.images}.jpg`" alt="image"> -->
                            <img :src="`http://localhost/storage/${product.image}`" alt="image" width="50px" />
                        </td>
                        <td class="px-6 py-6">
                            {{ product?.description }}
                        </td>
                        <td class="px-6 py-6">
                            {{ product?.created_at }}
                        </td>
                        <td class="px-6 py-6 flex space-x-2">
                            <RouterLink :to="`/admin/product/${product.id}/edit`">
                                <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                            </RouterLink>
                            <IconDelete @click="confirmDelete(product.id)"
                                class=" w-6 h-6 text-red-500 cursor-pointer" />
                            <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" />
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <!-- paginate -->
        <PaginationView :totalPages="totalPages" :currentPage="currentPage" @goToPage="goToPage" />
    </div>
</template>
