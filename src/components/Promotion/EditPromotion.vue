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
    discount_percentage: string;
    status: boolean;
    start_date: string;
    end_date: string;
}

// Function to fetch promotions
const fetchPromotions = () => {
    loading.value = true;
    axios.get<{ promotions: Promotion[] }>('http://localhost:8000/api/promotions/all')
        .then(response => {
            promotions.value = response.data.promotions;
        })
        .catch(error => {
            console.error('Error fetching promotions:', error);
        })
        .finally(() => {
            loading.value = false;
        });
};

// Computed property to filter promotions by date range
const filteredData = computed(() => {
    let filtered = promotions.value;

    if (startDate.value && endDate.value) {
        filtered = filtered.filter(promotion => {
            const createdAt = new Date(promotion.start_date);
            return createdAt >= startDate.value! && createdAt <= endDate.value!;
        });
    }

    return filtered;
});

// Function to confirm promotion deletion
const confirmDelete = (promotionId: number) => {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this promotion!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            onDeletePromotion(promotionId);
        }
    });
};

// Function to handle deletion request
const onDeletePromotion = (promotionId: number) => {
    axios.delete(`http://localhost:8000/api/promotions/delete/${promotionId}`)
        .then(response => {
            handleSuccessfulDeletion(); // Handle successful deletion
        })
        .catch(error => {
            handleFailedDeletion(error); // Handle deletion failure
        });
};

// Function to handle successful deletion
const handleSuccessfulDeletion = () => {
    Swal.fire(
        'Deleted!',
        'Your promotion has been deleted.',
        'success'
    );
    fetchPromotions(); // Optionally, update promotions list after deletion
};

// Function to handle deletion failure
const handleFailedDeletion = (error: any) => {
    console.error('Error deleting promotion:', error);
    Swal.fire(
        'Error!',
        'Failed to delete the promotion.',
        'error'
    );
};

// Initial data fetching
fetchPromotions();
</script>

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
                    <span class="text-sm font-semibold">Total Promotions:</span>
                    <span class="font-sans font-semibold text-2xl">{{ filteredData.length }}</span>
                </div>
            </template>
            <RouterLink
                to="/admin/promotion/create-promotion"
                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md"
            >
                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                <span class="text-xl font-semibold">Create Promotion</span>
            </RouterLink>
        </div>

        <!-- Filters Section -->
        <div class="flex pr-4 mt-4 space-x-1">
            <div class="flex items-center space-x-1">
                <!-- Datepickers for start and end dates -->
                <div class="relative">
                    <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg
                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                            />
                        </svg>
                    </div>
                    <Datepicker
                        v-model="startDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select start date"
                    />
                </div>
                <span class="mx-1 text-gray-500">to</span>
                <div class="relative">
                    <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg
                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                            />
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
            <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">ID</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Discount Percentage</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Status</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Start Date</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">End Date</th>
                        <th scope="col" class="px-6 py-3 text-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="loading">
                        <td colspan="6" class="text-center py-4">Loading...</td>
                    </tr>
                    <template v-else-if="filteredData.length === 0">
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No promotions found</td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr
                            v-for="(promotion, index) in filteredData"
                            :key="promotion.id"
                            :class="`bg-white ${index === filteredData.length - 1 ? '' : 'border-b border-gray-200'} cursor-pointer hover:bg-gray-100`"
                        >
                            <td class="px-6 py-4">{{ promotion.id }}</td>
                            <td class="px-6 py-4">{{ promotion.discount_percentage }}</td>
                            <td class="px-6 py-4">{{ promotion.status ? 'Active' : 'Inactive' }}</td>
                            <td class="px-6 py-4">{{ promotion.start_date }}</td>
                            <td class="px-6 py-4">{{ promotion.end_date }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <RouterLink :to="'/edit-promotion/' + promotion.id">
                                    <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                                </RouterLink>
                                <IconDelete
                                    class="w-6 h-6 text-red-500 cursor-pointer"
                                    @click="confirmDelete(promotion.id)"
                                />
                                <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" />
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>
