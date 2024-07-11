<script setup lang="ts">
import { useFetch } from '@/composable/useFetch';
import ProductView from '../../views/ProductView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import AdminProfile from '../AdminProfile/AdminProfile.vue';
import { ref, toValue } from 'vue';

const page = ref(1);
const search = ref("");
const showCreateForm = ref(false); // State to toggle between list and create form

const { loading, data } = useFetch<any>(`${import.meta.env.VITE_BACKEND}/api/categories?page=${toValue(page)}&search=${toValue(search)}`);

// Method to toggle the create form
const toggleCreateForm = () => {
    showCreateForm.value = true;
};

// Method to handle cancel event
const handleCancel = () => {
    showCreateForm.value = false;
};
</script>

<template>
    <ProductView :subtitle="'Admin Profile'">
        <div class="w-full selection:bg-gray-100 py-10 px-10 mt-10 rounded-lg bg-gray-200 shadow-md">
            <div class="w-full bg-white rounded-md p-2">
                <template v-if="!showCreateForm">
                    <div class="flex">
                        <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
                            <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
                            <template v-if="loading">
                                <IconSkLoading className="w-6 h-6" />
                            </template>
                            <template v-else>
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold">Total</span>
                                    <span class="font-sans font-semibold text-2xl">{{ data?.meta.total }}</span>
                                </div>
                            </template>
                            <button @click="toggleCreateForm"
                                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                                <span class="text-xl font-semibold">Setting</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex pr-4 mt-4">
                        <div class="flex-grow"></div>
                        <div class="relative text-gray-400">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <IconSearch className="w-6 h-6" stroke="2.0" />
                            </div>
                            <input type="text" placeholder="Search"
                                class="appearance-none ps-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-0 hover:outline-0 focus:outline-0 focus:ring-0 focus:border-0 border-0" />
                        </div>
                    </div>

                    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-lg font-sans text-[#8E95A9]">Product ID</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Product Name</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">
                                        <div class="flex items-center text-[#8E95A9]">
                                            Qty
                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#8E95A9"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">
                                        <div class="flex items-center text-[#8E95A9]">
                                            Date
                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#8E95A9"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">
                                        <div class="flex items-center text-[#8E95A9]">
                                            Revenue
                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#8E95A9"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">
                                        <div class="flex items-center text-[#8E95A9]">
                                            Net Profit
                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#8E95A9"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">
                                        <div class="flex items-center text-[#8E95A9]">
                                            Status
                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#8E95A9"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">
                                        <div class="flex items-center text-[#8E95A9]">
                                            Action
                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#8E95A9"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading">
                                    <th colspan="3">
                                        <IconSkLoading className="w-6 h-6" />
                                    </th>
                                </tr>
                                <template v-else>
                                    <tr v-for="(category, index) in data?.data"
                                        :class="`bg-white ${index == data?.data.length ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`"
                                        :key="index">
                                        <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ category?.name }}
                                        </th>
                                        <td>
                                            <div class="flex items-center w-11/12">{{ category?.description }}</div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <!-- paginate -->
                    </div>
                </template>

                <template v-else>
                    <AdminProfile @cancel="handleCancel" /> <!-- Listen for cancel event -->
                </template>
            </div>
            <div class="text-xl text-right font-semibold text-black">Categories and sub-categories</div>
        </div>
    </ProductView>
</template>
