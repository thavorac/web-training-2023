<script setup>
import { ref, computed, toValue, onMounted } from 'vue';
import ProductView from '../../views/ProductView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import CreateFormCategory from '../Category/CreateFormCategory.vue';
import ActionButton from '../CrudAction/ActionButton.vue';
import Datepicker from 'vue3-datepicker'; // Import the datepicker component
import axios from 'axios';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';
import { RouterLink } from 'vue-router';
import EditFormCategory from '../Category/EditFormCategory.vue';

const category = ref([]);
const showCreateForm = ref(false);
const editMode = ref(false);
const editCategoryId = ref(null);
const model = ref({ category: null });

const getCategories = () => {
    axios.get("http://localhost/api/categories").then(res => {
        category.value = res.data.data;
    });
};

const toggleEditMode = (categoryId) => {
    editMode.value = true;
    editCategoryId.value = categoryId;
};

const cancelEdit = () => {
    editMode.value = false;
    editCategoryId.value = null;
};
;

const handleCancel = () => {
    showCreateForm.value = false;
};

onMounted(getCategories);
</script>

<template>
    <CategoryView :subtitle="'Product'">
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
                                    <span class="font-sans font-semibold text-2xl">{{ category?.total }}</span>
                                </div>
                            </template>
                            <button @click="toggleCreateForm"
                                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                                <span class="text-xl font-semibold">Add Product</span>
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
                                    <th scope="col" class="px-6 py-3 text-lg font-sans text-[#8E95A9]">Category ID</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Category Name</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Description</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading">
                                    <th colspan="3">
                                        <IconSkLoading className="w-6 h-6" />
                                    </th>
                                </tr>
                                <template v-else>
                                    <tr v-for="(Category, index) in category" :key="index">
                                        <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ index + 1 }}
                                        </th>
                                        <td class="px-6 py-6">{{ Category.name }}</td>
                                        <td class="px-6 py-6">{{ Category.description }}</td>
                                        <td class="px-6 py-6 flex space-x-2">
                                            <button @click="toggleEditMode(Category.id)">
                                                <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                                            </button>
                                            <IconDelete class="w-6 h-6 text-red-500 cursor-pointer" />
                                            <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" />
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <!-- paginate -->
                    </div>
                    <!-- Render edit component when editMode is true -->
                    <EditFormCategory v-if="editMode" :categoryId="editCategoryId" @cancel="cancelEdit" />
                </template>

                <template v-else>
                    <CreateFormCategory @cancel="handleCancel" /> <!-- Listen for cancel event -->
                </template>
            </div>
            <div class="text-xl text-right font-semibold text-black">Product </div>
        </div>
    </CategoryView>
</template>