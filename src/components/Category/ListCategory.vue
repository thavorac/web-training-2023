<template>
    <div class="flex flex-col space-y-4">
        <!-- Header Section -->
        <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
            <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
            <template v-if="loading">
                <IconSkLoading className="w-6 h-6" />
            </template>
            <template v-else>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold">Total</span>
                    <span class="font-sans font-semibold text-2xl">{{ filteredData.length }}</span>
                </div>
            </template>
            <RouterLink to="/admin/category/create"
                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                <span class="text-xl font-semibold"> Category</span>
            </RouterLink>
        </div>

        <!-- Filter Section -->
        <div class="flex pr-4 mt-4 space-x-1 justify-between">
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
            <!-- Search field -->
            <div class="relative text-gray-400 space-x-4 ">
                <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                    <IconSearch class="w-6 h-6" stroke="2.0" />
                </div>
                <input v-model="search" type="text" placeholder="Search"
                    class="appearance-none pl-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-none border-none focus:ring-0" />
                <!-- Reset filter button -->
                <button @click="resetFilters" class=" ">
                    <div class="flex items-center">
                        <span class="font-medium text-sm text-blue-500 cursor-pointer">All Categories</span>
                        <a class="pt-1" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="#1E90FF" class="size-5">
                                <path fill-rule="evenodd"
                                    d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">
                            Category Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg">
                            Created_At
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg">
                            Updated_At
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="loading">
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                            <IconSkLoading className="w-6 h-6" />
                        </td>
                    </tr>
                    <template v-if="filteredData.length === 0">
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">No categories found
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr v-for="(category, index) in filteredData"
                            :class="`bg-white ${index === filteredData.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`"
                            :key="category.id">
                            <td class="px-6 py-6">
                                {{ category.id }}
                            </td>
                            <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ category.name }}
                            </th>
                            <td class="px-6 py-6">
                                {{ category.description }}
                            </td>
                            <td class="px-6 py-6">
                                {{ category.created_at }}
                            </td>
                            <td class="px-6 py-6">
                                {{ category.updated_at }}
                            </td>
                            <td class="px-6 py-6 flex space-x-2">
                                <RouterLink :to="'/edit-category/' + category.id">
                                    <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                                </RouterLink>
                                <IconDelete @click="confirmDelete(category.id)"
                                    class="w-6 h-6 text-red-500 cursor-pointer" />
                                <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" />
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <!-- Pagination Section -->
            <PaginationView :totalPages="totalPages" :currentPage="currentPage" @goToPage="goToPage" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
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
import Swal from 'sweetalert2'
import Datepicker from 'vue3-datepicker'; // Import the datepicker component
import PaginationView from '../../views/PaginationView.vue';

const search = ref('');
const startDate = ref(null); // Define startDate as reactive
const endDate = ref(null); // Define endDate as reactive
const categories = ref([]);
const currentPage = ref(1);
const totalPages = ref(0);
const loading = ref(false);

const filteredData = computed(() => {
    let filtered = categories.value;

    // Filter by search term
    if (search.value) {
        filtered = filtered.filter(cat => cat.name.toLowerCase().includes(search.value.toLowerCase()));
    }

    // Filter by date range
    if (startDate.value && endDate.value) {
        const start = new Date(startDate.value).getTime();
        const end = new Date(endDate.value).getTime();

        filtered = filtered.filter(cat => {
            const createdAt = new Date(cat.created_at).getTime();
            return createdAt >= start && createdAt <= end;
        });
    }

    return filtered;
});

const getCategories = () => {
    loading.value = true;
    axios.get(`http://localhost/api/categories?page=${currentPage.value}`)
        .then(response => {
            categories.value = response.data.data; // Assuming Laravel pagination returns data in 'data' key
            totalPages.value = response.data.last_page; // Assuming Laravel pagination returns total pages in 'last_page' key
        })
        .catch(error => {
            console.error("Error fetching categories:", error);
        })
        .finally(() => {
            loading.value = false;
        });
};

const goToPage = (page: number) => {
    currentPage.value = page;
    getCategories();
};

const deleteCategory = (categoryId: number) => {
    axios.delete(`http://localhost/api/categories/${categoryId}`)
        .then(() => {
            currentPage.value = 1; // Reset page to 1
            getCategories(); // Fetch data again after deletion
            Swal.fire("Deleted!", "Your category has been deleted.", "success");
        })
        .catch((error) => {
            Swal.fire("Error!", "An error occurred while deleting the category.", "error");
        });
};

const confirmDelete = (categoryId: number) => {
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
            deleteCategory(categoryId);
        }
    });
};

const resetFilters = () => {
    search.value = "";
    startDate.value = null;
    endDate.value = null;
    getCategories(); // Refetch data after resetting filters
};

getCategories(); // Initial data fetching
</script>

<style scoped>
/* Your scoped styles here */
</style>
